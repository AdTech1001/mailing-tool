<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addresses as Addresses,
	nltool\Models\Addresssegmentobjects as Addresssegmentobjects;	

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
		$addresssegmentobjectsRecords=Addresssegmentobjects::find(array(
			"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
		));
		$this->view->setVar('addresssegmentobjects',$addresssegmentobjectsRecords);
		$this->view->setVar('filehideshow','');
		$this->view->setVar('maphideshow','hidden');
		if($this->request->isPost()){			
			$this->view->setVar('filehideshow','hidden');
			$this->view->setVar('maphideshow','');
			
			if ($this->request->hasPost('firstRowFieldNames')) {      
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
							}
							fclose($handle);
							var_dump($fileRowField);
							$this->view->setVar('tstamp',$time);
							$this->view->setVar('filename',$file->getName());
							$this->view->setVar('uploadfields',$fileRowField);
						}
						
					}
				}			
			}else{
				/*while (($data = fgetcsv($handle, 1000, $this->_divider[$this->request->getPost('divider')],$this->_dataWrap[$this->request->getPost('dataFieldWrap')])) !== FALSE) {
							$num = count($data);
							echo "<p> $num Felder in Zeile $row: <br /></p>\n";
							$row++;
							for ($c=0; $c < $num; $c++) {
								echo $data[$c] . "<br />\n";
							}
						}
						fclose($handle);*/
			}
		}
	}
}