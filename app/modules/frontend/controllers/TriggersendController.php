<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects,
	nltool\Models\Mailqueue,
	nltool\Models\Linklookup;
/**
 * Class TriggersendController
 *
 * @package baywa-nltool\Controllers
 */

class TriggersendController extends Triggerauth

{
	
	
	

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function generateAction()
    {
		if(!$this->request->isPost()){
			
			$time=time();
			//find mailings which are due
			$mailings= Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND inprogress=0 AND reviewed=1 AND cleared=1  AND sent=0 AND tstamp <= ?1",
				"bind" => array(1 => $time),
				"order" => "tstamp ASC"
			));
			
			foreach($mailings AS $mailing){
				$addressConditions=$mailing->getAddressconditions();
				/*TODO FORM QUERY FROM CONDITIONS*/
				$adressFolder=$mailing->getAddressfolder();
				$addresses=$adressFolder->getAddresses();
				$configuration=$mailing->getConfiguration();					
				$bodyRaw=file_get_contents('../public/mails/mailobject_'.$mailing->mailobjectuid.'.html');
				if($configuration->clicktracking==1){
							$bodyRaw=$this->writeClicktrackingLinks($bodyRaw,$mailing);
						}
				

				// First build up Mailqueue, then Mail
				$mailing->inprogress=1;
				$mailing->save();
				$insField='(crdate,addressuid,campaignuid,sendoutobjectuid,mailobjectuid,configurationuid,email,subject,sendermail,sendername,answermail,answername,returnpath,organisation)';
				$counter=0;
				$insStr='';
				foreach($addresses as $address){						

					/*$mailqueueobject=new Mailqueue();
					$mailqueueobject->assign(array(
						"pid"=>0,
						"tstamp"=>0,
						"crdate"=>$time,
						"deleted"=>0,
						"hidden"=>0,
						"sent"=>0,
						"campaignuid"=>$mailing->campaignuid,
						"mailobjectuid"=>$mailing->mailobjectuid,
						"configurationuid"=>$mailing->configurationuid,
						"email"=>$address->email,
						"subject"=>$mailing->subject,
						"sendermail"=>$configuration->sendermail,
						"sendername"=>$configuration->sendername,
						"answermail"=>$configuration->answermail,
						"answername"=>$configuration->answername,
						"returnpath"=>$configuration->returnpath,
						"organisation"=>$configuration->organisation,
						"mailbody"=>$bodyFinal
						));*/
					/*$mailqueueobject->save();*/
					 /*if (!$mailqueueobject->save()) {
						$this->flash->error($mailqueueobject->getMessages());
					}*/
					$insStr.='('.$time.','.$address->uid.','.$mailing->campaignuid.','.$mailing->uid.','.$mailing->mailobjectuid.','.$mailing->configurationuid.',"'.$address->email.'","'.$configuration->sendermail.'","'.$configuration->sendername.'","'.$configuration->sendername.'","'.$configuration->answermail.'","'.$configuration->answername.'","'.$configuration->returnpath.'","'.$configuration->organisation.'"),';
					if($counter%1000==0 && $counter !=0){

						$insStr=substr($insStr,0,-1);
						//file_put_contents('log.txt', "INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
						$this->di->get('db')->query("INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
						$insStr="";
					}
					$counter++;


				}
				if($insStr!=''){
					$insStr=substr($insStr,0,-1);
						$this->di->get('db')->query("INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
						$insStr="";
				}
				


				
			}
			
			
			//generate mails as they are handed over to the smtp mailqueue
			//hand them over to smtp in chunks of X (Backend configuration) numbers
			
			
			
		}else{
			die('<img src="images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
		}
	}
	
	public function sendAction(){
		
		if(!$this->request->isPost()){
			
			$mailing= Sendoutobjects::findFirst(array(
				"conditions" => "deleted=0 AND hidden=0 AND inprogress=1 AND reviewed=1 AND cleared=1  AND sent=0",				
				"order" => "tstamp ASC"
			));
		
			if($mailing){
			$configuration=$mailing->getConfiguration();
			$mailqueue=$mailing->getMailqueue(array(
				"conditions" => "deleted=0 AND hidden=0 AND sent=0",				
				"order" => "uid ASC",
				"limit" => $this->config['smtp']['mailcycle']
			));
			
			$bodyRaw=file_get_contents('../public/mails/mailobject_'.$mailing->mailobjectuid.'.html');
			if($configuration->clicktracking==1){
						$bodyRaw=$this->writeClicktrackingLinks($bodyRaw,$mailing);
			}
			$counter=0;
			foreach($mailqueue as $mailqueueElement){				
				$address=$mailqueueElement->getAddress();
				
			
			
				
				//Mailqueue abarbeiten

				$body=$this->renderVars($bodyRaw,$address);
				if($configuration->clicktracking==1){
					$bodyFinal=$this->renderFinal($body,$address->uid);								
				}else{
					$bodyFinal=$body;
				}
				
				 $transport = \Swift_SmtpTransport::newInstance($this->config['smtp']['host'],$this->config['smtp']['port'] )->setUsername($this->config['smtp']['username'])->setPassword($this->config['smtp']['password']);
				$mailer = \Swift_Mailer::newInstance($transport);
				$mailer->registerPlugin(new \Swift_Plugins_AntiFloodPlugin(100,30));
				$message = \Swift_Message::newInstance($mailing->subject)
							->setSender(array($configuration->sendermail => $configuration->sendername))
							->setFrom(array($configuration->sendermail => $configuration->sendername))
							->setReplyTo($configuration->answermail)
							->setReturnPath($configuration->returnpath);
				$message->setBody($bodyFinal, 'text/html');
				$message->setTo(array($address->email => $address->first_name.' '.$address->last_name));
				$mailqueueElement->assign(array(
					"mailbody"=>$bodyFinal,
					"sent"=>1
					
				));
				
				//pull the trigger
				$mailer->send($message, $failures);
				$mailqueueElement->save();
				$counter++;
			}
			//Was wenn genau durch $this->config['smtp']['mailcycle'] teilbar?
			if($counter<$this->config['smtp']['mailcycle']){
				$mailing->assign(array(
					"inprogress"=>0,
					"sent" => 1
				));
				
				$mailing->save();
			}
			}
			
			
		}else{
			die('<img src="images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
		}
	}
	
	private function writeClicktrackingLinks($body,$mailing){
		$this->mailing=$mailing;
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$this->baseUri=$this->config['application'][$environment]['staticBaseUri'];
		
		$renderedbody=preg_replace_callback('/(<a\s[^>]*href=\")([http|https][^\"]*)(\"[^>]*>)/siU',  function($matches){
			
			$time=time();
			$jumplink=new Linklookup();
			$jumplink->assign(array(
				"pid"=>0,
				"tstamp"=>$time,
				"crdate"=>$time,
				"deleted"=>0,
				"hidden"=>0,				
				"campaignuid"=>$this->mailing->campaignuid,
				"mailobjectuid"=>$this->mailing->mailobjectuid,
				"sendoutobjectuid"=>$this->mailing->uid,
				"url"=>$matches[2],
				"addressuid"=>0
			));
			$jumplink->save();
			return $matches[1].'http://'.$this->request->getHttpHost().$this->baseUri.'linkreferer/'.$jumplink->uid.$matches[3];
		},$body);
		
		
		return $renderedbody;
	}
	
	private function renderFinal($body,$addressuid){
				
		$this->addressuid=$addressuid;
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$this->baseUri=$this->config['application'][$environment]['staticBaseUri'];		
		$renderedbody=preg_replace_callback('/(<a\s[^>]*href=\")([http|https][^\"]*)(\"[^>]*>)/siU', 'self::renderFinalCallback' ,$body);		
		$finalizedBody=preg_replace_callback('/<body[^>]*>/im',"self::addOpenmailerBlankImage",$renderedbody);
				
		return $finalizedBody;				
	}
	
	private function renderFinalCallback($matches){						
			return $matches[1].$matches[2].'/'.$this->addressuid.$matches[3];
	}
	
	private function addOpenmailerBlankImage($matches){
		return $matches[0].'<img width="1" height="1" src="'.'http://'.$this->request->getHttpHost().$this->baseUri.'linkreferer/open/'.$this->mailing->uid.'/'.$this->addressuid.'">';
	}
	
	private function renderVars($body,$address){
		$fieldMap=array(
			'Anrede' => 'salutation',
			'Vorname' => 'first_name',
			'Nachname' => 'last_name',
			'Titel' => 'title',
			'Unternehmen' => 'company',
			'Email' => 'Email'
		); //TODO komplettieren
		
		preg_match_all('/{{(.*)}}/siU', $body, $matches);
		
		foreach($matches[0] as $key => $match){
			$body=str_replace($match, $address->$fieldMap[$matches[1][$key]], $body);
		}
		
		return $body;
	}
	
}