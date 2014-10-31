<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addresses as Addresses,
	nltool\Models\Addressfolders as Addressfolders;	

/**
 * Class AddressesController
 *
 * @package baywa-nltool\Controllers
 */
class AddressesController extends ControllerBase
{
	public $_divider= array(';',',',':','	');
	public $_dataWrap=array('"',"'");
	function indexAction(){
		
	}
	
	function createAction(){
		
		$time=time();
		$this->assets->addJs('js/vendor/addressesInit.js');
		$addressfoldersRecords=Addressfolders::find(array(
			"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
		));
		$this->view->setVar('addressfolders',$addressfoldersRecords);
		$this->view->setVar('filehideshow','');
		$this->view->setVar('maphideshow','hidden');
		if($this->request->isPost()){			
			$this->view->setVar('filehideshow','hidden');
			$this->view->setVar('maphideshow','');
			

				if ($this->request->hasFiles() == true){
					$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

					$fileArray=$this->request->getUploadedFiles();
					$file=$fileArray[0];

					if(in_array($file->getType(), $mimes)){
						$nameArray=explode('.',$file->getName());
						$filetype=$nameArray[(count($nameArray)-1)];
						$tmpFile='../app/cache/tmp/'.$time.'_'.$file->getName();
						$file->moveTo($tmpFile);
						$row=0;
						
						if (($handle = fopen($tmpFile, "r")) !== FALSE) {
							$fileRowField=array();
							
							if($this->request->hasPost('firstRowFieldNames')){
								$data[$row] = fgetcsv($handle, 1000, $this->_divider[$this->request->getPost('divider')],$this->_dataWrap[$this->request->getPost('dataFieldWrap')]);
								$fileRowField=array_values($data[$row]);
							}else{
								
								while($row < 3){
									$data[$row] = fgetcsv($handle, 1000, $this->_divider[$this->request->getPost('divider')],$this->_dataWrap[$this->request->getPost('dataFieldWrap')]);																		
									$row++;		
								}
								
								for($i=0; $i<count($data[0]); $i++){
									
									$fileRowField[]=$data[0][$i].'<br>'.$data[1][$i].'<br>'.$data[2][$i];
								}
								
								
							}
							fclose($handle);
							
							
						}					
					}
					$this->view->setVar('divider',$this->request->getPost('divider'));
					$this->view->setVar('dataFieldWrap',$this->request->getPost('dataFieldWrap'));
					$this->view->setVar('tstamp',$time);
					$this->view->setVar('firstRowFieldNames', ($this->request->hasPost('firstRowFieldNames') ? 1 :0));
					$this->view->setVar('filename',$file->getName());
					$this->view->setVar('uploadfields',$fileRowField);
				}else{
					if($this->request->getPost('addressfolderCreate') != '' && $this->request->getPost('addressFoldersUid') ==0){
						$time=time();
						/*create the segment*/
						$addressfolder=new Addressfolders();
						$addressfolder->assign(array(
							'pid'=>0,
							'deleted'=>0,
							'hidden'=>0,
							'tstamp'=>$time,
							'crdate'=>$time,
							'cruser_id' => $this->session->get('auth')['uid'],
							'usergroup' => $this->session->get('auth')['usergroup'],
							'title'=>$this->request->getPost('addressfolderCreate','striptags'),
							'hashtags'=>'' //TODO
						));
						if (!$addressfolder->save()) {
							$this->flash->error($addressfolder->getMessages());
						}

						$row=0;
						$insStr='';
						$addressesDBFielMap=array(
							1=>'first_name',
							2=>'last_name',
							3=>'title',
							4=>'salutation',
							5=>'email',
							6=>'company',
							7=>'phone',
							8=>'address',
							9=>'city',
							10=>'zip',
							11=>'userlanguage',
							12=>'gender'
						);
						//Using Address Segment n:1 relation; lookup is there, but no mass insert possible 
						$insField='(pid,tstamp,crdate,cruser_id,usergroup';
						$indexArray=array();
						foreach($this->request->getPost('adressFieldsMap') as $addressFieldIndex=> $addressField){
							if(intval($addressField) !=0 && !is_nan(intval($addressField))){
								$insField.=','.$addressesDBFielMap[intval($addressField)];
								array_push($indexArray,$addressFieldIndex);
							}
						}
						$insField.=')';
						$basicInsVals=$addressfolder->uid.','.$time.','.$time.','.$this->session->get('auth')['uid'].','.$this->session->get('auth')['usergroup'];
						$tmpFile='../app/cache/tmp/'.$this->request->getPost('time').'_'.$this->request->getPost('filename');
						if (($handle = fopen($tmpFile, "r")) !== FALSE) {
							if($this->request->getPost('firstRowFieldNames')==1){
								$data = fgetcsv($handle, 1000, $this->_divider[$this->request->getPost('divider')],$this->_dataWrap[$this->request->getPost('dataFieldWrap')]);
							}
							while(($data = fgetcsv($handle, 1000, $this->_divider[$this->request->getPost('divider')],$this->_dataWrap[$this->request->getPost('dataFieldWrap')])) !== FALSE){


									$insStr.='('.$basicInsVals;
									foreach($data as $valueindex=> $value){
										if(in_array($valueindex, $indexArray)){
											if(is_numeric($value)){
												$insStr.=','.$value;
											}else{
												$insStr.=',"'.$value.'"';
											}								
										}
									}

									$insStr.='),';									
									if($row>0 && $row%500==0){
										$insStr=substr($insStr,0,-1);
										$this->di->get('db')->query("INSERT INTO Addresses ".$insField." VALUES ".$insStr);
										$insStr='';
									}							

								$row++;
							}
						
							if($data==false && $insStr!=''){

									$insStr=substr($insStr,0,-1);
									var_dump("INSERT INTO Addresses ".$insField." VALUES ".$insStr);
									$this->di->get('db')->query("INSERT INTO Addresses ".$insField." VALUES ".$insStr);

							}

							fclose($handle);
							unlink($tmpFile);
							
						}
						$this->response->redirect($this->view->language.'/addressfolders/update/'.$addressfolder->uid.'/'); 
					}


				}
		}else{
			$this->view->setVar('divider','');
			$this->view->setVar('dataFieldWrap','');
			$this->view->setVar('tstamp','');
			$this->view->setVar('filename','');
			$this->view->setVar('firstRowFieldNames','');
			$this->view->setVar('uploadfields',array());
		}
	}
}