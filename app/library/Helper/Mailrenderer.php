<?php
namespace nltool\Helper;
use Phalcon\Mvc\User\Component,
	nltool\Models\Linklookup;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailrenderhelpers
 *
 * @author Philipp-PC
 */
class Mailrenderer extends Component{
	public function writeClicktrackingLinks($body,$mailing){
		$this->mailingToRender=$mailing;
		
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
				"campaignuid"=>$this->mailingToRender->campaignuid,
				"mailobjectuid"=>$this->mailingToRender->mailobjectuid,
				"sendoutobjectuid"=>$this->mailingToRender->uid,
				"url"=>$matches[2],
				"addressuid"=>0
			));
			$jumplink->save();
			return $matches[1].'http://'.$this->request->getHttpHost().$this->baseUri.'linkreferer/'.$jumplink->uid.$matches[3];
		},$body);
		
		
		return $renderedbody;
	}
	
	public function renderFinal($body,$addressuid,$mailinguid){
				
		$this->currentaddressuid=$addressuid;
		$this->mailinguid=$mailinguid;
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$this->baseUri=$this->config['application'][$environment]['staticBaseUri'];		
		$renderedbody=preg_replace_callback('/(<a\s[^>]*href=\")([http|https][^\"]*)(\"[^>]*>)/siU', 'self::renderFinalCallback' ,$body);		
		$finalizedBody=preg_replace_callback('/<body[^>]*>/im',"self::addOpenmailerBlankImage",$renderedbody);
				
		return $finalizedBody;				
	}
	
	public function renderFinalCallback($matches){						
			return $matches[1].$matches[2].'/'.$this->currentaddressuid.$matches[3];
	}
	
	public function addOpenmailerBlankImage($matches){
		return $matches[0].'<img width="1" height="1" src="'.'http://'.$this->request->getHttpHost().$this->baseUri.'linkreferer/open/'.$this->mailinguid.'/'.$this->currentaddressuid.'">';
	}
	
	public function renderVars($body,$address){
		$fieldMap=array(
			'userid'=>'uid',
			'Userid'=>'uid',
			'Anrede' => 'salutation',
			'Vorname' => 'first_name',
			'Nachname' => 'last_name',
			'Titel' => 'title',
			'Unternehmen' => 'company',
			'Email' => 'email'
		); //TODO komplettieren
		
		preg_match_all('/{{(.*)}}/siU', $body, $matches);
		
		foreach($matches[0] as $key => $match){
			$body=str_replace($match, $address->$fieldMap[$matches[1][$key]], $body);
		}
		
		return $body;
	}
}

