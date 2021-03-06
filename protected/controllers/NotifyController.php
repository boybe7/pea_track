<?php

class NotifyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','update','view','getNotify','content'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	
	public function actionIndex()
	{
		$model=new Notify;
		$model->unsetAttributes();  // clear any default values
		
		$this->render('index',array(
			'model'=>$model,
		));
	}

	public function actionContent()
	{
		
		
		$this->render('_content',array(
			
		));
	}

	 protected function gridDateRender($data,$row)
     {
          // ... generate the output for the column
 
          // Params:
          // $data ... the current row data   
         // $row ... the row index
         //print_r($data);

         $date = '';
         $str_date = explode("-", $data["date_end"]);
         if(count($str_date)>1)
            $date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

         return $date;    
    }       

	
	public function actionGetNotify()
	{
		$current_date = (date("Y")+543).date("-m-d");

		//print_r("SELECT * FROM payment_project_contract WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
		//DAY ),'".$current_date."')<7  AND (bill_date='' OR bill_date='0000-00-00')");
		$projectContractData=Yii::app()->db->createCommand("SELECT pj_name as project,pc_code as contract,'แจ้งเตือนครบกำหนดค้ำประกันสัญญา' as alarm_detail,pc_garantee_date as date_end, CONCAT('project/update/',pc_id) as url FROM project_contract pc LEFT JOIN project p ON pc.pc_proj_id=p.pj_id WHERE DATEDIFF(pc_garantee_date,'".$current_date."')<=7  AND (pc_garantee_end='')")->queryAll(); 

		$user_dept = Yii::app()->user->userdept;
		$paymentProjectData=Yii::app()->db->createCommand("SELECT pj_name as project,pc_code as contract, 'แจ้งเตือนครบกำหนดชำระเงินของ vendor' as alarm_detail,DATE_ADD( invoice_date, INTERVAL invoice_alarm
		DAY ) as date_end, CONCAT('paymentProjectContract/update/',id) as url  FROM payment_project_contract pay_p LEFT JOIN project_contract ON pay_p.proj_id=pc_id LEFT JOIN project ON pc_proj_id=pj_id LEFT JOIN user ON project.pj_user_create=user.u_id  WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
		DAY ),'".$current_date."')<=7  AND (bill_date='' OR bill_date='0000-00-00') AND user.department_id='$user_dept'")->queryAll(); 

		if(Yii::app()->user->isAdmin())
		{
			$paymentProjectData=Yii::app()->db->createCommand("SELECT pj_name as project,pc_code as contract, 'แจ้งเตือนครบกำหนดชำระเงินของ vendor' as alarm_detail,DATE_ADD( invoice_date, INTERVAL invoice_alarm
		DAY ) as date_end, CONCAT('paymentProjectContract/update/',id) as url  FROM payment_project_contract pay_p LEFT JOIN project_contract ON pay_p.proj_id=pc_id LEFT JOIN project ON pc_proj_id=pj_id  WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
		DAY ),'".$current_date."')<=7  AND (bill_date='' OR bill_date='0000-00-00')")->queryAll(); 

		}

		$paymentOutsourceData=Yii::app()->db->createCommand("SELECT pj_name as project,oc_code as contract, 'แจ้งเตือนครบกำหนดจ่ายเงินให้ supplier' as alarm_detail,DATE_ADD( invoice_receive_date, INTERVAL 10
		DAY ) as date_end, CONCAT('paymentOutsourceContract/update/',id) as url FROM payment_outsource_contract pay_p LEFT JOIN outsource_contract ON pay_p.contract_id=oc_id LEFT JOIN project ON oc_proj_id=pj_id WHERE DATEDIFF('".$current_date."',invoice_receive_date)>=10  AND (approve_date='' OR approve_date='0000-00-00')")->queryAll(); 

		
		
        if(date('d')>=20){

        	$month = date("n");
        	$number = cal_days_in_month(CAL_GREGORIAN, $month, date("Y"));

        	$lastDay = $number."/".$month."/".(date("Y")+543);


        	$projects = Project::model()->findAll();
        	$mangementCostData1 = array();
        	$mangementCostData2 = array();

        	foreach ($projects as $key => $project) {
        		$pid = $project->pj_id;
        		$sql = "SELECT * FROM management_cost  WHERE '$month'=MONTH(mc_date)  AND mc_type=1 AND mc_proj_id='$pid'";
	            
	        	$records = Yii::app()->db->createCommand($sql)->queryAll(); 
	        	if(count($records)==0)
	        	{
	        		//$mProj = Project::model()->findbyPk($);
	        		$mangement["project"] = $project->pj_name;
	        		$mangement["contract"] = "";
	        		$mangement["date_end"] = $lastDay;
	        		$mangement["url"] = "managementCost/create";
	        		$mangement["alarm_detail"] =  "แจ้งเตือนบันทึกค่าบริหารโครงการ ส่วนค่ารับรองประจำเดือน";
	        		$mangementCostData1[] = $mangement;
	        	}

	        	$sql = "SELECT * FROM management_cost  WHERE '$month'=MONTH(mc_date)  AND mc_type=2 AND mc_proj_id='$pid'";
	            
	        	$records = Yii::app()->db->createCommand($sql)->queryAll(); 
	        	if(count($records)==0)
	        	{
	        		//$mProj = Project::model()->findbyPk($);
	        		$mangement["project"] = $project->pj_name;
	        		$mangement["contract"] = "";
	        		$mangement["date_end"] = $lastDay;
	        		$mangement["url"] = "managementCost/create";
	        		$mangement["alarm_detail"] =  "แจ้งเตือนบันทึกค่าบริหารโครงการ ส่วนค่าใช้จริงประจำเดือน";
	        		$mangementCostData2[] = $mangement;
	        	}	
	            
        	}
	        	      
	        	

        	$records=array_merge($projectContractData , $paymentProjectData, $paymentOutsourceData,$mangementCostData1,$mangementCostData2);
		
        }  
        else
		   $records=array_merge($projectContractData , $paymentProjectData, $paymentOutsourceData);
		
		 //header('Content-type: text/plain');
		 //                         		 print_r($records);                    
		 //                         	     exit;	

		if (Yii::app()->request->isAjaxRequest)
	    {    
	    	//echo CJSON::encode(1);
	    	echo CJSON::encode(count($records));
	    }
	    else{
	    	return count($records);
	    }

	}


}
