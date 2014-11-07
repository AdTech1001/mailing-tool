<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Sendoutobjects;
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
    public function indexAction()
    {
		if(!$this->request->isPost()){
			$transport = \Swift_SmtpTransport::newInstance('smtp.iq-pi.org', 25)->setUsername('mailing@iq-pi.org')->setPassword('hpkYhxr&mdm7');
			$mailer = \Swift_Mailer::newInstance($transport);
			$mailer->registerPlugin(new \Swift_Plugins_AntiFloodPlugin(100,30));
			$time=time();
			//find mailings which are due
			$mailings= Sendoutobjects::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND reviewed=1 AND cleared=1 AND inprogress=0 AND sent=0 AND tstamp <= ?1",
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
					
					foreach($addresses as $address){
						$body=$this->renderVars($bodyRaw,$address);
						$message = \Swift_Message::newInstance($mailing->subject)
									->setFrom(array($configuration->sendermail => $configuration->sendername));
						$message->setBody($body, 'text/html');
						$message->setTo(array($address->email => $address->first_name.' '.$address->last_name));

					  //pull the trigger
					  $mailer->send($message, $failures);
					}
			}
			
			
			//generate mails as they are handed over to the smtp mailqueue
			//hand them over to smtp in chunks of X (Backend configuration) numbers
			
			
			
		}else{
			die('<img src="images/cowboy-shaking-head.gif" style="position:absolute;top:40%;left:40%;">');
		}
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