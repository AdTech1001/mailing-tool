<?php
namespace nltool\Modules\Modules\Frontend\Controllers;
use nltool\Models\Addresses as Addresses,
	nltool\Models\Addressfolders as Addressfolders;
	

/**
 * Class AddressfoldersController
 *
 * @package baywa-nltool\Controllers
 */
class AddressfoldersController extends ControllerBase
{
	public function indexAction(){
		if($this->request->isPost()){
			$adressfolders=Addressfolders::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$addressfoldersArray=array();
			foreach($adressfolders as $adressfolder){
				$adressfolderAddresses=$adressfolder->countAddresses();
				$addressfoldersArray[]=array(
					'uid'=>$adressfolder->uid,
					'title'=>$adressfolder->title,
					'date' =>date('d.m.Y',$adressfolder->tstamp),
					'addresscount'=>$adressfolderAddresses
				);
						
			}
			$returnJson=json_encode($addressfoldersArray);
			echo($returnJson);
			die();
		}
	}
	
	public function updateAction()
	{
		$folderuid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
		$this->assets->addJs('js/vendor/addressfoldersInit.js');
		$this->assets->addCss('css/jquery.dataTables.css');
		
		if($this->request->isPost()){
			$result=$this->getData();
			$output=json_encode($result,true);			
			die($output);
		}
		$addressfolderrecord=  Addressfolders::findFirst(array(
			"conditions" => "uid = ?1",
			"bind" => array(1 => $folderuid)
			));
		$this->view->setVar('foldertitle',$addressfolderrecord->title);
		$this->view->setVar('folderuid',$folderuid);
	}
	
	private function getData(){
		
		$bindArray=array();
		$aColumns=array('email','lastname',	'firstname','salutation','title','company','phone','address','city','zip','userlanguage','gender');
        
        $aColumnsSelect=array('email', 'last_name AS lastname', 'first_name AS firstname', 'salutation', 'title', 'company', 'phone', 'address', 'city', 'zip', 'userlanguage', 'gender' );
        $aColumnsFilter=array('email', 'last_name', 'first_name', 'salutation', 'title', 'company', 'phone', 'address', 'city', 'zip', 'userlanguage', 'gender' );
		$time=time();
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "uid";

		/* DB table to use */
		$sTable = "nltool\Models\Addresses";
			/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".
				intval( $_POST['iDisplayLength'] );
		}


		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_POST['iSortCol_0'] ) )
		{
			$dateSort=false;
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ )
			{
				if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_POST['iSortCol_'.$i] ) ]." ".
						($_POST['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					if('date'==$aColumns[ intval( $_POST['iSortCol_'.$i] ) ]){
						$dateSort=true;
					}

				}
			}

			$sOrder=  substr($sOrder, 0,-2).' ';
			
		}


		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
			

		$sWhere = " WHERE pid = :pid: ";
		if ( isset($_POST['sSearch']) && $_POST['sSearch'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "".$aColumnsFilter[$i]." LIKE '%:searchTerm:%' OR "; //$_POST['sSearch']
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_POST['bSearchable_'.$i]) && $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}

				$sWhere .= "".$aColumnsFilter[$i]." LIKE '%:".$aColumnsFilter[$i].'_'.$i."%' "; //$_POST['sSearch_'.$i]
				$bindArray[$aColumnsFilter[$i].'_'.$i]=$this->request->getPost('sSearch_'.$i);
			}
		}

		
		

		/*
		 * SQL queries
		 * Get data to display
		 */
		$phql = "SELECT ".str_replace(" , ", " ", implode(", ", $aColumnsSelect)).", uid FROM $sTable ".$sWhere." ".$sOrder." ".$sLimit;
		
		
		
		$bindArray['pid']=$this->request->getPost('folderuid');
		//$bindArray['searchTerm']=$this->request->getPost('sSearch');
		
		$sQuery=$this->modelsManager->createQuery($phql);
		$rResults = $sQuery->execute($bindArray);		
		foreach ( $rResults as $aRow )
		{	
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
			
				
					/* General output */
					$rowArray=(array)$aRow;
					$row[] = $rowArray[ $aColumns[$i] ];
				
			
					
			}
			$resultSet[] = $row;
		}
		
		/* Data set length after filtering */		
		
		$rResultFilterTotal = count($resultSet);
		
		/* Total data set length */
		$lphql = "SELECT COUNT(".$sIndexColumn.") AS countids FROM $sTable	".$sWhere;
		$lQuery=$this->modelsManager->createQuery($lphql);
		$rResultTotal = $lQuery->execute($bindArray);        
		foreach ( $rResultTotal as $aRow )
		{
				$iTotal = (array)$aRow;
		}
		$iTotal=$iTotal['countids'];
	//$GLOBALS['TYPO3_DB']->sql_fetch_assoc($rResultTotal);
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $rResultFilterTotal,
			"aaData" => $resultSet
		);
		
		
		
		
		
	return  $output;
        
    }

}