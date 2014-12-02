<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher;
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
		
		
		if($this->request->isPost()){
			echo('hello');
			$checktime=microtime(true);
		file_put_contents('debugger.csv',$checktime.' <-> '.getmypid().PHP_EOL,FILE_APPEND);
			$this->mailrenderer->addressuid=1;
			
			$time=time();
			//find mailings which are due
			$mailings= Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND inprogress=0 AND reviewed=1 AND cleared=1  AND sent=0 AND tstamp <= ?1",
				"bind" => array(1 => $time),
				"order" => "tstamp ASC"
			));
			
			foreach($mailings AS $mailing){
				$addressConditions=$mailing->getAddressconditions();
				$condStrng='';
				foreach($addressConditions AS $condition){
					switch($condition->junctor){
						case 1:
							$condStrng.='AND ( ';
							break;
						case 2: 
							$condStrng.='OR ( ';
							break;
						default:
							$condStrng=' AND (';
							break;
					}
					
					$condition->conditionaloperator;
					switch($condition->argument){
						case 1:
							$condStrng.='gender ';
							break;
						case 2: 
							$condStrng.='first_name ';
							break;
						case 3: 
							$condStrng.='last_name ';
							break;
						case 4: 
							$condStrng.='email ';
							break;
						case 5: 
							$condStrng.='zip ';
							break;
						case 2: 
							$condStrng.='region ';
							break;
						case 2: 
							$condStrng.='city ';
							break;
						case 2: 
							$condStrng.='province ';
							break;						
						
					}
					
					switch($condition->operator){
						case 1:
							if($condition->conditionaloperator == 1){
								$condStrng.= '=';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= '<>';
							}						 
						break;
						case 2:
							if($condition->conditionaloperator == 1){
								$condStrng.= 'LIKE ';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= 'NOT LIKE ';
							}						 
						break;
						case 3:
							if($condition->conditionaloperator == 1){
								$condStrng.= '>';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= '<=';
							}						 
						break;
						case 4:
							if($condition->conditionaloperator == 1){
								$condStrng.= '>=';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= '<';
							}						 
						break;
						case 5:
							if($condition->conditionaloperator == 1){
								$condStrng.= '<';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= '>=';
							}						 
						break;
						case 6:
							if($condition->conditionaloperator == 1){
								$condStrng.= '<=';
							}else if($condition->conditionaloperator == 2){
								$condStrng.= '>';
							}						 
						break;
					}
					
					if($condition->operator==2 ){
						$condStrng.='"%'.$condition->argumentcondition.'%") ';
						
					}else{
						$condStrng.=$condition->argumentcondition.') ';
					}
					
				}
				
				/*TODO FORM QUERY FROM CONDITIONS*/
				$adressFolder=$mailing->getAddressfolder();
				$addresses=$adressFolder->getAddresses(array(
					'conditions'=>'deleted=0 AND hidden=0 '.$condStrng
				));
				$configuration=$mailing->getConfiguration();					
				//$bodyRaw=file_get_contents('../public/mails/mailobject_'.$mailing->mailobjectuid.'.html');
				
				

				// First build up Mailqueue, then Mail
				$mailing->inprogress=1;
				$mailing->update();
				$insField='(crdate,addressuid,campaignuid,sendoutobjectuid,mailobjectuid,configurationuid,email,subject,sendermail,sendername,answermail,answername,returnpath,organisation)';
				
				$insStr='';
				
				for($counter=0;$counter<count($addresses);$counter++){						
					$address=$addresses[$counter];
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
					if($mailing->abtest==0 || ($mailing->abtest==1 && $mailing->pid==0 && ($counter+1)%2!=0) || ($mailing->abtest==1 && $mailing->pid!=0 && ($counter+1)%2==0)){
						$insStr.='('.$time.','.$address->uid.','.$mailing->campaignuid.','.$mailing->uid.','.$mailing->mailobjectuid.','.$mailing->configurationuid.',"'.$address->email.'","'.$configuration->sendermail.'","'.$configuration->sendername.'","'.$configuration->sendername.'","'.$configuration->answermail.'","'.$configuration->answername.'","'.$configuration->returnpath.'","'.$configuration->organisation.'"),';						
					}
					
					if($counter%1000==0 && $counter !=0){
							
							$insStr=substr($insStr,0,-1);
							//file_put_contents('log.txt', "INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
							echo('inloop:  '.$insStr);
							$this->di->get('db')->query("INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
							$insStr="";
					}
					$debug=json_encode($mailing);
					file_put_contents('debuggerGenerate.csv',getmypid().' <--PID '.$checktime.' <-> '.$counter.' <-> '.$debug.'        <->      '.$insStr.PHP_EOL,FILE_APPEND);


				}
				
				if($insStr!=''){
					
					$insStr=substr($insStr,0,-1);
					echo('outloop:  '.$insStr);
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
		
		if($this->request->isPost()){
			
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
			
			$counter=0;
			$transport = \Swift_SmtpTransport::newInstance($this->config['smtp']['host'],$this->config['smtp']['port'] )->setUsername($this->config['smtp']['username'])->setPassword($this->config['smtp']['password']);
			$mailer = \Swift_Mailer::newInstance($transport);				
			$mailer->registerPlugin(new \Swift_Plugins_AntiFloodPlugin(100,30));	
			if($configuration->clicktracking==1){
				$bodyPrerendered=$this->mailrenderer->writeClicktrackingLinks($bodyRaw,$mailing);
			}else{
				$bodyPrerendered=$bodyRaw;
			}
			//Mailqueue abarbeiten
			for($counter=0;$counter<count($mailqueue);$counter++){
				$checktime=microtime(true);
				$mailqueueElement=$mailqueue[$counter];
				
				$to=array();
				$address=$mailqueueElement->getAddress();
				$debug=json_encode($mailqueueElement);
				$addressDebug=json_encode($address);
			

				$body=$this->mailrenderer->renderVars($bodyPrerendered,$address);
				
				if($configuration->clicktracking==1){
					
					
					$bodyFinal=$this->mailrenderer->renderFinal($body,$address->uid,$mailing->uid);								
				}else{
					$bodyFinal=$body;
				}
				$endtime=  microtime(true);
					$timeused=$endtime-$checktime;
				 $message = \Swift_Message::newInstance($mailing->subject)
							->setSender(array($configuration->sendermail => $configuration->sendername))
							->setFrom(array($configuration->sendermail => $configuration->sendername))
							->setReplyTo($configuration->answermail)
							->setReturnPath($configuration->returnpath);
				$message->setBody($bodyFinal, 'text/html');
				$to=array($address->email => $address->first_name.' '.$address->last_name);
				$message->setTo($to);
				
				if($mailqueueElement->sent==0){
				$mailer->send($message, $failures);				
					$debug2=json_encode($to);
					
					
					file_put_contents('debuggerSend.csv',getmypid().' <--PID '.$timeused.' <-> '.$counter.' <-> '.$debug2.'        <->      '.$debug.PHP_EOL,FILE_APPEND);
				}
				$mailqueueElement->assign(array(
					"mailbody"=>$bodyFinal,
					"sent"=>1
					
				));							
				$mailqueueElement->update();
			}
			
			
			
			//Was wenn genau durch $this->config['smtp']['mailcycle'] teilbar?
			if($counter<$this->config['smtp']['mailcycle']){
				$mailing->assign(array(
					"inprogress"=>0,
					"sent" => 1
				));
				
				$mailing->update();
			}
			}
			
			
		}else{
			die('<img src="images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
		}
	}
	
	
	
}