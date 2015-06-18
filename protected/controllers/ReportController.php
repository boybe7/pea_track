<?php

class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
       

	/**
	 * Displays the progress page
	 */
	public function actionSummaryCashflow()
	{
		$this->render('summaryCashflow');
	}

	public function actionProgress()
	{
            		
		// display the progress form
		$this->render('progress');
	}

	public function actionService()
	{
            		
		// display the progress form
		$this->render('service');
	}

	public function actionStatement()
	{
            		
		// display the progress form
		$this->render('statement');
	}


	public function actionCashflow()
	{
            		
		// display the progress form
		$this->render('cashflow');
	}

	public function actionSummary()
	{
    	
		// display the progress form
		$this->render('summary');
	}

	 public function actionGenProgress()
    {
        $user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    	}
        $this->renderPartial('_formProgress2', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }

     public function actionGenCashflow()
    {
        
    	// $condition = "";
    	// if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"])) 
    	// 	$condition = " pj_fiscalyear=".$_GET["fiscalyear"];
    	// if(isset($_GET["workcat"]) && !empty($_GET["workcat"]))
    	// 	$condition .= " AND pj_work_cat=".$_GET["workcat"];
    	// if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	// 	$condition .= " AND pj_id=".$_GET["project"];


    	// if(isset($_GET["project"]) && !empty($_GET["project"]))    		
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    }
    	$monthBegin = $_GET["monthBegin"];
    	$monthEnd = $_GET["monthEnd"];
    	$yearBegin = $_GET["yearBegin"];
    	$yearEnd = $_GET["yearEnd"];

    	// header('Content-type: text/plain');
     //       echo($_GET["fiscalyear"]);                    
     //    exit;

        $this->renderPartial('_formCashflow', array(
            'model' => $model,'monthBegin'=>$monthBegin,'monthEnd'=>$monthEnd,'yearBegin'=>$yearBegin,'yearEnd'=>$yearEnd,
            'display' => 'block',
        ), false, true);

        
    }

    public function actionGenSummaryCashflow()
    {
        
    	
	    	// if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	// else
	    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    }
        $this->renderPartial('_formSummaryCashflow', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }

    function renderDate($value)
	{
	    $th_month = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $dates = explode("/", $value);
	    $d=0;
	    $mi = 0;
	    $yi = 0;
	    foreach ($dates as $key => $value) {
	         $d++;
	         if($d==2)
	            $mi = $value;
	         if($d==3)
	            $yi = $value;
	    }
	    if(substr($mi, 0,1)==0)
	        $mi = substr($mi, 1);
	    if(substr($dates[0], 0,1)==0)
	        $d = substr($dates[0], 1);
	    else
	        $d = $dates[0];

	    $renderDate = $d." ".$th_month[$mi]." ".substr($yi,2);
	    if($renderDate==0)
	        $renderDate = "";   

	    return $renderDate;             
	}

	function renderDate2($value)
	{
	    $th_month = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $dates = explode("-", $value);
	    $d=0;
	    $mi = 0;
	    $yi = 0;
	    foreach ($dates as $key => $value) {
	         $d++;
	         if($d==2)
	            $mi = $value;
	         if($d==1)
	            $yi = $value;
	    }
	    if(substr($mi, 0,1)==0)
	        $mi = substr($mi, 1);
	    if(substr($dates[2], 0,1)==0)
	        $d = substr($dates[2], 1);
	    else
	    	$d = $dates[2];

	    $renderDate = $d." ".$th_month[$mi]." ".$yi;
	    if($renderDate==0)
	        $renderDate = "";   

	    return $renderDate;             
	}

	public function actionGenSummaryExcel()
    {
    	   $model = Project::model()->findByPk($_GET["project"]);

		   Yii::import('ext.phpexcel.XPHPExcel');    
		   $objPHPExcel= XPHPExcel::createPHPExcel();
		   $objReader = PHPExcel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load("report/templateSummary.xls");

		    $title = new PHPExcel_Style();
		    $title->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,     
			            'bold'=>true,         
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			          
			            
			    ));
		    $header = new PHPExcel_Style();
			$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'64ED74')
			        ),
			            
			    ));

			$header2 = new PHPExcel_Style();
			$header2->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'F7E672')
			        ),
			            
			    ));

			$detail = new PHPExcel_Style();
			$detail->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            //'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        )			            
			    ));
			$detail_tb = new PHPExcel_Style();
			$detail_tb->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'top'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		   $row_start = 2;
		   $row = 2;
		    $pj = $model;
			//project contract
			$Criteria = new CDbCriteria();
			$Criteria->condition = "pc_proj_id='$pj->pj_id'";
			$pcs = ProjectContract::model()->findAll($Criteria);

		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"โครงการ ".$pcs[0]->pc_details);
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"ให้ ".$pj->pj_name);
		   $objPHPExcel->getActiveSheet()->setSharedStyle($title, "A".$row_start.":J".$row);
		   $objPHPExcel->getActiveSheet()->getStyle("A".$row_start.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		   
		   
		   $row++;
		   $row_pj = $row;
		   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':J'.$row);
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"ส่วนผู้ว่าจ้าง : ".$pj->pj_name);
		   $objPHPExcel->getActiveSheet()->setSharedStyle($header, "A".$row_pj.":J".($row-1));
		   $objPHPExcel->getActiveSheet()->getStyle("A".$row_pj.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		   
		   $row_detail = $row;
		   foreach ($pcs as $key => $pc) {
				//echo   "<tr><td width='30%'>ใบสั่งจ้างเลขที่ : ".$pc->pc_code."</td><td width='30%'>วันที่เริ่มในสัญญา : ".renderDate($pc->pc_sign_date)."</td><td width='50%' colspan=2>วันที่สิ้นสุดในสัญญา : ".renderDate($pc->pc_end_date)."</td></tr>";
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ใบสั่งจ้างเลขที่ : ".$pc->pc_code);
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"วันที่เริ่มในสัญญา : ".$this->renderDate($pc->pc_sign_date));

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"วันที่สิ้นสุดในสัญญา : ".$this->renderDate($pc->pc_end_date));
				$row++;
			}
		   	
		    //workcode
			$Criteria = new CDbCriteria();
			$Criteria->condition = "pj_id='$pj->pj_id'";
			$wcs = WorkCode::model()->findAll($Criteria);
			

			$i=0;
			$row_code = $row;
			foreach ($wcs as $key => $wc) {
				if($i==0)  
				  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"หมายเลขงาน : ".$wc->code);
				else
				  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"                   : ".$wc->code);
				$i++;
				$row++;
			}
			if($i==0)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"หมายเลขงาน : ");

			$row = $row_code;
			$i=0;
			$sum_pc_cost = 0;
			$check = false;
			foreach ($pcs as $key => $pc) {

				$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    

				$pcCost =$pc->pc_cost + $pp[0]["sum"];

				$sum_pc_cost += $pcCost;
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
			    
			    
			    if(!empty($pc->pc_name_request))
				{    	
				    $check = true;
				    if($i==0)  
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"แจ้งจัดสรรงบ กปง./กซข./กฟจ. : ".$pc->pc_name_request);
					else
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"                                          : ".$pc->pc_name_request);
				}
				else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"แจ้งจัดสรรงบ กปง./กซข./กฟจ. : ");
					
				}	
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
			    
			    if(!empty($pc->pc_code_request))
				{ 
				    $check = true;
				    if($i==0)  
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"เลขที่ส่ง / ลว. : ".$pc->pc_code_request);
					else
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"                            : ".$pc->pc_code_request);
				}
				else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"เลขที่ส่ง / ลว. : ");
					
				}	
				$i++;

				 $row++;	
			}
			

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_code,"วงเงิน : ".number_format($sum_pc_cost,2));
				
			$row = $objPHPExcel->getActiveSheet()->getHighestRow();
			if(!$check)
				$row--;
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail, "A".$row_detail.":J".($row));


			//table header
 // header('Content-type: text/plain');
 //                           		count($pcs);                    
 //                           	    exit;
			//$row = 10;
			$row++;
			$row_detail = $row;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.($row+1));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ที่");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':E'.($row));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ด้านการดำเนินการโครงการ");			
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':J'.($row));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ด้านการเงิน");
			$row++;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"รายละเอียด");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"อนุมัติโดย/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,"วงเงิน/เป็นเงินเพิ่ม");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,"ระยะเวลาแล้วเสร็จ/ระยะเวลาขอขยาย");
			
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ชำระเงินงวดที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"ใบแจ้งหนี้/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,"ใบเสร็จเลขที่/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน");
			$row++;
			
			$row_ap = $row;
			$row_pa = $row;
			$index = 1;
			$sum_pay = 0;
			foreach ($pcs as $key => $pc) {
				$approve = Yii::app()->db->createCommand()
	                            ->select('detail,approveBy,dateApprove,cost,timeSpend')
	                            ->from('contract_approve_history')
	                            ->where("contract_id='$pc->pc_id' AND type=1")
	                            ->queryAll();
	            foreach ($approve as $key => $value) {
			    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_ap,$index);
			    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_ap,$value["detail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_ap,$value["approveBy"]."\r".$this->renderDate2($value["dateApprove"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_ap,number_format($value["cost"],2));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_ap,$value["timeSpend"]);
					$index++;
			    	$row_ap++;
	            }
	            
	            $payment = Yii::app()->db->createCommand()
	                            ->select('*')
	                            ->from('payment_project_contract')
	                            ->where("proj_id='$pc->pc_id'")
	                            ->queryAll();                
	           
	            foreach ($payment as $key => $value) {
	            	
	        		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,$value["detail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_pa,$value["invoice_no"]."\r".$this->renderDate2($value["invoice_date"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_pa,$value["bill_no"]."\r".$this->renderDate2($value["bill_date"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($value["money"],2));
					$row_pa++;

					if($value["bill_no"]!=""){
               			$sum_pay += $value["money"];
               		}
	            }
			}
			$remain = $sum_pc_cost - $sum_pay;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row_pa.':I'.($row_pa));	
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,"              คงเหลือ");
		    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($remain,2));
					

			$row_tb = $row;
			$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;	
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "A".$row_detail.":E".($row-1));
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "G".$row_detail.":J".($row-1));
			$objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":J".($row-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getActiveSheet()->getStyle("D".$row_tb.":D".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle("J".$row_tb.":J".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":A".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("C".$row_tb.":C".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("H".$row_tb.":I".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            

            $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row-1))->getAlignment()->setWrapText(true);		   
		
            

            //----------------outsource-------------------------//
            $Criteria = new CDbCriteria();
			$Criteria->condition = "oc_proj_id='$pj->pj_id'";
			$ocs = OutsourceContract::model()->findAll($Criteria);


			$index = 0;

			foreach ($ocs as $key => $oc) {
			        $index++;
			        $row++;
			        $vendor = Vendor::model()->findByPk($oc->oc_vendor_id);	
					
			        $sum_oc_cost = 0;
					$pp = Yii::app()->db->createCommand()
				                                            ->select('SUM(cost) as sum')
				                                            ->from('contract_change_history')
				                                            ->where("contract_id='$oc->oc_id' AND type=2")
				                                            ->queryAll();
						                				///print_r($changeHists);
				    $oc->oc_cost = str_replace(",", "", $oc->oc_cost);    

					$sum_oc_cost =$oc->oc_cost + $pp[0]["sum"];

					
		            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':J'.$row);
				   	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ส่วนผู้รับจ้าง รายที่ ".$index." : ".$vendor->v_name);
				   	$objPHPExcel->getActiveSheet()->setSharedStyle($header2, "A".$row.":J".$row);
				   	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				    $row++;
				    $row_oc = $row;
				    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"สัญญาจ้างเลขที่ : ".$oc->oc_code);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"วันที่เริ่มในสัญญา : ".$this->renderDate($oc->oc_sign_date));

					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"วันที่สิ้นสุดในสัญญา : ".$this->renderDate($oc->oc_end_date));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน : ".number_format($sum_oc_cost,2));
				
					$row++;
					//po
					$Criteria = new CDbCriteria();
					$Criteria->condition = "contract_id='$oc->oc_id'";
					$pos = WorkCodeOutsource::model()->findAll($Criteria);
					
					//print_r($pos);
					
					$index2 = 1;
					foreach ($pos as $key => $po) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$index2);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"PO เลขที่ : ".$po->PO);
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':G'.$row);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"เลขที่ส่งแจ้งรับรองงบ กปง. : ".$po->letter);
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.$row.':I'.$row);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"เป็นเงิน : ".number_format($po->money,2));
					    $index2++;
					    $row++;
					}
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail, "A".$row_oc.":J".($row-1));

					$row_detail = $row;
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.($row+1));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ที่");
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':E'.($row));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ด้านการดำเนินการโครงการ");			
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':J'.($row));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ด้านการเงิน");
					$row++;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"รายละเอียด");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"อนุมัติโดย/ลงวันที่");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,"วงเงิน/เป็นเงินเพิ่ม");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,"ระยะเวลาแล้วเสร็จ/ระยะเวลาขอขยาย");
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ชำระเงินงวดที่");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"อนุมัติโดย");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,"วัน/เดือน/ปี");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน");
					$row++;

					$approve = Yii::app()->db->createCommand()
		                            ->select('detail,approveBy,dateApprove,cost,timeSpend')
		                            ->from('contract_approve_history')
		                            ->where("contract_id='$oc->oc_id' AND type=2")
		                            ->queryAll();
		            $row_ap = $row;
		            $index3 = 1;                
		            foreach ($approve as $key => $value) {
				    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_ap,$index3);
				    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_ap,$value["detail"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_ap,$value["approveBy"]."\r".$this->renderDate2($value["dateApprove"]));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_ap,number_format($value["cost"],2));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_ap,$value["timeSpend"]);
						$index3++;
				    	$row_ap++;
		            }
		                            
		        
			        $payment = Yii::app()->db->createCommand()
			                            ->select('*')
			                            ->from('payment_outsource_contract')
			                            ->where("contract_id='$oc->oc_id'")
		            	                ->queryAll();                
			        $sum_pay = 0;
			        $row_pa = $row;
			        foreach ($payment as $key => $value) {
			        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,$value["detail"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_pa,$value["approve_by"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_pa,$this->renderDate2($value["approve_date"]));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($value["money"],2));
						$row_pa++;

						if($value["approve_date"]!=""){
	               			$sum_pay += $value["money"];
	               		}
	               	}

	               	$remain = $sum_oc_cost - $sum_pay;
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row_pa.':I'.($row_pa));	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,"              คงเหลือ");
		    		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($remain,2));
						
		    		$row_tb = $row;
					$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;	
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "A".$row_detail.":E".($row-1));
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "G".$row_detail.":J".($row-1));
					$objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				    $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		            
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":J".($row-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		            $objPHPExcel->getActiveSheet()->getStyle("D".$row_tb.":D".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("J".$row_tb.":J".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":A".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("C".$row_tb.":C".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("H".$row_tb.":I".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            

		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row-1))->getAlignment()->setWrapText(true);		   
				
				    //$row++;
			}	   	

		    $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		    ob_end_clean();
			ob_start();

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="01simple.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');  //
			 Yii::app()->end(); 

    }	

    public function actionGenProgressExcel()
    {
			

    	   // if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	   // 		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	       // else
    	  	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	  	
    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    	}
	
		   Yii::import('ext.phpexcel.XPHPExcel');    
		   $objPHPExcel= XPHPExcel::createPHPExcel();
		   $objReader = PHPExcel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load("report/templateProgress.xls");


           		//fiscalyear
                $fiscalyear = array();

                foreach ($model as $key => $value) {
                	
                	//print_r($value);
                	if(!in_array($value->pj_fiscalyear."/".$value->pj_work_cat, $fiscalyear))
                	   $fiscalyear[] = $value->pj_fiscalyear."/".$value->pj_work_cat;
                

                }

                //print_r($model);
                $row = 3;

                $filapar = new PHPExcel_Style();
			    $filapar->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

				$sum = new PHPExcel_Style();
			    $sum->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'E070F4')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $normal = new PHPExcel_Style();
			    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $end_project = new PHPExcel_Style();
			    $end_project->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));



			    $cell_underline = array();
			    $cell_pc_end = array();
			    $cell_oc_end = array();

                asort($fiscalyear);
                //summary all
                    $sumall_pc_cost = 0;
                    $sumall_pc_receive = 0;
                     
                    $sumall_oc_cost = 0;
                    $sumall_oc_receive = 0;

                    $sumall_m_real = 0;
                    $sumall_m_type1 = 0;
                    $sumall_m_expect = 0;
                    $sumall_profit = 0;
                foreach ($fiscalyear as $key => $value) {
                	$data = explode("/", $value);
                	$year = $data[0];
                	$cat = $data[1];

                	$mWorkCat = WorkCategory::model()->findByPk($cat);

		   			// Rename sheet
		   			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':AD'.$row);
		      		$objPHPExcel->getActiveSheet()->setTitle('ปี '.$year);
		      		 $objPHPExcel->setActiveSheetIndex(0)
		             			->setCellValue('A'.$row, "ปี ".$year." ".$mWorkCat->wc_name);
                	// $objPHPExcel->setActiveSheetIndex(0)
		            			// ->setCellValue('A4', "1");
                	
                	$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":AD".$row);
                	//$objPHPExcel->getActiveSheet()->setSharedStyle($normal, "A4:AD4");

                	$maxPayment = 5;
                	$index = 1;

                	 //summary
                         $sum_pc_cost = 0;
                         $sum_pc_receive = 0;
                         $sum_pc_T = 0;
                         $sum_pc_A = 0;

                         $sum_oc_cost = 0;
                         $sum_oc_receive = 0;
                         $sum_oc_T = 0;
                         $sum_oc_A = 0;

                         $sum_m_real = 0;
                         $sum_m_type1 = 0;
                         $sum_m_expect = 0;
                         $sum_profit = 0;

                    $row++;     
                	foreach ($model as $key => $pj) {
                	  if($pj->pj_fiscalyear==$year && $pj->pj_work_cat==$cat)
                	  {
                	  		//project contract
	                	 $Criteria = new CDbCriteria();
	                     $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	                	 $pcs = ProjectContract::model()->findAll($Criteria);
                         $nPC = count($pcs);

                         //2.outsource contract
                         $Criteria = new CDbCriteria();
                         $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                         $ocs = OutsourceContract::model()->findAll($Criteria);
                         $nOC = count($ocs);

                         //management cost
                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=0";
                        $m_plan = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=2";
                        $m_real = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=1";
                        $m_type1 = ManagementCost::model()->findAll($Criteria);

                        //find tax
                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=2 AND mc_detail LIKE '%อากร%'";
                        $m_tax = ManagementCost::model()->findAll($Criteria);

                        //end

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=0")
                                            ->queryAll();
                        $sum_m_expect += $pp[0]["sum"];


                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=1")
                                            ->queryAll();
                        $m_type1_sum = $pp[0]["sum"];                    

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=2")
                                            ->queryAll();
                        $m_real_sum = $pp[0]["sum"];

                        $sum_m_real += $m_real_sum;
                        $sum_m_type1 += $m_type1_sum;
                        //profit
                        //1.income
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_project_contract')
                                            ->join('project_contract','proj_id=pc_id')
                                            ->where("pc_proj_id='$pj->pj_id'")
                                            ->queryAll();
                        //echo $pp[0]["sum"];
                        $income = $pp[0]["sum"];
                        
                        //1.outcome
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_outsource_contract')
                                            ->join('outsource_contract','contract_id=oc_id')
                                            ->where("oc_proj_id='$pj->pj_id'")
                                            ->queryAll();                    
                        $outcome = $pp[0]["sum"];                    
                        $m_profit = $income - $outcome - $m_type1_sum - $m_real_sum;

                        $sum_profit += $m_profit;

                         //end
                         $pcCost = 0;
                         $ocCost = 0;
                         	
                                	
                            	$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('A'.$row, $index);
		            			$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row, $pj->pj_name);	
		            			//workcode
		                			$Criteria = new CDbCriteria();
		                            $Criteria->condition = "pj_id='$pj->pj_id'";
		                			$workcodes = WorkCode::model()->findAll($Criteria);
		                			$row_i = $row;
		                			foreach ($workcodes as $key => $wc) {
		                				$row_i++;
		                				$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row_i, $wc->code);	
		            			
		                			}

		                			

		                		// 	if(!empty($pj->pj_CA))
		                		// 	{
		                		// 		$row_i++;
		                		// 		$objPHPExcel->setActiveSheetIndex(0)
		            						// ->setCellValue('B'.$row_i, $pj->pj_CA);	
		            					
		                		// 	}
		            			
		            			//draw PC
		                			
		                		$k = 0;
		                		$row_max = $row;
                            	foreach ($pcs as $key => $pc) {
                            			if($k==0)
                            				$row_pc = $row;
                            			else
                            				$row_pc = $row_max;				
                            			$k++;
                            				
	                            		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, $pc->pc_details);
		                                if(!empty($pc->pc_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-หนังสือค้ำประกัน ".$pc->pc_guarantee);
		                                if(!empty($pc->pc_garantee_end))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-เลขที่บันทึกส่งกองการเงิน ".$pc->pc_guarantee_end);
		                                
		                                if(!empty($pc->pc_PO))
		                                {
		                                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-".$pc->pc_PO);
		                               
		                                }	
		                                //อากร
			                			foreach ($m_tax as $key => $t) {
			                				
			                				$objPHPExcel->setActiveSheetIndex(0)
			            						->setCellValue('C'.$row_pc++, "-".$t->mc_detail." ".number_format($t->mc_cost,2)." บาท");	
			            			
			                			}
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_max, $pc->pc_code);
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_max, $this->renderDate($pc->pc_sign_date));
										

										
		                               	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($row_max+2), "ครบกำหนด");
		                               	$cell_underline[] = 'E'.($row_max+2);
		                               	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($row_max+3), $this->renderDate($pc->pc_end_date));

		                               	$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    

		                                $pcCost =$pc->pc_cost + $pp[0]["sum"];

		                                $sum_pc_cost += $pcCost;
		                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($row_max), number_format($pcCost,2));

		                                //draw Payment PC
			                            	$Criteria = new CDbCriteria();
			                                $Criteria->condition = "proj_id='$pc->pc_id'";
			                                $paymentProjs = PaymentProjectContract::model()->findAll($Criteria);
			                                $row_pay_pc = $row_max;
			                                foreach ($paymentProjs as $key =>$pay)
			                                {
			                                		
			                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($row_pay_pc), $pay->detail);
			                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($row_pay_pc), $pay->money);

			                                    	//find pay before
			                                    	$str_date = explode("/", $pay->invoice_date);
			                                        $invoice_date= "";
			                                        if(count($str_date)>1)
			                                            $invoice_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
			                                        $pp = Yii::app()->db->createCommand()
			                                            ->select('SUM(money) as sum')
			                                            ->from('payment_project_contract')
			                                            ->where('invoice_date < "'.$invoice_date.'" AND proj_id='.$pc->pc_id)
			                                            ->queryAll();
			                                            
			                                        //print_r($pay->invoice_date);    
			                                        $pay->money = str_replace(",", "", $pay->money);
			                                        $sum_pc_receive += $pay->money;

			                                        $pc_remain = $pcCost - $pay->money - $pp[0]["sum"];
			                                        if($pc_remain!=0)
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_pay_pc), number_format($pc_remain,2));
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_pay_pc), "-");

			                                        if(!empty($pay->invoice_date))
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->invoice_no.'('.$this->renderDate($pay->invoice_date).")");
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->invoice_no);
			                                        if(!empty($pay->bill_date))
			                                           $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.($row_pay_pc), $pay->bill_no.'('.$this->renderDate($pay->bill_date).")");
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->bill_no);
			                                        
			                                       
			                                        
			                                        $row_pay_pc++; 
			                                }

			                                      //cal %A
                                        //sum income;
                                        $data = Yii::app()->db->createCommand()
                                                            ->select('sum(money) as sum')
                                                            ->from('payment_project_contract')
                                                            ->where('proj_id=:id AND (bill_date!="" AND bill_date!="0000-00-00")', array(':id'=>$pc->pc_id))
                                                            ->queryAll();
                                                                                        
                                        $sum_income = $data[0]["sum"];

                                         $data = Yii::app()->db->createCommand()
                                                            ->select('sum(cost) as sum')
                                                            ->from('contract_change_history')
                                                            ->where('contract_id=:id  AND type=1', array(':id'=>$pc->pc_id))
                                                            ->queryAll();
                                                                                        
                                        $change = $data[0]["sum"];      

                                        // $data = Yii::app()->db->createCommand()
                                        //                  ->select('sum(money) as sum')
                                        //                  ->from('payment_outsource_contract')
                                        //                  ->where('contract_id=:id AND (approve_date!="" AND approve_date!="0000-00-00")', array(':id'=>$modelPC->pc_id))
                                        //                  ->queryAll();
                                                                                        
                                        // $sum_payment = $data[0]["sum"];  
                                        $cost = str_replace(",", "", $pc->pc_cost) + $change;
                                        $pc->pc_A_percent =number_format((1 - ($cost - $sum_income)/$cost)*100,2);//number_format(($cost - $sum_income)*100/$cost,2);


			                                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.($row_max), $pc->pc_T_percent);
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.($row_max), $pc->pc_A_percent);
			                                        	$sum_pc_T += $pc->pc_T_percent;
			                                            $sum_pc_A += $pc->pc_A_percent;
			                            
		                               	$row_max = $objPHPExcel->getActiveSheet()->getHighestRow() + 2;	
		                               	if(count($pcs)>1) 
		                               	  $cell_pc_end[] = $row_max - 1;                              
		                            }    


                            	                               
                                	//draw OC
                                    $k = 0;
		                			$row_max = $row;
                            		foreach ($ocs as $key => $oc) {
                            			if($k==0)
                            				$row_oc = $row;
                            			else
                            				$row_oc = $row_max;				
                            			$k++;
                            				
                            			$vendor = vendor::model()->findByPk($oc->oc_vendor_id);
	                            		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.($row_max), $vendor->v_name);
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_max), $oc->oc_detail);
                                        
                                        $row_oc++;
		                                if(!empty($oc->oc_PO))
		                                {
		                                    $oc->oc_PO = str_replace("PO", "", $oc->oc_PO);
		                                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_PO);
                                        
		                                }
		                                if(!empty($oc->oc_letter))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_letter);
                                        
		                                	//echo "-หนังสือสั่งจ้าง ".$oc->oc_letter."<br>";
		                                if(!empty($oc->oc_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_guarantee);
                                        
		                                	//echo "-หนังสือค้ำประกัน ".$oc->oc_guarantee."<br>";
		                                if(!empty($oc->oc_guarantee_cf))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_guarantee_cf);
                                        
		                                	//echo "-หนังสือยืนยันค้ำประกัน ".$oc->oc_guarantee_cf."<br>";
		                                if(!empty($oc->oc_adv_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_adv_guarantee);
                                        
		                                	//echo "-หนังสือค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee."<br>";
		                                if(!empty($oc->oc_adv_guarantee_cf))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_adv_guarantee_cf);
                                        
		                                	//echo "-หนังสือยืนยันค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee_cf."<br>";
		                                
		                                if(!empty($oc->oc_insurance))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_insurance."(".$this->renderDate($oc->oc_insurance_start)."-".$this->renderDate($oc->oc_insurance_end).")");
                                        
		                                	//echo "-กรมธรรม์ประกันภัย ".$oc->oc_insurance."(".renderDate($oc->oc_insurance_start)."-".renderDate($oc->oc_insurance_end).")<br>";
		                                	
				                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row_max, $oc->oc_code);
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$row_max, $this->renderDate($oc->oc_sign_date));
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$row_max, $this->renderDate($oc->oc_end_date));
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$row_max, $this->renderDate($oc->oc_approve_date));
                                                                                

		                                $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    
                                        $oc->oc_cost = str_replace(",", "", $oc->oc_cost);
		                                $ocCost =$oc->oc_cost + $pp[0]["sum"];

		                                $sum_oc_cost += $ocCost; 

		                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$row_max, number_format($ocCost,2));
                                         
		                                //echo "<td rowspan='".$maxPayment."' style='text-align:right'>".number_format($ocCost,2)."</td>";

		                                //draw Payment OC
		                            	$Criteria = new CDbCriteria();
		                                $Criteria->condition = "contract_id='$oc->oc_id'";
		                                $paymentProjs = PaymentOutsourceContract::model()->findAll($Criteria);
		                                $row_pay_oc = $row_max;
		                                foreach ($paymentProjs as $key => $pay)
		                                {
		                                		
		                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.($row_pay_oc), $pay->detail);
			                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($row_pay_oc), $pay->money);
			                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.($row_pay_oc), $this->renderDate($pay->approve_date));

		                                    	//find pay before
		                                    	$str_date = explode("/", $pay->invoice_receive_date);
		                                        $invoice_date= "";
		                                        if(count($str_date)>1)
		                                            $invoice_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
		                                        $pp = Yii::app()->db->createCommand()
		                                            ->select('SUM(money) as sum')
		                                            ->from('payment_outsource_contract')
		                                            ->where('invoice_receive_date < "'.$invoice_date.'" AND contract_id='.$oc->oc_id)
		                                            ->queryAll();
		                                            
		                                        //print_r($pp);    
		                                        $pay->money = str_replace(",", "", $pay->money);
		                                        $sum_oc_receive += $pay->money;
		                                        $oc_remain = $ocCost - $pay->money - $pp[0]["sum"];

		                                        if($oc_remain!=0)
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_pay_oc), number_format($oc_remain,2));
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_pay_oc), "-");

		                                } 

		                                   //cal %A
                                                        //sum income;
                                                        

                                                         $data = Yii::app()->db->createCommand()
                                                                            ->select('sum(cost) as sum')
                                                                            ->from('contract_change_history')
                                                                            ->where('contract_id=:id  AND type=2', array(':id'=>$oc->oc_id))
                                                                            ->queryAll();
                                                                                                        
                                                        $change = $data[0]["sum"];      

                                                        $data = Yii::app()->db->createCommand()
                                                                         ->select('sum(money) as sum')
                                                                         ->from('payment_outsource_contract')
                                                                         ->where('contract_id=:id AND (approve_date!="" AND approve_date!="0000-00-00")', array(':id'=>$oc->oc_id))
                                                                         ->queryAll();
                                                                                                        
                                                        $sum_payment = $data[0]["sum"];  
                                                        $cost = str_replace(",", "", $oc->oc_cost) + $change;
                                                        $oc->oc_A_percent =number_format((1 - ($cost - $sum_payment)/$cost)*100,2);//number_format(($cost - $sum_income)*100/$cost,2);

		                                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.($row_max), $oc->oc_T_percent);
			                             $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.($row_max), $oc->oc_A_percent);
			                             $sum_oc_T += $oc->oc_T_percent;
			                             $sum_oc_A += $oc->oc_A_percent;       

		                                $row_max = $objPHPExcel->getActiveSheet()->getHighestRow() + 2;	 
		                               	if(count($ocs)>1)
		                               	$cell_oc_end[] = $row_max - 1;

				                	}
                            	
                            	//management cost
                                $row_ma = $row;
                                foreach ($m_plan as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }

                                $row_ma = $row;
                                foreach ($m_type1 as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }
                                $row_ma = $row;
                                foreach ($m_real as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }	
                                 
                                if($m_profit!=0)
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($row), number_format($m_profit,2));
			                	

                                $row_i = $objPHPExcel->getActiveSheet()->getHighestRow()+2;
                                //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_i, "end");
                                
		            			$objPHPExcel->getActiveSheet()->setSharedStyle($normal, "A".$row.":AD".$row_i);					
                				$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "A".($row_i-1).":AD".($row_i));

                				$objPHPExcel->getActiveSheet()->getStyle("D".$row.':E'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("J".$row.':M'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("P".$row.':S'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("W".$row.':W'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("Y".$row.':Z'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							    
                				//money format
                				
                				$objPHPExcel->getActiveSheet()->getStyle("F".$row.':F'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            	$objPHPExcel->getActiveSheet()->getStyle("H".$row.':I'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								$objPHPExcel->getActiveSheet()->getStyle("T".$row.':T'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								
								$objPHPExcel->getActiveSheet()->getStyle("V".$row.':V'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								$objPHPExcel->getActiveSheet()->getStyle("X".$row.':X'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		
								$objPHPExcel->getActiveSheet()->getStyle("AA".$row.':AD'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
																

								foreach ($cell_pc_end as $key => $value) {
									$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "C".$value.":M".$value);
							   
								}
								foreach ($cell_oc_end as $key => $value) {
									$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "N".$value.":AD".$value);
							   
								}
							    $row = $row_i;   
								$index++;
                	  }
                	}  

                	//summary
                	 $sumall_pc_cost += $sum_pc_cost;
                     $sumall_pc_receive += $sum_pc_receive;
                     $sumall_oc_cost += $sum_oc_cost;
                     $sumall_oc_receive += $sum_oc_receive;

                     $sumall_m_real += $sum_m_real;
                     $sumall_m_type1 += $sum_m_type1;
                     $sumall_m_expect += $sum_m_expect;
                     $sumall_profit += $sum_profit;

                	 $row_i = $objPHPExcel->getActiveSheet()->getHighestRow();
                	 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row_i.':B'.$row_i);
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($row_i), "รวมเป็นจำนวนเงิน");
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($row_i), number_format($sum_pc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($row_i), number_format($sum_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_i), number_format($sum_pc_cost - $sum_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.($row_i), number_format($sum_oc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($row_i), number_format($sum_oc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_i), number_format($sum_oc_cost - $sum_oc_receive,2));
 
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($row_i), number_format($sum_m_expect,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($row_i), number_format($sum_m_type1,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($row_i), number_format($sum_m_real,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($row_i), number_format($sum_profit,2));
                	 $objPHPExcel->getActiveSheet()->setSharedStyle($sum, "A".($row_i).":AD".($row_i));
					 $objPHPExcel->getActiveSheet()->getStyle("A".$row_i.':B'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					 $objPHPExcel->getActiveSheet()->getStyle("C".$row_i.':AD'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			 		 $row++;	
			                	
		      	}	

		      	$row_i = $objPHPExcel->getActiveSheet()->getHighestRow() + 1;
                	 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row_i.':B'.$row_i);
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($row_i), "รวมเป็นจำนวนเงินทั้งหมด");
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($row_i), number_format($sumall_pc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($row_i), number_format($sumall_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_i), number_format($sumall_pc_cost - $sumall_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.($row_i), number_format($sumall_oc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($row_i), number_format($sumall_oc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_i), number_format($sumall_oc_cost - $sumall_oc_receive,2));
 
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($row_i), number_format($sumall_m_expect,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($row_i), number_format($sumall_m_type1,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($row_i), number_format($sumall_m_real,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($row_i), number_format($sumall_profit,2));
                	 $objPHPExcel->getActiveSheet()->setSharedStyle($sum, "A".($row_i).":AD".($row_i));
					 $objPHPExcel->getActiveSheet()->getStyle("A".$row_i.':B'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					 $objPHPExcel->getActiveSheet()->getStyle("C".$row_i.':AD'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			 		 
		   
		      	$styleArray = array(
										  'font' => array(
										    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
										  )
							);
		      	foreach ($cell_underline as $key => $value) {
		      		$objPHPExcel->getActiveSheet()->getStyle($value)->applyFromArray($styleArray);
		          
		      	}
		      	                      	
		      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		    $objPHPExcel->setActiveSheetIndex(0);
		  	 
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);


		  //?????important clear cabage
		ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  //
		 Yii::app()->end(); 
        
    }

    


    public function actionGenSummary()
    {
        
    	
    	// if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	$model = Project::model()->findByPk($_GET["project"]);
        $this->renderPartial('_formSummary', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }

    public function actionPrintSummary()
    {
        
    	
    	// if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	$model = Project::model()->findByPk($_GET["project"]);
        $this->render('_formSummaryPDF', array(
            'model' => $model,
            
        ));

        
    }

    public function actionPrintCashflow()
    {
        
    	
     //    if(isset($_GET["project"]) && !empty($_GET["project"]))    		
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    	}
    	$monthBegin = $_GET["monthBegin"];
    	$monthEnd = $_GET["monthEnd"];
    	$yearBegin = $_GET["yearBegin"];
    	$yearEnd = $_GET["yearEnd"];

    	// header('Content-type: text/plain');
     //       echo($_GET["fiscalyear"]);                    
     //    exit;

        $this->renderPartial('_formCashflowPDF', array(
            'model' => $model,'monthBegin'=>$monthBegin,'monthEnd'=>$monthEnd,'yearBegin'=>$yearBegin,'yearEnd'=>$yearEnd,
            'display' => 'block',
        ));

        
    }

    public function actionPrintSummaryCashflow()
    {
        
    	
    	//  if(isset($_GET["project"]) && !empty($_GET["project"]))    		
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	
    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    	}
        $this->render('_formSummaryCashflowPDF', array(
            'model' => $model,'fiscalyear'=>$_GET["fiscalyear"]
            
        ));

        
    }

    public function actionPrintProgress()
    {
        
    	
    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    	}
        $this->render('_formProgressPDF', array(
            'model' => $model
            
        ));

        
    }

    public function actionGenCashflowExcel()
    {
			

    	// if(isset($_GET["project"]) && !empty($_GET["project"]))    		
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

    	$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    }

    	$monthBegin = $_GET["monthBegin"];
    	$monthEnd = $_GET["monthEnd"];
    	$yearBegin = $_GET["yearBegin"];
    	$yearEnd = $_GET["yearEnd"];
	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		//$objReader = PHPExcel_IOFactory::createReader('Excel5');
        //$objPHPExcel = $objReader->load("report/templateSummaryCashflow.xls");

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 18,   
			            'bold'  => true,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 
		$tableHead = new PHPExcel_Style();
	    $tableHead->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
			             'bold'  => true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
			            	'top'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		$tableHeadOne = new PHPExcel_Style();
	    $tableHeadOne->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
			             'bold'  => true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			         'borders' => array(
			            	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_DOTTED ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		$cashsum = new PHPExcel_Style();
	    $cashsum->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
			                          
			            'color' => array(
			            'rgb'   => 'ff0000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
			            	'top'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_DOUBLE ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		$normal = new PHPExcel_Style();
	    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
			            	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_DOTTED ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		$end = new PHPExcel_Style();
	    $end->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
			            	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));
		

		
		$month_th = array("1" => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม","4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน","7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน","10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");

		if($monthBegin==$monthEnd && $yearBegin==$yearEnd)
		    $monthBetween = $month_th[$monthBegin]." ".$yearBegin;
		else if($yearBegin==$yearEnd)
			$monthBetween = $month_th[$monthBegin]."-".$month_th[$monthEnd]." ".$yearEnd;
		else
		    $monthBetween = $month_th[$monthBegin]." ".$yearBegin."-".$month_th[$monthEnd]." ".$yearEnd;

		$number = cal_days_in_month(CAL_GREGORIAN, $monthEnd, $yearEnd-543);
		$monthBegin2 = $monthBegin<10 ? "0".$monthBegin : $monthBegin;
		$monthEnd2 = $monthEnd<10 ? "0".$monthEnd : $monthEnd;
		$dayBegin = $yearBegin."-".$monthBegin2."-"."01";

		$number = $number<10 ? "0".$number : $number;
		$dayEnd = $yearEnd."-".$monthEnd2."-".$number;
		$monthCondition = " BETWEEN '".$dayBegin."' AND '".$dayEnd."'";

		$sheet = 0;
		$sumPayPCAll = 0;
		$sumPayOCAll = 0;
		foreach ($model as $key => $pj) {
			    $objPHPExcel->createSheet($sheet);
			    //$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("PJ".($sheet+1));
				$pjname = str_replace("บริษัท", "", $pj->pj_name);
				//$pjname = explode(" ", $pjname);

				$pj_sheetname = iconv_substr($pjname, 0,30, "UTF-8");;
				//echo $pj_sheetname."<br>"; 
					 ///header('Content-type: text/plain');
            //echo($pj_sheetname);                    
         //exit;
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle($pj_sheetname);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(15);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(25);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('D')->setWidth(15);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('E')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('F')->setWidth(25);		   	      

				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A1:F1");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "สรุปรายได้/ค่าใช้จ่าย");
				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells('A2:F2');
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A2', $pj->pj_name);
				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells('A3:F3');
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A3', "ประจำเดือน ".$monthBetween);
				$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, 'A1:F3');
				$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				//table header
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A4', "วดป.\nใบเสร็จรับเงิน");
				$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B4', "รายการ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C4', "จำนวนเงิน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D4', "วดป.\nอนุมัติรับเงิน");
				$objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setWrapText(true);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E4', "รายการ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F4', "รายจ่าย");
				$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHead, 'A4:F4');
				$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			
				$row = 5;
				//project contract
	    		$Criteria = new CDbCriteria();
	            $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	            $pcs = ProjectContract::model()->findAll($Criteria);
	            $rowPCname = array();
	            $rowPCnameOC = array();
	            $rowPCnameOne = array();
	            $rowRemain = array();
	            $rowRemainOC = array();
	            $rowMaxPC = 0;
	            $sumPayPCAll = 0;
	            if(count($pcs)==1)
	            {
	            	$sumPayPC = 0;
	            	$rowPCnameOne[] = $row;
	            	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, "วงเงินสัญญา");
	            	$pc = $pcs[0];
	            	$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
                    $costPC = $pp[0]["sum"] + $pc->pc_cost;                      

	            	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, number_format($costPC,2));	
	           		$rowPC = $row;
	           		$rowPC++;
		            	//pc payment
		            	$Criteria = new CDbCriteria();
                		$Criteria->condition = "proj_id='$pc->pc_id' AND bill_date!='' AND bill_date ".$monthCondition;
                		$payment = PaymentProjectContract::model()->findAll($Criteria);

                		foreach ($payment as $key => $pay) {
                			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$rowPC,$this->renderDate($pay->bill_date));
                			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$rowPC,$pay->detail);
	            			$money = str_replace(",", "", $pay->money);
		        			$sumPayPC += $money;
		        			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$rowPC,number_format($money,2));
	            			$rowPC++;
                		}

                		
 						$rowPC++;
 						$rowPC += 2;
                	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$rowPC,"คงเหลือค้างรับ");

                	$rowRemain[] = $rowPC;
                	$rm = $costPC-$sumPayPC==0 ? "-": number_format($costPC-$sumPayPC,2);
		        	$sumPayPCAll += $sumPayPC;
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$rowPC,$rm);
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'A'.$row.":C".$rowPC);
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'C'.$rowPC);
 						    
	            }
	            else{
	            	$rowPC = $row;
	            	
	            	$iPC = 0;
	            	foreach ($pcs as $key => $pc) {
	            		$rowPCname[] = $rowPC;
	            		$sumPayPC = 0;
	            		$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A".$rowPC.":B".$rowPC);
	            		$vendor = Vendor::model()->findByPk($pc->pc_vendor_id);
	            		$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$rowPC,$vendor->v_name);
		            
		            	$pp = Yii::app()->db->createCommand()
	                                            ->select('SUM(cost) as sum')
	                                            ->from('contract_change_history')
	                                            ->where("contract_id='$pc->pc_id' AND type=1")
	                                            ->queryAll();
	                    $costPC = $pp[0]["sum"] + $pc->pc_cost;                      

		            	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$rowPC, number_format($costPC,2));	
	            		$rowPC++;
		            	//pc payment
		            	$Criteria = new CDbCriteria();
                		$Criteria->condition = "proj_id='$pc->pc_id' AND bill_date!='' AND bill_date ".$monthCondition;
                		$payment = PaymentProjectContract::model()->findAll($Criteria);

                		foreach ($payment as $key => $pay) {
                			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$rowPC,$this->renderDate($pay->bill_date));
                			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$rowPC,$pay->detail);
	            			$money = str_replace(",", "", $pay->money);
		        			$sumPayPC += $money;
		        			$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$rowPC,number_format($money,2));
	            			$rowPC++;
                		}
                		$iPC ++;

                		$rowPC += 2;
                		$rowRemain[] = $rowPC;
                	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$rowPC,"คงเหลือค้างรับ");
                	$rm = $costPC-$sumPayPC==0 ? "-": number_format($costPC-$sumPayPC,2);
		        	$sumPayPCAll += $sumPayPC;
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$rowPC,$rm);
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'A'.$row.":C".$rowPC);
		        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'C'.$rowPC);
	
 						$rowPC += 2;	               			
                		
	            	}

	            	

		        	$rowPC += 2;
 						
	            }

	            


	            //outsource
	            $rowOC = 5;
	            $Criteria = new CDbCriteria();
                $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                $ocs = OutsourceContract::model()->findAll($Criteria);
                $sumPayOCAll = 0;
                foreach ($ocs as $key => $oc) {
                	$sumPayOC = 0;
                	$vendor = Vendor::model()->findByPk($oc->oc_vendor_id);
                	$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll();
                    $costOC = $pp[0]["sum"] + str_replace(",", "", $oc->oc_cost); 

                	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$rowOC,$vendor->v_name);
                	$rowPCnameOC[] = $rowOC;
                	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$rowOC,number_format($costOC,2));
                	$rowOC++;

                	//payment
                	$Criteria = new CDbCriteria();
                	$Criteria->condition = "contract_id='$oc->oc_id' AND approve_date!='' AND approve_date ".$monthCondition;
                	$paymentOC = PaymentOutsourceContract::model()->findAll($Criteria);
                	foreach ($paymentOC as $key => $pay) {
                		$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$rowOC,$this->renderDate($pay->approve_date));
                		$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$rowOC,$pay->detail);
                		$money = str_replace(",", "", $pay->money);
		        		$sumPayOC += $money;
		        		$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$rowOC,number_format($money,2));
                		
                		$rowOC++;


                	}

                	
                	$rowOC += 2;
	                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$rowOC,"ค้างจ่าย");
	                $rowRemainOC[] = $rowOC;
	                	$rm = $costOC-$sumPayOC==0 ? "-": number_format($costOC-$sumPayOC,2);
			        	$sumPayOCAll += $sumPayOC;
			        	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$rowOC,$rm);
			        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'D'.$row.":F".$rowOC);
			        	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'F'.$rowOC);


                	$rowOC+=2;
                }
                $row = $objPHPExcel->getActiveSheet()->getHighestRow()+2;

                $row_max = $objPHPExcel->getActiveSheet()->getHighestRow()+5;
                $rowN = count($rowRemain)>0 ? count($rowRemain)-1:count($rowRemain);
                $rowNOC = count($rowRemainOC)>0 ? count($rowRemainOC)-1:count($rowRemainOC);
                $rowMaxPC = count($rowRemain)<0 ? 5 : $rowRemain[$rowN];
                
                $rowMaxOC = empty($rowRemainOC) ? 5 :  $rowRemainOC[$rowNOC];

                //summary
                $rowSum = $row;
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row,'รวมรายรับ ณ เดือน '.$month_th[$monthEnd].' '.$yearEnd);
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($sumPayPCAll,2));
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,'รวมรายจ่าย ณ เดือน '.$month_th[$monthEnd].' '.$yearEnd);
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row,number_format($sumPayOCAll,2));
                $row++;
                //management
                         $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type!=0 AND mc_date ".$monthCondition)
                                            ->queryAll();
                        $m_sum = $pp[0]["sum"];
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,'ค่าบริหารโครงการ เดือน '.$month_th[$monthEnd].' '.$yearEnd);
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row,number_format($m_sum,2));
                $row++;
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,'กำไร/ขาดทุน');
                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row,number_format($sumPayPCAll-$sumPayOCAll-$m_sum,2));


                
                $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'A'.$rowMaxPC.":C".$row_max);                
			    $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'D'.$rowMaxOC.":F".$row_max); 	
			    $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($end, 'A'.$row_max.":F".$row_max);


			    $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHeadOne, 'A'.$rowSum.':F'.$row);
 				$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'F'.$row);

                foreach ($rowPCname as $key => $r) {
	            	//set style projectname
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHeadOne, 'A'.$r.':C'.$r);

	            }
	            foreach ($rowPCnameOne as $key => $r) {
	            	//set style projectname
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHeadOne, 'A'.$r.':C'.$r);

	            }
                foreach ($rowRemain as $key => $row) {
                	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'C'.$row);
                }
                foreach ($rowRemainOC as $key => $row) {
                	$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'F'.$row);
                }
                foreach ($rowPCnameOC as $key => $r) {
	            	//set style projectname
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHeadOne, 'D'.$r.':F'.$r);

	            }


	            $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C5:C256')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	            $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('F5:F256')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

			$sheet++;	
		}	

		///header('Content-type: text/plain');
         //   echo($pj_sheetname);                    
         //exit;
		ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
        
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  //
		Yii::app()->end(); 
    }       

    public function actionGenSummaryCashflowExcel()
    {
			

    	// if(isset($_GET["project"]) && !empty($_GET["project"]))    		
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
    	// 	$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
    	// else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
    	// else
    	//     $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

		$user_dept = Yii::app()->user->userdept;
        if(!Yii::app()->user->isExecutive())
		{

			if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"].' AND user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)','join'=>'LEFT JOIN user ON pj_user_create=user.u_id LEFT JOIN work_category ON wc_id=pj_work_cat', 'condition'=>'user.department_id='.$user_dept.' AND work_category.department_id='.$user_dept, 'params'=>array()));	
	    

		}
		else
		{	
	    	if(isset($_GET["project"]) && !empty($_GET["project"]))    		
	    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && empty($_GET["fiscalyear"]))   
	    		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"], 'params'=>array()));	
	    	else if(isset($_GET["workcat"]) && !empty($_GET["workcat"]) && isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_work_cat='.$_GET["workcat"].' AND pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else if(isset($_GET["fiscalyear"]) && !empty($_GET["fiscalyear"]))  
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_fiscalyear='.$_GET["fiscalyear"], 'params'=>array()));	 	
	    	else
	    	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
	    }	
		   Yii::import('ext.phpexcel.XPHPExcel');    
		   $objPHPExcel= XPHPExcel::createPHPExcel();
		   $objReader = PHPExcel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load("report/templateSummaryCashflow.xls");


           		//fiscalyear
                $fiscalyear = array();

                foreach ($model as $key => $value) {
                	
                	//print_r($value);
                	if(!in_array($value->pj_fiscalyear."/".$value->pj_work_cat, $fiscalyear))
                	   $fiscalyear[] = $value->pj_fiscalyear."/".$value->pj_work_cat;
                

                }

                //print_r($model);
                $row =1;

                $filapar = new PHPExcel_Style();
			    $filapar->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

				$sum = new PHPExcel_Style();
			    $sum->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'E070F4')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $normal = new PHPExcel_Style();
			    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $right = new PHPExcel_Style();
			    $right->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $left = new PHPExcel_Style();
			    $left->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				                        
			        	)
			    ));

			    $bottom_right = new PHPExcel_Style();
			    $bottom_right->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));


			    $bottom_left = new PHPExcel_Style();
			    $bottom_left->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));
			    $bottom = new PHPExcel_Style();
			    $bottom->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $end_project = new PHPExcel_Style();
			    $end_project->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));



			    $cell_underline = array();
			    $cell_pc_end = array();
			    $cell_oc_end = array();
			    $row = 4;
                asort($fiscalyear);

                //summary all
                $sumall_pc_cost = 0;
                $sumall_pc_receive = 0;
                         
                $sumall_oc_cost = 0;
                $sumall_oc_receive = 0;
                       
                $sumall_m_real = 0;
                $sumall_m_type1 = 0;
                $sumall_m_expect = 0;


                foreach ($fiscalyear as $key => $value) {
                	$data = explode("/", $value);
                	$year = $data[0];
                	$cat = $data[1];

                	$mWorkCat = WorkCategory::model()->findByPk($cat);

		   			// Rename sheet
		      		$objPHPExcel->getActiveSheet()->setTitle('ปี '.$year);
		      		
		      		//title 
		      		$objPHPExcel->setActiveSheetIndex(0)
		             			->setCellValue('A1', "สรุปงานรายรับ-รายจ่ายงานโครงการปี  ".$year);
                	
                	//workcategory
                	
                	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':P'.$row);
                	$objPHPExcel->setActiveSheetIndex(0)
		             			->setCellValue('A'.$row, $mWorkCat->wc_name);
                	$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":P".$row);
                	
                	$index = 1;

                	//summary
                    $sum_pc_cost = 0;
                    $sum_pc_receive = 0;
                         
                    $sum_oc_cost = 0;
                    $sum_oc_receive = 0;
                       
                    $sum_m_real = 0;
                    $sum_m_type1 = 0;
                    $sum_m_expect = 0;

                    $row++;     
                	foreach ($model as $key => $pj) {
                	  if($pj->pj_fiscalyear==$year && $pj->pj_work_cat==$cat)
                	  {
                	  	 
                	  	

                	  	 //project contract
	                	 $Criteria = new CDbCriteria();
	                     $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	                	 $pcs = ProjectContract::model()->findAll($Criteria);
                         $nPC = count($pcs);

                         $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(pc_cost) as sum')
                                            ->from('project_contract')
                                            ->where("pc_proj_id='$pj->pj_id'")
                                            ->queryAll();  
                        $pcCostAll = $pp[0]["sum"];                     
                        foreach ($pcs as $key => $pc) {
                            $pp2 = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll(); 
                            $pcCostAll += $pp2[0]["sum"];                 
                         } 
                         
                                                                                
                            

                         //2.outsource contract
                         $Criteria = new CDbCriteria();
                         $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                         $ocs = OutsourceContract::model()->findAll($Criteria);
                         $nOC = count($ocs);

                         //management cost
                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=0";
                        $m_plan = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=2";
                        $m_real = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=1";
                        $m_type1 = ManagementCost::model()->findAll($Criteria);

                        

                        //end

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=0")
                                            ->queryAll();
                        $sum_m_expect += $pp[0]["sum"];
                        $m_expect_sum = $pp[0]["sum"];


                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=1")
                                            ->queryAll();
                        $m_type1_sum = $pp[0]["sum"];                    

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=2")
                                            ->queryAll();
                        $m_real_sum = $pp[0]["sum"];

                        $sum_m_real += $m_real_sum;
                        $sum_m_type1 += $m_type1_sum;
                        //profit
                        //1.income
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_project_contract')
                                            ->join('project_contract','proj_id=pc_id')
                                            ->where("pc_proj_id='$pj->pj_id' AND bill_no!=''")
                                            ->queryAll();
                        //echo $pp[0]["sum"];
                        $income = $pp[0]["sum"];
                        
                        //1.outcome
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_outsource_contract')
                                            ->join('outsource_contract','contract_id=oc_id')
                                            ->where("oc_proj_id='$pj->pj_id'")
                                            ->queryAll();                    
                        $outcome = $pp[0]["sum"];                    
                      



                         $maxContract = $nOC==0? 1:$nOC;

                         $pj_rowspan = $maxContract ;

                        
                        //draw project
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':B'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':C'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D'.$row.':D'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.$row.':F'.($row+$pj_rowspan-1));
                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $index);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $pj->pj_name);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, number_format($pcCostAll,2));
                	  	
                	  	$sum_pc_cost += $pcCostAll;
                        $sum_pc_receive += $income;
                        $income1 = $income==0 ? '-' : number_format($income,2);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $income1);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, number_format($pcCostAll-$income,2));                	  	
                	  	
                	  	//draw management cost
                	  	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$row.':M'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('N'.$row.':N'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$row.':O'.($row+$pj_rowspan-1));
                        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P'.$row.':P'.($row+$pj_rowspan-1));
                	  	$expect = $m_expect_sum==0 ? "-" : number_format($m_expect_sum,2);
                        $real = $m_real_sum==0 ? "-" : number_format($m_real_sum,2);
                        $type1 = $m_type1_sum==0 ? "-" : number_format($m_type1_sum,2);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row, $expect);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row, $real);
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row, $type1);
                	  	$rm =($m_expect_sum - $m_type1_sum - $m_real_sum)==0 ? "-" : number_format($m_expect_sum - $m_type1_sum - $m_real_sum,2);                                    
                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row, $rm);

                	  	//draw pc
                	  	$row_pc = $row;
                	  	foreach ($ocs as $key => $oc) {
                	  		$vendor = Vendor::model()->findByPk($oc->oc_vendor_id);
                	  		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pc, $vendor->v_name);
                	  		
                	  		 $pp2 = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll(); 
                                    $ocCostAll =str_replace(",", "", $oc->oc_cost) + $pp2[0]["sum"];  

                	  		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_pc, number_format($ocCostAll,2));
                	  		$sum_oc_cost += $ocCostAll;

                	  		 $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_outsource_contract')
                                            ->where("contract_id='$oc->oc_id' AND approve_date!=''")
                                            ->queryAll();                    
                                    $outcomeOC = $pp[0]["sum"];   
                                    $sum_oc_receive += $outcome; 
                                    $outcomeOC1 = $outcomeOC==0 ? '-' : number_format($outcomeOC,2);
                	  		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_pc, $outcomeOC1);


                	  		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row_pc, number_format($ocCostAll-$outcomeOC,2));

                	  		$row_pc++;
                	  	}

                	  	if(count($ocs)==0)
                	  		$row_pc++;

                	  	$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":P".($row_pc-1));
                	  	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":F".($row_pc-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                	  	$objPHPExcel->getActiveSheet()->getStyle("M".$row.":P".($row_pc-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		            	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":A".($row_pc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            	$objPHPExcel->getActiveSheet()->getStyle("C".$row.":F".($row_pc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            	$objPHPExcel->getActiveSheet()->getStyle("H".$row.":P".($row_pc-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                	  	
                        //end

                         //       $row_i = $objPHPExcel->getActiveSheet()->getHighestRow()+2;
						///	    $row = $row_i;
						$row = $row_pc;
						//$row++;   
						$index++;
                	  }
                	}  
                	//summary
                	$sumall_pc_cost += $sum_pc_cost;
                	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':B'.$row);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, "รวม");
                    $sum_cost = $sum_pc_cost==0 ? "-" : number_format($sum_pc_cost,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $sum_cost);

    				$sumall_pc_receive += $sum_pc_receive;

                    $sum_receive = $sum_pc_receive==0 ? "-" : number_format($sum_pc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $sum_receive);

                    $rm = $sum_pc_cost-$sum_pc_receive==0 ? "-" : number_format($sum_pc_cost-$sum_pc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, $rm);	

    				$sumall_oc_cost += $sum_oc_cost;
    				$sum_cost = $sum_oc_cost==0 ? "-" : number_format($sum_oc_cost,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $sum_cost);	
    				$sumall_oc_receive += $sum_oc_receive;
    				$sum_receive = $sum_oc_receive==0 ? "-" : number_format($sum_oc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, $sum_receive);	

    				$rm = $sum_oc_cost-$sum_oc_receive==0 ? "-" : number_format($sum_oc_cost-$sum_oc_receive,2);    				
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $rm);	

    				$sumall_m_expect += $sum_m_expect;
    				$sum_expect = $sum_m_expect==0 ? "-": number_format($sum_m_expect,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row, $sum_expect);	
    				$sumall_m_real += $sum_m_real;
    				$sum_real = $sum_m_real==0 ? "-": number_format($sum_m_real,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row, $sum_real);	
    				$sumall_m_type1 += $sum_m_type1;
    				$sum_type1 = $sum_m_type1==0 ? "-": number_format($sum_m_type1,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row, $sum_type1);	

    				$sum_rm = $sum_m_expect - $sum_m_real - $sum_m_type1==0 ? "-": number_format($sum_m_expect - $sum_m_real - $sum_m_type1,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row, $sum_rm);	

    				$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":P".$row);
                	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":F".($row))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                	$objPHPExcel->getActiveSheet()->getStyle("M".$row.":P".($row))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row.":A".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("C".$row.":F".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("H".$row.":P".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                	  		  	
   					$row++;                         	
		      	}	
		   
		    //summary
                	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':B'.$row);
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, "รวมทั้งหมด");
                    $sum_cost = $sumall_pc_cost==0 ? "-" : number_format($sumall_pc_cost,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $sum_cost);

                    $sum_receive = $sumall_pc_receive==0 ? "-" : number_format($sumall_pc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $sum_receive);

                    $rm = $sumall_pc_cost-$sumall_pc_receive==0 ? "-" : number_format($sumall_pc_cost-$sumall_pc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, $rm);	

    				$sum_cost = $sumall_oc_cost==0 ? "-" : number_format($sumall_oc_cost,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row, $sum_cost);	

    				$sum_receive = $sumall_oc_receive==0 ? "-" : number_format($sumall_oc_receive,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, $sum_receive);	

    				$rm = $sumall_oc_cost-$sumall_oc_receive==0 ? "-" : number_format($sumall_oc_cost-$sumall_oc_receive,2);    				
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $rm);	

    				$sum_expect = $sumall_m_expect==0 ? "-": number_format($sumall_m_expect,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$row, $sum_expect);	

    				$sum_real = $sumall_m_real==0 ? "-": number_format($sumall_m_real,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$row, $sum_real);	

    				$sum_type1 = $sumall_m_type1==0 ? "-": number_format($sumall_m_type1,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$row, $sum_type1);	

    				$sum_rm = $sumall_m_expect - $sumall_m_real - $sumall_m_type1==0 ? "-": number_format($sumall_m_expect - $sumall_m_real - $sumall_m_type1,2);
    				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row, $sum_rm);	

    				$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":P".$row);
                	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":F".($row))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
                	$objPHPExcel->getActiveSheet()->getStyle("M".$row.":P".($row))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row.":A".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("C".$row.":F".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("H".$row.":P".($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		      	                      	
		      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		    $objPHPExcel->setActiveSheetIndex(0);
		  	 
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);


		  //?????important clear cabage
		ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  //
		 Yii::app()->end(); 
        
    }

    

}