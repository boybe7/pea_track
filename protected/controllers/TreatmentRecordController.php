<?php

class TreatmentRecordController extends Controller
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
				'actions'=>array('index','view','indexDoctor','ajax','ajax2','ajaxDiag','ajaxIncome'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','report','reportDiag','reportIncome','printReport','indexDoctor2'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('nurse','doctor'),
                                'users'=>array('*'),
				//'expression'=>'Yii::app()->user->isNurse()'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
                       
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        public function actionAjax2() {
            if((isset($_POST['date1']) && isset($_POST['date2']))){

                $criteria = new CDbCriteria;
                        $criteria->select = array('*');
                        $criteria->condition = "visit_date between :date1 and :date2";
                        $criteria->params = array(":date1"=>date('Y-m-d', strtotime($_POST["date1"])),
                                            ":date2"=>date('Y-m-d', strtotime($_POST["date2"])));
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
                $this->renderPartial('_table',array('model'=>$model));
            }
        }
                
        public function actionAjax() {
            if((isset($_POST['date1']) && $_POST['date1']!="" && isset($_POST['date2']) && $_POST['date2']!="")){

                $model = Yii::app()->db->createCommand()
                                        ->select('*')
                                        ->from('treatment_record')
                                        ->where('visit_date between :date1 and :date2', array(
                                            ":date1"=>date('Y-m-d', strtotime($_POST["date1"])),
                                            ":date2"=>date('Y-m-d', strtotime($_POST["date2"]))))
                                        ->queryAll();
                
                //$this->renderPartial('_table',array('model'=>$model));
                
                header('Content-type: application/json');  
                
                
               $years = Yii::app()->db->createCommand()
                                        ->select('year(visit_date) as year')
                                        ->from('treatment_record')
                                        ->where('visit_date between :date1 and :date2 group by year(visit_date)', array(
                                            ":date1"=>date('Y-m-d', strtotime($_POST["date1"])),
                                            ":date2"=>date('Y-m-d', strtotime($_POST["date2"]))))
                                        ->queryAll();
                                    
                $records = array();  
                $records2 = array();  
               
//                foreach ($years as $year => $value){
//                       $data = Yii::app()->db->createCommand()
//                                        ->select('count(id) as num')
//                                        ->from('treatment_record')
//                                        ->where('year(visit_date)=:year', array(
//                                            ":year"=>$value["year"]))
//                                        ->queryAll();
//                       
//                       //get month record
//                       $recordM = array();
//                       for($i=1;$i<=12;$i++)
//                       {
//                            $dataM = Yii::app()->db->createCommand()
//                                        ->select('count(id) as num')
//                                        ->from('treatment_record')
//                                        ->where('year(visit_date)=:year AND month(visit_date)=:month', array(
//                                            ":year"=>$value["year"],":month"=>$i))
//                                        ->queryAll();
//                           
//                           $recordM[] = array("name"=>$i,"num"=>$dataM[0]["num"]);
//                       }
//                       
//                       $records[] = array("year"=>$value["year"],"no"=>$data[0]["num"],"month"=>$recordM);
//                } 
                
             
                
                $str_date = explode("/", $_POST["date1"]);
                $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                $year1 = $str_date[2];
                $m1 = $str_date[1];
                $str_date = explode("/", $_POST["date2"]);
                $year2 = $str_date[2];
                $m2 = $str_date[1];
                $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                for($y=$year1;$y<=$year2;$y++)
                {
                    
                       $data = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year AND drug_typeID="F"', array(
                                            ":year"=>$y,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                       
                       $data2 = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                             ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year AND drug_typeID="P"', array(
                                            ":year"=>$y,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                       
                       
                       $records[] = array("year"=>$y,"free"=>$data[0]["num"],"cost"=>$data2[0]["num"]);
                       //$records2[] = array("year"=>$y,"no"=>$data2[0]["num"],"month"=>$recordM2,"month2"=>$recordM);
                }
                
                //get month record
                       $recordM = array();
                       $recordM2 = array();
                       $mEnd = 12;
                       if($year1==$year2)
                           $mEnd = $m2;
                       $y =  $year1;
                       for($i=$m1;$i<=$mEnd && $y<=$year2;$i++)
                       {
                               
                            $dataM = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year  AND drug_typeID="F" AND month(visit_date)=:month', array(
                                            ":year"=>$y,":month"=>$i,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                            
                            $dataM2 = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year  AND drug_typeID="P" AND month(visit_date)=:month', array(
                                            ":year"=>$y,":month"=>$i,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                            $month = "";
                            switch ($i){
                                    case 1:$month="มกราคม";break;
                                    case 2:$month="กุมภาพันธ์";break;
                                    case 3:$month="มีนาคม";break;
                                    case 4:$month="เมษายน";break;
                                    case 5:$month="พฤษภาคม";break;
                                    case 6:$month="มิถุนายน";break;
                                    case 7:$month="กรกฎาคม";break;
                                    case 8:$month="สิงหาคม";break;
                                    case 9:$month="กันยายน";break;
                                    case 10:$month="ตุลาคม";break;
                                    case 11:$month="พฤศจิกายน";break;
                                    case 12:$month="ธันวาคม";break;
                            } 
                          
                             $recordM[] = array("name"=>$month." ".$y,"free"=>$dataM[0]["num"],"cost"=>$dataM2[0]["num"]);
                            if($i==12)
                           {   
                               $i=0;
                               $y++;
                               $mEnd = $m2;
                           }
                          
                         //$recordM2[] = array("name"=>$month,"num"=>$dataM2[0]["num"],"num"=>$dataM[0]["num"]);
                       }
                       
                
                $dataOutput = array($records,$recordM);
                echo CJSON::encode($dataOutput);  

            }
                Yii::app()->end();  
        }
        
        

        public function actionAjaxDiag() {
            if((isset($_POST['date1']) && !empty($_POST['date1']) && isset($_POST['date2'])&& !empty($_POST['date2']))){

              
                
                header('Content-type: application/json');  
                
             
                $records = array();  
     
                $str_date = explode("/", $_POST["date1"]);
                $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
             
                $str_date = explode("/", $_POST["date2"]);
                $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                
                $datas = Yii::app()->db->createCommand()
                                        ->select('count(treatment_record.id) as num,diagID1,name')
                                        ->from('treatment_record,diagnosis')
                                        ->where('diagID1=code AND visit_date BETWEEN :date1 AND :date2  AND diagID1 !="" GROUP BY diagID1', array(
                                            ":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
            
                foreach ($datas as $data => $value){
                     $records[] = array("id"=>$value["diagID1"],"no"=>$value["num"],"name"=>$value["name"]);
                     
                }
                 
                $data2 = Yii::app()->db->createCommand()
                                        ->select('count(treatment_record.id) as num,diagID2,name')
                                        ->from('treatment_record,diagnosis')
                                        ->where('diagID2=code and visit_date BETWEEN :date1 AND :date2  AND diagID2 !="" GROUP BY diagID2', array(
                                            ":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                
                foreach ($data2 as $data => $value){
                    $found = 0;
                    for ($k=0;$k<sizeof($records) && !$found;$k++) {
                        if($records[$k]["id"]==$value["diagID2"]){
                            $found = 1;
                            $records[$k]["no"] +=  $value["num"];
                        }
                    }
                    
                    if(!$found)
                       $records[] = array("id"=>$value["diagID2"],"no"=>$value["num"],"name"=>$value["name"]);
                     
                }
                 
                $data3 = Yii::app()->db->createCommand()
                                        ->select('count(treatment_record.id) as num,diagID3,name')
                                        ->from('treatment_record,diagnosis')
                                        ->where('diagID3=code and  visit_date BETWEEN :date1 AND :date2  AND diagID3 !="" GROUP BY diagID3', array(
                                            ":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                foreach ($data3 as $data => $value){
                    $found = 0;
                    for ($k=0;$k<sizeof($records) && !$found;$k++) {
                        if($records[$k]["id"]==$value["diagID3"]){
                            $found = 1;
                            $records[$k]["no"] +=  $value["num"];
                        }
                    }
                    
                    if(!$found)
                       $records[] = array("id"=>$value["diagID3"],"no"=>$value["num"],"name"=>$value["name"]);
                     
                }
                 

                echo CJSON::encode($records);  

            }
                Yii::app()->end();  
        }
        
        public function actionAjaxIncome() {
            if((isset($_POST['date1']) && !empty($_POST['date1']) && isset($_POST['date2'])&& !empty($_POST['date2']))){

              
                
                header('Content-type: application/json');  
                
             
                $records = array();  
     
                $str_date = explode("/", $_POST["date1"]);
                $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
             
                $str_date = explode("/", $_POST["date2"]);
                $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                
                $datas = Yii::app()->db->createCommand()
                                        ->select('SUM( total ) AS num, visit_date')
                                        ->from('bill')
                                        ->where('visit_date BETWEEN :date1 AND :date2 GROUP BY visit_date', array(
                                            ":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
            
                foreach ($datas as $data => $value){
                    if($value["num"]!=0)
                    {
                        $str_date = explode("-", $value["visit_date"]);
                        $date2= $str_date[2]."/".$str_date[1]."/".$str_date[0];
                       $records[] = array("id"=>$value["visit_date"],"no"=>$value["num"],"name"=>$date2);
                    } 
                }
                 
             

                echo CJSON::encode($records);  

            }
                Yii::app()->end();  
        }
        
        public function actionReportDiag()
	{
                $model=new TreatmentRecord('search');
                
                $criteria = new CDbCriteria;
                $criteria->select = array('*');
                $criteria->condition = "visit_date=1";
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
              
                //if(Yii::app()->request->isAjaxRequest){
                  if((isset($_POST['date1']) && isset($_POST['date2']))){

                    
                        $criteria = new CDbCriteria;
                        $criteria->with = array('Patient');
                        $criteria->select = array('*');
                        $criteria->condition = " visit_date between :date1 and :date2";
                        $str_date = explode("/", $_POST["date1"]);
                        $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $str_date = explode("/", $_POST["date2"]);
                        $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $criteria->params = array(":date1"=>$date1,
                                            ":date2"=>$date2);
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
                 
//                         header('Content-type: text/plain');
//                         print_r($model);
//                          exit;
                          $this->renderPartial('_table',array('model'=>$model));
                          
                           Yii::app()->end();
                  }       
                   else
                   { 
                    $this->render('reportDiag',array(
			'model'=>$model,
	         	));
                    
                }
                
	}
        
        public function actionReportIncome()
	{
                $model=new TreatmentRecord('search');
                
                $criteria = new CDbCriteria;
                $criteria->select = array('*');
                $criteria->condition = "visit_date=1";
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
              
                //if(Yii::app()->request->isAjaxRequest){
                  if((isset($_POST['date1']) && isset($_POST['date2']))){

                    
                        $criteria = new CDbCriteria;
                        $criteria->with = array('Patient');
                        $criteria->select = array('*');
                        $criteria->condition = " visit_date between :date1 and :date2";
                        $str_date = explode("/", $_POST["date1"]);
                        $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $str_date = explode("/", $_POST["date2"]);
                        $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $criteria->params = array(":date1"=>$date1,
                                            ":date2"=>$date2);
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
                 
//                         header('Content-type: text/plain');
//                         print_r($model);
//                          exit;
                          $this->renderPartial('_table',array('model'=>$model));
                          
                           Yii::app()->end();
                  }       
                   else
                   { 
                    $this->render('reportIncome',array(
			'model'=>$model,
	         	));
                    
                }
                
	}
        
        public function actionPrintReport()
	{
                  $model=new TreatmentRecord;  
                  if((isset($_GET['date1']) && $_GET['date1']!="" && isset($_GET['date2']) && $_GET['date2']!="")){

                    $this->render('printReport',array(
			'model'=>$model,'date1'=>$_GET['date1'],'date2'=>$_GET['date2']
	         	));
                    
                  }       
                
	}

        public function actionReport()
	{
                $model=new TreatmentRecord('search');
                
                $criteria = new CDbCriteria;
                $criteria->select = array('*');
                $criteria->condition = "visit_date=1";
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
              
                //if(Yii::app()->request->isAjaxRequest){
                  if((isset($_POST['date1']) && $_POST['date1']!="" && isset($_POST['date2']) && $_POST['date2']!="")){

                    
                        $criteria = new CDbCriteria;
                        $criteria->with = array('Patient');
                        $criteria->select = array('*');
                        $criteria->condition = " visit_date between :date1 and :date2";
                        $str_date = explode("/", $_POST["date1"]);
                        $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $str_date = explode("/", $_POST["date2"]);
                        $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                        $criteria->params = array(":date1"=>$date1,
                                            ":date2"=>$date2);
                        $model  =new CActiveDataProvider('TreatmentRecord', array(
                                'criteria'=>$criteria,
                                'sort'=>array('defaultOrder'=>'visit_time ASC')
                        ));
                 
//                         header('Content-type: text/plain');
//                         print_r($model);
//                          exit;
                          $this->renderPartial('_table',array('model'=>$model));
                          
                           Yii::app()->end();
                  }       
                  else
                  { 
                    $this->render('report',array(
			'model'=>$model,
	         	));
                    
                }
           
                
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TreatmentRecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TreatmentRecord']))
		{
			$model->attributes=$_POST['TreatmentRecord'];
                        //$model->save();
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionNurse($id)
	{
		$model=new TreatmentRecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $model->HN = $id;
                
                $patient = Patient::model()->findByPk($id);
                $model->firstname = $patient->firstname;
                $model->lastname = $patient->lastname;
                
                $model->nurseID = Yii::app()->user->firstname;
                
                
		if(isset($_POST['TreatmentRecord']))
		{
			$model->attributes=$_POST['TreatmentRecord'];
                        
                        $model->symptomID = $_POST['symptom'];
                        $model->nurseID = $_POST['TreatmentRecord']["nurseID"];
                        $model->doctorID = $_POST['TreatmentRecord']["doctorID"];
                        //$model->hour = $_POST['TreatmentRecord']["hour"];
                        //$model->minute = $_POST['TreatmentRecord']["minute"];
                        //$model->visit_time = $model->hour .".".$model->minute;
                        $model->visit_time = $_POST['TreatmentRecord']["visit_time"];
                        $model->visit_date = $_POST['TreatmentRecord']["visit_date"];
                       
                        //header('Content-type: text/plain');
                        //print_r($model);
                        //exit;
                       // $model->visit_date=date('m/d/Y', strtotime(str_replace("-", "", $model->visit_date))); 
                       // $model->save();
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('nurse',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                
                $patient = Patient::model()->findByPk($model->HN);
                $model->firstname = $patient->firstname;
                $model->lastname = $patient->lastname;
                
                //$str_date = explode("", $string)
                
                //$visit_time = explode(".", $model->visit_time);
//header('Content-type: text/plain');
//print_r($model);
//exit;
                //$model->hour = $visit_time[0] ;
                //$model->minute = $visit_time[1];
                
                

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TreatmentRecord']))
		{
			$model->attributes=$_POST['TreatmentRecord'];
                        if(!empty($_POST['symptom']))
                           $model->symptomID = $_POST['symptom'];
                       else {
                           $model->symptomID = $_POST['symptom2'];
                       }
                        $model->nurseID = $_POST['TreatmentRecord']["nurseID"];
                        $model->doctorID = $_POST['TreatmentRecord']["doctorID"];
                        //$model->hour = $_POST['TreatmentRecord']["hour"];
                        //$model->minute = $_POST['TreatmentRecord']["minute"];
                        //$model->visit_time = $_POST['TreatmentRecord']["visit_time"];
			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
                        if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionDoctor($id)
	{
		$model=$this->loadModel($id);
                
                $patient = Patient::model()->findByPk($model->HN);
                $model->firstname = $patient->firstname;
                $model->lastname = $patient->lastname;
                $model->title = $patient->title;
                $model->allergy =$patient->allergy;
                
                $visit_time = explode(".", $model->visit_time);
//                header('Content-type: text/plain');
//                        print_r($visit_time);
//                        exit;
                //$model->hour = $visit_time[0] ;
                //$model->minute = $visit_time[1];
                
                $str_date = explode("/", $model->visit_date);
            //$this->visit_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]-543);
                $visit_date = $str_date[2]."-".$str_date[1]."-".($str_date[0]);
                
                 $model->drugs = Yii::app()->db->createCommand()
                                                ->select('drugID,quantity,method')
                                                ->from('patient_drug')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,":date"=>$visit_date))
                                                ->queryAll();
                                    

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TreatmentRecord']))
		{
			$model->attributes=$_POST['TreatmentRecord'];
                        
                        $str_date = explode("/", $_POST['TreatmentRecord']['visit_date']);
            
                        $visit_date = $str_date[2]."-".$str_date[1]."-".($str_date[0]);
                       if(!empty($_POST['drug'])) 
                        PatientDrug::model()->deleteAll("HN=:id AND visit_date=:date",array(':id'=>$_POST['TreatmentRecord']['HN'],":date"=>$visit_date));
                        $model->diagID1 = '';
                            $model->diagID2 = '';
                            $model->diagID3 = '';    
                        if(!empty($_POST['diagnosis']))
                        {
                            $diags = explode(",", $_POST['diagnosis']);
                            
                            foreach ($diags as $key => $value) {
                               if($key==0)
                                   $model->diagID1 = trim($value);
                               else if($key==1)
                                   $model->diagID2 = trim($value);
                               else if($key==2)
                                   $model->diagID3 = trim($value);
                            }
                            //$model->diagID1 = $_POST['diagnosis'];
                        }
                        if(!empty($_POST['drug']))
                        {
                            $drugs = explode(",", $_POST['drug']);
                            
                                
                            $str_date = explode("/", $_POST['TreatmentRecord']['visit_date']);
            
                            $visit_date = $str_date[2]."-".$str_date[1]."-".($str_date[0]);
                            
                           foreach ($drugs as $key => $value) {
                                
                                $drugs2 = explode(":", $value);
                              
                                    $patientDrug = new PatientDrug;
                                    $patientDrug->HN = $_POST['TreatmentRecord']['HN'];
                                    //$str_date = explode("/", $_POST['TreatmentRecord']['visit_date']);
                                   // $patientDrug->visit_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                                    $patientDrug->visit_date = $_POST['TreatmentRecord']['visit_date'];
                                    $patientDrug->drugID = $drugs2[0];
                                    $patientDrug->quantity = $drugs2[1];
                                    $patientDrug->method = $drugs2[2];
                                    
                                    /*header('Content-type: text/plain');
                                        print_r($patientDrug);
                                        exit;*/
                                    if($patientDrug->save()===false){
                                        
                                    }
                                    
                            }
                        }
                        
                        
                        //create bill
                        //find exist bill_no 
                        $data = Yii::app()->db->createCommand()
                                                ->select('bill_No')
                                                ->from('bill')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,":date"=>$visit_date))
                                                ->queryAll();
                        
                        
                        //header('Content-type: text/plain');
                        //if(!empty($data))
                        //  print_r($data);
                        //exit;
                         $billObj  = new Bill;
                        if(empty($data))
                        {
                            
                            $fyear=date("Y")+543;
                            if(date("n")>9)
                               $fyear = $fyear+1;
                            $max_no = 0;
                            
                           
                            //header('Content-type: text/plain');
                           // print_r($data);
                            //exit;
                            //
                          if($_POST["drugtype"]!="ยางบประมาณ")
                          {    
                              
                            //get max bill_no
                            $data2 = Yii::app()->db->createCommand()
                                                ->select('max(bill_No) as max')
                                                ->from('bill,patient')
                                                ->where('bill.HN=patient.HN AND drug_typeID="P"') 
                                                ->queryAll();
                            if(!empty($data2[0]["max"])){
                              
                                $bill = explode("/", $data2[0]["max"]);
                                $max_no = $bill[0];
                              //header('Content-type: text/plain');
                              //print_r($bill);
                              //exit;
                                if(!empty($bill[1]))
                                {
                                  if($bill[1]!=$fyear)
                                    $billObj->bill_No = "1/".$fyear;
                                  else    
                                    $billObj->bill_No = ($max_no+1)."/".$bill[1];
                                }
                                
                            }    
                            else{
                                
                                $billObj->bill_No = ($max_no+1)."/".$fyear;
                            }
                          }
                          else{
                            //get max bill_no
                            $data2 = Yii::app()->db->createCommand()
                                                ->select('max(bill_No) as max')
                                                ->from('bill,patient')
                                                ->where('bill.HN=patient.HN AND drug_typeID="F"') 
                                                ->queryAll();
                            if(!empty($data2[0]["max"]))
                                $max_no = $data2[0]["max"];
                            else         
                                $max_no = 0;
                            $billObj->bill_No = ($max_no+1);
                           
                          }  
                            $billObj->HN = $_POST['TreatmentRecord']['HN'];
                            $billObj->visit_date = $_POST['TreatmentRecord']['visit_date'];
                        }
                        else{
                            //$billObj = Bill::model()->findByPk($data[0]["bill_No"]);
                            $data3 = Yii::app()->db->createCommand()
                                                ->select('*')
                                                ->from('bill')
                                                ->where('bill_No=:no',array("no"=>$data[0]["bill_No"])) 
                                                ->queryAll();
                            //$billObj = Bill::model()->findByPk($data3[0]["id"]);
                            //$billObj->id = $data3[0]["id"];
                            $billObj->bill_No = $data3[0]["bill_No"];
                            $billObj->HN = $data3[0]["HN"];
                            $billObj->visit_date = $_POST['TreatmentRecord']['visit_date'];
                            
                             Bill::model()->deleteAll("bill_No=:id",array(':id'=>$data3[0]["bill_No"]));
                           
                            //$billObj->total = $data3[0]["total"];
                            //header('Content-type: text/plain');
                            //    print_r($billObj);
                            //    exit;
                        }
                        
                        if($_POST["drugtype"]=="ยางบประมาณ")
                                $billObj->total = 0;
                        else
                        {
                                $data2 = Yii::app()->db->createCommand()
                                                ->select('sum(quantity*price) as total')
                                                ->from('patient_drug pd')
                                                ->join('drug d','pd.drugID=d.drug_id') 
                                                ->where('drug_type_id="P" AND HN=:id AND visit_date=:date', array(':id'=>$model->HN,":date"=>$visit_date))
                                                ->queryAll();
                                $billObj->total = 0;
                                if(!empty($data2[0]["total"]))
                                    $billObj->total = $data2[0]["total"];
                                else
                                    $billObj->total = 0;
                     
                         }
                            
                         
                         if(!$billObj->save())
                         {
                             header('Content-type: text/plain');
                              print_r($billObj);
                             exit;
                             
                         }
                             
              
                        
                     
                      
                        
			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
                        if($model->save())
				$this->redirect(array('indexDoctor'));
                        
		}

		$this->render('Doctor',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new TreatmentRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TreatmentRecord']))
			$model->attributes=$_GET['TreatmentRecord'];
		$this->render('index',array(
			'model'=>$model,
		));
	}
        
        public function actionIndexDoctor()
	{
		$model=new TreatmentRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TreatmentRecord']))
			$model->attributes=$_GET['TreatmentRecord'];
		$this->render('indexDoctor',array(
			'model'=>$model,
		));
	}
        
         public function actionIndexDoctor2()
	{
		$model=new TreatmentRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TreatmentRecord']))
			$model->attributes=$_GET['TreatmentRecord'];
		$this->render('indexDoctor2',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TreatmentRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TreatmentRecord']))
			$model->attributes=$_GET['TreatmentRecord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TreatmentRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function getTabularFormTabs($form, $model)
        {
            $tabs = array();
            $count = 0;
            foreach (array('en'=>'English', 'fi'=>'Finnish', 'sv'=>'Swedish') as $locale => $language)
            {
                $tabs[] = array(
                    'active'=>$count++ === 0,
                    'label'=>$language,
                    'content'=>$this->renderPartial('_tabular', array('form'=>$form, 'model'=>$model, 'locale'=>$locale, 'language'=>$language), true),
                );
            }
            return $tabs;
        }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='treatment-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
