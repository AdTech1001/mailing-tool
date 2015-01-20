<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher;
use nltool\Models\Sendoutobjects,
	nltool\Models\Mailqueue,
	nltool\Models\Linklookup;
require_once '../app/library/Swiftmailer/swift_required.php';
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
			$trlayers=stream_get_transports();
			
			$checktime=microtime(true);
		
			$this->mailrenderer->addressuid=1;
			
			$time=time();
			//find mailings which are due
			$mailings= Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND inprogress=0 AND reviewed=1 AND cleared=1  AND sent=0 AND tstamp <= ?1",
				"bind" => array(1 => $time),
				"order" => "tstamp ASC"
			));
			
			foreach($mailings AS $key => $mailing){
				$addressConditions=$mailing->getAddressconditions();
				$condStrng='';
				if($addressConditions){
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
				}
				$clickconditions=$mailing->getClickconditions();
				$clickcondstrng='';
				$joinTables='';
				if($clickconditions){
					foreach($clickconditions as $clickcondition){
						switch($clickcondition->junctor){
							case 1:
								$clickcondstrng.=' AND ( ';
								break;
							case 2: 
								$clickcondstrng.=' OR ( ';
								break;
							default:
								$clickcondstrng=' AND (';
								break;
						}
						
						switch($clickcondition->conditionaloperator){
							case 1:
								$joinTables=' LEFT JOIN nltool\Models\Linkclicks ON (nltool\Models\Addresses.uid=nltool\Models\Linkclicks.addressuid AND nltool\Models\Linkclicks.sendoutobjectuid='.$clickcondition->sourcesendoutobjectuid.')';
								$bracePos=strpos($clickcondition->argumentcondition,'{{');
								$likeNotLike=$clickcondition->conditiontrue==1 ?  'LIKE':'NOT LIKE';
								if($bracePos){
									$clickcondstrng.='url '.$likeNotLike.' "'.substr($clickcondition->argumentcondition,0,($bracePos-1)).'%"';
								}else{
									$clickcondstrng.='url '.$likeNotLike.' "'.$clickcondition->argumentcondition.'"';
								}
								
								break;
							
						}
						$clickcondstrng.=') ';
					}
				}
				
				
				$distributor=$mailing->getDistributor();
				$addresses=$distributor->getAddresses(array(
					'conditions'=>$condStrng,
					'clickconditions'=>array(
						0=>$clickcondstrng,
						1=>$joinTables
						)
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
					
					if($counter%500==0 && $counter !=0){
							
							$insStr=substr($insStr,0,-1);
							//file_put_contents('log.txt', "INSERT INTO Mailqueue ".$insField." VALUES ".$insStr);
							echo('inloop:  '.$insStr);
							$this->di->get('db')->query("INSERT INTO mailqueue ".$insField." VALUES ".$insStr);
							$insStr="";
					}
					
					


				}
				
				if($insStr!=''){
					
					$insStr=substr($insStr,0,-1);
					echo('outloop:  '.$insStr);
						$this->di->get('db')->query("INSERT INTO mailqueue ".$insField." VALUES ".$insStr);
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
				"conditions" => "deleted=0 AND hidden=0 AND inprogress=1 AND reviewed=1 AND cleared=1 AND sent=0",				
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
				
				$this->mailrenderer->writeClicktrackingLinks($bodyRaw,$mailing);
				$links=Linklookup::find(array(
					'conditions'=>'deleted=0 AND hidden=0 AND sendoutobjectuid = ?1',
					'bind'=> array(
						1=>$mailing->uid
					),
					'order'=>'linknumber ASC'
				));
				$linkKeyMap=array();
				foreach($links as $link){
					$linkKeyMap[$link->linknumber]=$link->uid;
				}
			}
			
							
			//$mailer->registerPlugin(new \Swift_Plugins_AntiFloodPlugin(100,10));	
			$counter=0;
			$numSent=0;
			foreach($mailqueue as $mailqueueElement){
				if($counter==0 || $counter%100==0){
					//Mailqueue abarbeiten
					$transport = \Swift_SmtpTransport::newInstance()
							->setHost($this->config['smtp']['host'])
							->setPort($this->config['smtp']['port'])
							->setEncryption($this->config['smtp']['security'])
							->setUsername($this->config['smtp']['username'])
							->setPassword($this->config['smtp']['password']);

					$mailer = \Swift_Mailer::newInstance($transport);
					if($counter>0){
						sleep(10);
					}
				}
				
				
				$to=array();
				$address=$mailqueueElement->getAddress();
				$debug=json_encode($mailqueueElement);
				$addressDebug=json_encode($address);
			

				$body=$this->mailrenderer->renderVars($bodyRaw,$address);
				/*
				 * Für die geplanten volldynamische Inhalte entstehen an dieser Stelle neue Links, 
				 * diese müssen ins Linklookup eingefügt und eine neue individuelle Linkmap erstellt,
				 * da der Renderer einfach $match[n] mit $linkKeyMap[n] in Verein bringt.
				 */
				if($configuration->clicktracking==1){
					
					
					$bodyFinal=$this->mailrenderer->renderFinal($body,$address->uid,$mailing->uid,$linkKeyMap);								
				}else{
					$bodyFinal=$body;
				}
				
				 $message = \Swift_Message::newInstance($mailing->subject)
							->setSender(array($configuration->sendermail => $configuration->sendername))
							->setFrom(array($configuration->sendermail => $configuration->sendername))
							->setReplyTo($configuration->answermail)
							->setReturnPath($configuration->returnpath);
				$message->setBody($bodyFinal, 'text/html');
				$to=array($address->email => $address->first_name.' '.$address->last_name);
				$message->setTo($to);
				
				if($mailqueueElement->sent==0){
					$checktime=microtime(true);
					$mailqueueElement->assign(array(
						"mailbody"=>$bodyFinal,
						"sent"=>1
					));							
					$mailqueueElement->update();
					if(!$this->config['application']['dontSendReally']){
						try{
							$numSent+=$mailer->send($message, $failures);
						}catch(\Swift_TransportException $e){
							echo($e->getMessage());
						}
						
					}	
					//usleep(10000);
					$debug2=json_encode($to);
					
					$endtime=  microtime(true);
					$timeused=$endtime-$checktime;
					var_dump($failures);
					echo($counter.' : '.$address->uid.' <-> '.$timeused.'<br>');
					//file_put_contents('../app/logs/debuggerSend.csv',getmypid().' <--PID '.$timeused.' <-> '.$counter.' <-> '.$debug2.'        <->      '.$debug.PHP_EOL,FILE_APPEND);
				}
				$counter++;
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