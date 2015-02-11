<?php

class ProjectController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','createOutsource','update','loadOutsourceByAjax','loadContractByAjax','loadContractByAjaxTemp','DeleteSelected'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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

	public function actionCreateOutsource($id)
	{
		$modelOutsource = array();
		$modelContract = array();
		$modelContractOld = array();
		$model = new OutsourceContract;
		//$modelOutsource = new OutsourceContract;
		$numContracts = 1;
		array_push($modelOutsource, $model);
		//array_push($modelOutsource, new OutsourceContract);
		//array_push($modelOutsource, new OutsourceContract);
		//$modelOutsource = $this->getContracts();

		if(isset($_POST['OutsourceContract']))
		{
			$modelOutsources = array();
			$modelOutsource = array();
      //       $numContracts = $_POST['num'];
		    // for($i=1;$i<$numContracts+1;$i++)
		    // {
		    //     //if(isset($_POST['OutsourceContract'][$i]))
		    //     //{
		    //         $contracts = new OutsourceContract;
		    //         $contracts->attributes = $_POST['OutsourceContract'][$i];
		    //         //$contracts->oc_cost = Yii::app()->format->unformatNumber($_POST['OutsourceContract'][$i]['oc_cost']);
		    //         $contracts->oc_proj_id = $id;
		    //         $contracts->oc_sign_date = $_POST['OutsourceContract'][$i]["oc_sign_date"];//$_POST[$i."_oc_end_date"];
		    //         $contracts->oc_end_date = $_POST['OutsourceContract'][$i]["oc_end_date"];
		    //         $contracts->oc_approve_date = $_POST['OutsourceContract'][$i]["oc_approve_date"];
		    //         array_push($modelOutsource, $contracts);
		    //         //$contracts->validate();
		    //         $contracts->save();
		    //     //}
		    // }

		    $modelOutsources = $_POST['OutsourceContract'];
		    $transaction=Yii::app()->db->beginTransaction();
		    try {
			            
		    			$index = 1;
		    			$saveOK = 1;
			            foreach ($modelOutsources as $c => $outsource) 
		 				{
		 				     //print_r($contract);
		 					
		 					 
		 				     $modelC = new OutsourceContract;
		 				     $modelC->attributes = $outsource;
		 				     $modelC->oc_sign_date = $outsource["oc_sign_date"];
		 				     $modelC->oc_approve_date = $outsource["oc_approve_date"];
		 				     $modelC->oc_insurance_start = $outsource["oc_insurance_start"];
		 				     $modelC->oc_insurance_end = $outsource["oc_insurance_end"];
		 				    
		 				     //$modelC->pc_id = "";
		 				     $modelC->oc_proj_id = $id;

		 				     $modelC->oc_last_update = (date("Y")+543).date("-m-d H:i:s");
				    		 $modelC->oc_user_update = Yii::app()->user->ID;
				    		 $modelC->oc_user_create = Yii::app()->user->ID;
				    		  
				    		  //header('Content-type: text/plain');
                              // print_r($modelC);                    
                           	  //exit;
				    		 //array_push($modelOutsource, $modelC); 


		 				    
		 				     if($modelC->save())
		 				     {
		 				     	//$saveOK = true;
		 				     	$modelTemps = Yii::app()->db->createCommand()
						                    ->select('*')
						                    ->from('contract_approve_history_temp')
						                    ->where('contract_id=:id AND type=2 AND u_id=:user', array(':id'=>$index,':user'=>Yii::app()->user->ID))
						                    ->queryAll();
						        foreach ($modelTemps as $key => $mTemp) {

						        // header('Content-type: text/plain');
              //             		print_r($modelC);                    
              //             	    exit;
                                        $modelApprove = new ContractApproveHistory;
                                        $modelApprove->attributes = $mTemp;
                                        $modelApprove->dateApprove = $mTemp['dateApprove'];
                                        //$modelApprove->id = "";
                                        $modelApprove->contract_id = $modelC->oc_id;
                                        $modelApprove->type = 2;
                                        
                                        if($modelApprove->save())
                                           $msg =  "successful";
                                        else{
                                           $model->addError('contract', 'กรุณากรอกข้อมูล "สัญญาที่ "'.$index.' ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 				            	   $saveOK = 0;
                                        }   	
						        }            
		 				     	//$modelTemp = ContractApproveHistoryTemp::model()->findByAttributes(array('contract_id'=>$contract['pc_id']));
		 				     	
		 				     }else{
		 				     	$saveOK = 0;	
		 				     	$model->addError('contract', 'กรุณากรอกข้อมูล "สัญญาที่ '.$index.'" ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 						
		 				     	// if($contract["pc_id"]!="")
		 				     	//   $modelC->pc_id = $contract["pc_id"];
		 				     	// else
		 				     	//   $modelC->pc_id = 1;	
		 				     }

		 				     $index++;

		 				      array_push($modelOutsource, $modelC); 
		 				    	
		 				}
		 				 
		 				$numContracts = $index-1;  

		 				if($saveOK==1)
		 				{
		 					$transaction->commit();
		 					//$this->redirect(array('createOutsource', 'id' => $model->pj_id));
		 					// header('Content-type: text/plain');
        //                 		//print_r($modelC);
        //                 		echo "save".$saveOK;
        //                 	exit;
		 				}   	
		 				else
		 				{
		 					$transaction->rollBack();
		 					//$modelOutsource = $modelContractOld;
		 				    //$model->addError('contract', 'กรุณากรอกข้อมูล "สัญญา" ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 				}

			}
			catch(Exception $e)
	 		{
	 				$transaction->rollBack();	
	 				$model->addError('Outsource', 'Error occured while saving outsorces.');
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 		}         

			// $valid=true;
	  //       foreach($modelOutsource as $i=>$item)
	  //       {
	  //           if(isset($_POST['OutsourceContract'][$i]))
	  //               $item->attributes=$_POST['OutsourceContract'][$i];
	  //           $valid=$item->validate() && $valid;
	  //       }
		}
		else
        {
        	if (!Yii::app()->request->isAjaxRequest)	
			  Yii::app()->db->createCommand('DELETE FROM contract_approve_history_temp WHERE u_id='.Yii::app()->user->ID)->execute();
		
			  // Yii::app()->db->createCommand('TRUNCATE contract_approve_history_temp')->execute();
			
        }

		$this->render('create2',array(
			'model'=>$this->loadModel($id),'outsource'=>$modelOutsource,'numContracts'=>$numContracts,'modelValidate'=>$model
		));
	}

	public function getContracts() {
        // Create an empty list of records
        $items = array();
 
        // Iterate over each item from the submitted form
        if (isset($_POST['OutsourceContract'])) {
            foreach ($_POST['OutsourceContract'] as $item) {
                // If item id is available, read the record from database 
                if ( array_key_exists('id', $item) ){
                    $items[] = OutsourceContract::model()->findByPk($item['id']);
                }
                // Otherwise create a new record
                else {
                    $items[] = new OutsourceContract();
                }
            }
        }
        
        return $items;
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$model = new Project;
		$workcodes = "";
		$modelContract = array();
		$modelContractOld = array();
		$numContracts = 1;
		$modelPC = new ProjectContract;
		array_push($modelContract, $modelPC);
		
		// $query = "DROP TABLE if exists contract_approve_history_temp;";
	 //    $query = "CREATE TEMPORARY TABLE contract_approve_history_temp  AS (SELECT * FROM contract_approve_history WHERE 1=2);";
		// Yii::app()->db->createCommand($query)->execute();

		if(isset($_POST['Project']))
		{
			
			$model->attributes = $_POST['Project'];
			$model->pj_CA = $_POST['Project']['pj_CA'];

			if (isset($_POST['ProjectContract']))
            {
                $model->contract = $_POST['ProjectContract'];                         
                $transaction=Yii::app()->db->beginTransaction();
		    	try {
			        //$model->attributes = $_POST['Project'];
			        $model->pj_user_create = Yii::app()->user->ID;
				    $model->pj_user_update = Yii::app()->user->ID;
				
				    $model->pj_name = $_POST["pj_vendor_id"];

                //header('Content-type: text/plain');
				    $workcodes = $_POST['workCode'];
	    	        $workCodeArray = explode(",", $_POST['workCode']);
 				
 				//print_r($model->contract); 
				    if ($model->save()) {

				    	foreach ($workCodeArray as $key => $value) {
			        		$wk = new WorkCode;
			         		$wk->code = $value;
			        		$wk->pj_id = $model->pj_id;
			        		
			        		$wk->save();	
		 	        	}
				    	$saveOK = 1;
				    	$index = 1;

		 				foreach ($model->contract as $contracts => $contract) 
		 				{
		 				     //print_r($contract);
		 					 
		 				     $modelC = new ProjectContract;
		 				     $modelC->attributes = $contract;
		 				     $modelC->pc_details = $contract["pc_details"];
		 				     $modelC->pc_sign_date = $contract["pc_sign_date"];
		 				     $modelC->pc_PO = $contract["pc_PO"];
		 				     $modelC->pc_vendor_id = $model->pj_vendor_id;

		 				     array_push($modelContractOld, $modelC);
		 				     //$modelC->pc_id = "";
		 				     $modelC->pc_proj_id = $model->pj_id;

		 				     

		 				     $modelC->pc_last_update = (date("Y")+543).date("-m-d H:i:s");
				    		 $modelC->pc_user_update = Yii::app()->user->ID;

		 				    
		 				     if($modelC->save())
		 				     {
		 				     	//$saveOK = true;
		 				     	$modelTemps = Yii::app()->db->createCommand()
						                    ->select('*')
						                    ->from('contract_approve_history_temp')
						                    ->where('contract_id=:id AND type=1 AND u_id=:user', array(':id'=>$index,':user'=>Yii::app()->user->ID))
						                    ->queryAll();
						        foreach ($modelTemps as $key => $mTemp) {

						        // header('Content-type: text/plain');
              //             		print_r($modelC);                    
              //             	    exit;
                                        $modelApprove = new ContractApproveHistory;
                                        $modelApprove->attributes = $mTemp;
                                        $modelApprove->dateApprove = $mTemp['dateApprove'];
                                        //$modelApprove->id = "";
                                        $modelApprove->contract_id = $modelC->pc_id;
                                        $modelApprove->type = 1;
                                        
                                        if($modelApprove->save())
                                           $msg =  "successful";
                                        else{
                                           $model->addError('contract', 'กรุณากรอกข้อมูล "สัญญาที่ "'.$index.' ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 				            	   $saveOK = 0;
                                        }   	
						        }            
		 				     	//$modelTemp = ContractApproveHistoryTemp::model()->findByAttributes(array('contract_id'=>$contract['pc_id']));
		 				     	
		 				     	$modelTemps = Yii::app()->db->createCommand()
						                    ->select('*')
						                    ->from('contract_change_history_temp')
						                    ->where('contract_id=:id AND type=1 AND u_id=:user', array(':id'=>$index,':user'=>Yii::app()->user->ID))
						                    ->queryAll();
						        foreach ($modelTemps as $key => $mTemp) {

                                        $modelApprove = new ContractChangeHistory;
                                        $modelApprove->attributes = $mTemp;
                                       
                                        $modelApprove->contract_id = $modelC->pc_id;
                                        $modelApprove->type = 1;
                                        
                                        if($modelApprove->save())
                                        {
                                            $msg =  "successful";
                                            $mt = ContractChangeHistoryTemp::model()->findByPk($mTemp['id']);
                                            $mt->delete();
                                        }	                                          
                                        else{
                                           $model->addError('contract', 'กรุณากรอกข้อมูล "สัญญาที่ "'.$index.' ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 				            	   $saveOK = 0;
                                        }   	
						        }            
		 				     	
		 				     }else{
		 				     	$saveOK = 0;	
		 				     	if($contract["pc_id"]!="")
		 				     	  $modelC->pc_id = $contract["pc_id"];
		 				     	else
		 				     	  $modelC->pc_id = 1;	
		 				     }

		 				     $index++;

		 				      array_push($modelContract, $modelC); 
		 				    	
		 				}
		 				 
		 				

		 				if($saveOK==1)
		 				{
		 					$transaction->commit();
		 					$this->redirect(array('createOutsource', 'id' => $model->pj_id));
		 					// header('Content-type: text/plain');
        //                 		//print_r($modelC);
        //                 		echo "save".$saveOK;
        //                 	exit;
		 				}   	
		 				else
		 				{
		 					$transaction->rollBack();
		 					$modelContract = $modelContractOld;
		 				    $model->addError('contract', 'กรุณากรอกข้อมูล "สัญญา" ในช่องที่มีเครื่องหมาย (*) ให้ครบถ้วน.');		
		 				}

		 			}
		 			else
		 			{	
		 				$transaction->rollBack();
		 				//$model->addError('contract', 'Error occured while saving contracts.');
		 			}	 
	 			}
	 			catch(Exception $e)
	 			{
	 				$transaction->rollBack();	
	 				$model->addError('contract', 'Error occured while saving contracts.');
	 				Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
	 			}                         

 				//exit;
            }

           //  if ($model->saveWithRelated('contract'))
           //  {
           //  	$workcodes = $_POST['workCode'];
	 	        // $workCodeArray = explode(",", $_POST['workCode']);
	 	        // foreach ($workCodeArray as $key => $value) 
	 	        // {
	 	        // 		$wk = new WorkCode;
	 	        //  		$wk->code = $value;
	 	        // 		$wk->pj_id = $model->pj_id;
		        		
	 	        // 		$wk->save();	
	 	        // }
           //  }
           //  else
           //      $model->addError('contract', 'Error occured while saving contracts.');

			// $modelContract = array();
   //          $numContracts = $_POST['num'];
		 //    for($i=1;$i<$numContracts+1;$i++)
		 //    {
		 //        //if(isset($_POST['OutsourceContract'][$i]))
		 //        //{
		 //            $contracts = new ProjectContract;
		 //            $contracts->attributes = $_POST['ProjectContract'][$i];
		 //            $contracts->pj_user_create = Yii::app()->user->ID;
		 //            $contracts->pj_update_create = Yii::app()->user->ID;
		 //            $contracts->pj_name = $_POST["pj_vendor_id"];
		 //            $contracts->oc_proj_id = $id;
		 //            $contracts->pc_sign_date = $_POST['OutsourceContract'][$i]["pc_sign_date"];//$_POST[$i."_oc_end_date"];
		 //            $contracts->pc_details = $_POST['OutsourceContract'][$i]["pc_details"];
		 //            array_push($modelContract, $contracts);
		 //            //$contracts->validate();
		 //            $contracts->save();
		 //        //}
		 //    }

			// $valid=true;
	  //       foreach($modelOutsource as $i=>$item)
	  //       {
	  //           if(isset($_POST['OutsourceContract'][$i]))
	  //               $item->attributes=$_POST['OutsourceContract'][$i];
	  //           $valid=$item->validate() && $valid;
	  //       }
		}
		else{
		 
		 if (!Yii::app()->request->isAjaxRequest)	
		 {
		 	 Yii::app()->db->createCommand('DELETE FROM contract_approve_history_temp WHERE u_id='.Yii::app()->user->ID)->execute();
		 	 Yii::app()->db->createCommand('DELETE FROM contract_change_history_temp WHERE u_id='.Yii::app()->user->ID)->execute();
		
		 }	
		 //Yii::app()->db->createCommand('TRUNCATE contract_approve_history_temp')->execute();
				
			$modelPC->pc_id = 1;
     		//array_push($modelContract, $modelPC);


		
		}

		
		 $this->render('create', array(
            'model' => $model,'contract'=>$modelContract,'workcodes'=>$workcodes,'numContracts'=>$numContracts
        ));
	}

	// public function actionCreate()
	// {
	// 	$model=new Project;
	// 	$modelContract = new ProjectContract;
	// 	$modelContract2 = new ProjectContract;
	// 	$modelContract3 = new ProjectContract;
	// 	$modelContract4 = new ProjectContract;
	// 	$modelContract5 = new ProjectContract;
	// 	$modelWorkCode = new WorkCode;
	// 	$modelOutsource = new OutsourceContract;

	// 	$workcodes = "";
	// 	//array_push($workcodes, new WorkCode);

	// 	$activeTab  = 1;	
	// 	$numContracts = 1;
        
	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['Project']))
	// 	{
			
	// 		$numContracts = $_POST["numContract"];
	// 		$transaction=Yii::app()->db->beginTransaction();
	// 	    try {
	// 	        $model->attributes = $_POST['Project'];
	// 	        $model->pj_user_create = Yii::app()->user->ID;
	// 		    $model->pj_user_update = Yii::app()->user->ID;
			
	// 		    $model->pj_name = $_POST["pj_vendor_id"];
	// 		    if(isset($_POST['ProjectContract'][0]))
	// 	        {
	// 	         	$modelContract->attributes = $_POST['ProjectContract'][0];
	// 	         	$modelContract->pc_sign_date = $_POST['ProjectContract'][0]["pc_sign_date"];
	// 	         	$modelContract->pc_details = $_POST['ProjectContract'][0]["pc_details"];
	// 	        } 	
	// 	        if($numContracts>1 && isset($_POST['ProjectContract'][1]))
	// 	        { 
	// 	        	$modelContract2->attributes = $_POST['ProjectContract'][1];
	// 	        	$modelContract2->pc_sign_date = $_POST['ProjectContract'][1]["pc_sign_date"];
	// 	         	$modelContract2->pc_details = $_POST['ProjectContract'][1]["pc_details"];
	// 	        	//$numContracts++;
	// 	        }	
	// 	        if($numContracts>2 && isset($_POST['ProjectContract'][2]))
	// 	        { 
	// 	        	$modelContract3->attributes = $_POST['ProjectContract'][2];
	// 	        	$modelContract3->pc_sign_date = $_POST['ProjectContract'][2]["pc_sign_date"];
	// 	         	$modelContract3->pc_details = $_POST['ProjectContract'][2]["pc_details"];
	// 	        	//$numContracts++;
	// 	        }
	// 	        if($numContracts>3 && isset($_POST['ProjectContract'][3]))
	// 	        { 
	// 	        	$modelContract4->attributes = $_POST['ProjectContract'][3];
	// 	        	$modelContract4->pc_sign_date = $_POST['ProjectContract'][3]["pc_sign_date"];
	// 	         	$modelContract4->pc_details = $_POST['ProjectContract'][3]["pc_details"];
	// 	        	//$numContracts++;
	// 	        }
	// 	        if($numContracts>4 && isset($_POST['ProjectContract'][4]))
	// 	        { 
	// 	        	$modelContract5->attributes = $_POST['ProjectContract'][4];
	// 	        	$modelContract5->pc_sign_date = $_POST['ProjectContract'][4]["pc_sign_date"];
	// 	         	$modelContract5->pc_details = $_POST['ProjectContract'][4]["pc_details"];
	// 	        	//$numContracts++;
	// 	        }
	// 	        $workcodes = $_POST['workCode'];
	// 	        $workCodeArray = explode(",", $_POST['workCode']);
			    			    	
	// 	        if ($model->save()) {

		        	
	// 	        	foreach ($workCodeArray as $key => $value) {
	// 	        		$wk = new WorkCode;
	// 	         		$wk->code = $value;
	// 	        		$wk->pj_id = $model->pj_id;
		        		
	// 	        		$wk->save();	
	// 	        	}
		        	
	// 	        	switch ($numContracts) {
	// 	        		case 2:
	// 	        			$modelContract->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract2->pc_proj_id = $model->pj_id;
		        		    
	// 	        			if  ( $modelContract->save() && $modelContract2->save()) {
	// 				                $transaction->commit();
	// 				                //$this->redirect(array('view', 'id' => $model->pj_id));
	// 				                $activeTab = 2;
	// 				            }
	// 	        			break;
	// 	        		case 3:
	// 	        			$modelContract->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract2->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract3->pc_proj_id = $model->pj_id;
		        		    
	// 	        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save()) {
	// 				                $transaction->commit();
	// 				                //$this->redirect(array('view', 'id' => $model->pj_id));
	// 				                $activeTab = 2;
	// 				            }
	// 	        			break;
	// 	        		case 4:
	// 	        			$modelContract->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract2->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract3->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract4->pc_proj_id = $model->pj_id;
		        		    

	// 	        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save() && $modelContract4->save()) {
	// 				                $transaction->commit();
	// 				                //$this->redirect(array('view', 'id' => $model->pj_id));
	// 				                $activeTab = 2;
	// 				            }
	// 	        			break;
	// 	        		case 5:
	// 	        		    $modelContract->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract2->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract3->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract4->pc_proj_id = $model->pj_id;
	// 	        		    $modelContract5->pc_proj_id = $model->pj_id;

	// 	        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save() && $modelContract4->save() && $modelContract5->save()) {
	// 				                $transaction->commit();
	// 				                //$this->redirect(array('view', 'id' => $model->pj_id));
	// 				                $activeTab = 2;
	// 				            }
	// 	        			break;
		        		
	// 	        		default:
	// 	        		    $modelContract->pc_proj_id = $model->pj_id;
	// 	        			if  ( $modelContract->save()) {
	// 				                $activeTab = 2;
	// 				                $transaction->commit();
	// 				                $this->redirect(array('create2', 'id' => $model->pj_id));
					    
	// 				            }
	// 	        			break;
	// 	        	}
		            
		            
	// 	        }
	// 	        else   //something went wrong...
	// 	           $transaction->rollBack();
	// 	    }
	// 	    catch(Exception $e) { // an exception is raised if a query fails
	// 	        //something was really wrong - exception!
	// 	        $transaction->rollBack();
	// 	        Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	// 	        //you should do sth with this exception (at least log it or show on page)
	// 	        Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	// 	    }
	// 	}

	// 	$this->render('create',array(
	// 		'model'=>$model,'outsource'=>$modelOutsource,'activeTab'=>$activeTab,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
			
	// 	));
	// }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$modelProj = $this->loadModel($id);

		$modelContract = array();
		$modelContractOld = array();
		$numContracts = 1;
		
		

		

		
		$modelOutsource = array();

		$numContracts = 1;
		array_push($modelOutsource, new OutsourceContract);
		if(isset($_POST['Project']))
		{
						 //  header('Content-type: text/plain');
       //                   foreach( $_POST['wk'] as $v ) {
							//     print $v.",";
							// }
       //                   	exit;
			 
			$transaction=Yii::app()->db->beginTransaction();

		    try {

		    	
			    	$modelProj->attributes = $_POST["Project"];
			    	$modelProj->pj_CA = $_POST["Project"]["pj_CA"];
			    	$modelProj->pj_name = $_POST["pj_vendor_id"];	
			    	if($modelProj->save())
			    		$msg = "successful";
			    	else{
			    			 //header('Content-type: text/plain');
	                         //print_r($modelProj);
	                         //	exit;
			    	}

			     if(isset($_POST['ProjectContract']))
			    	foreach( $_POST['ProjectContract'] as $value ) {
							
							$modelPC = ProjectContract::model()->FindByPk($value["pc_id"]);
							

							if(empty($modelPC))
							{
								 //new contract
								 $modelPC = new ProjectContract;
								 $modelPC->attributes = $value;
								 $modelPC->pc_last_update = (date("Y")+543).date("-m-d H:i:s");
						    	 $modelPC->pc_user_update = Yii::app()->user->ID;
						    	 $modelPC->save();	
			 	        		 array_push($modelContract, $modelPC);

			 	        		 //save contract change history


			 	        		 //save approve change history


								 
							}
							else
							{
									$modelPC->attributes = $value;
									//check difference
									//1.project contract
									$difference = 0;
									foreach ($value as $key => $new) {

										if($new!=$modelPC[$key])
											$difference = 1;
										
									}
									//2.cost change
									$modelCostHist = Yii::app()->db->createCommand()
								                        ->select('*')
								                        ->from('contract_change_history')
								                        ->where('contract_id=:id', array(':id'=>$value["pc_id"]))
								                        ->queryAll();

								    //$nOld = 0;
								    //if(!empty($modelCostHist))                    
									///  $nOld = count($modelCostHist);//$modelCostHist->totalItems;

									//2.1 check have records in temp table 
									$modelCostHistTemp = Yii::app()->db->createCommand()
								                        ->select('*')
								                        ->from('contract_change_history_temp')
								                        ->where('u_id=:id', array(':id'=>Yii::app()->user->ID))
								                        ->queryAll();

								    if(!empty($modelCostHistTemp))
								    {
								    	$difference = 1;
								    }
									//2.2 check attributes
								    
								           




									//3.approve detail
									//3.1 check number records

									//3.2 check attributes

									//header('Content-type: text/plain');
			                        //     print_r($difference);
			                        // 	exit;

									if($difference==1)
									{
										$modelPC->pc_last_update = (date("Y")+543).date("-m-d H:i:s");
						    			$modelPC->pc_user_update = Yii::app()->user->ID;
									}

									$modelPC->save();	
			 	        			array_push($modelContract, $modelPC);
			 	        	
							}
			 	        	
							

				        		
			 	        	
					}


	               if(isset($_POST['wk']))
	               {
	               		WorkCode::model()->deleteAll("pj_id ='" . $id . "'");
					 	foreach( $_POST['wk'] as $value ) {
							$wk = new WorkCode;
							$wk->code = $value;
			 	        	$wk->pj_id = $id;
				        		
			 	        	$wk->save();	
					 	}

	               }	


				$transaction->commit();
			}
			catch(Exception $e)
	 		{
	 			$transaction->rollBack();
	 			Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
	 	        	//you should do sth with this exception (at least log it or show on page)
	 	        	Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
	 
			}	 

		}
		else{
			  $project_contract = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('project_contract')
                        ->where('pc_proj_id=:id', array(':id'=>$id))
                        ->queryAll();

            if(!empty($project_contract))
            {    
               
                foreach ($project_contract as $key => $value) {

                    $modelPC =new ProjectContract;
                    $modelPC->attributes = $value;
                    $str_date = explode("-", $value["pc_sign_date"]);
                    if(count($str_date)>1)
                      $modelPC->pc_sign_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
                    $str_date = explode("-", $value["pc_end_date"]);
                    if(count($str_date)>1)
                      $modelPC->pc_end_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
                    $modelPC->pc_details = $value["pc_details"];
                     $modelPC->pc_id = $value["pc_id"];

                    $modelPC->pc_cost = number_format($modelPC->pc_cost,2);
                    array_push($modelContract, $modelPC);
                 
                }
            }              
		}


		if(isset($_POST['OutsourceContract']))
		{
			$modelOutsource = array();
            $numContracts = $_POST['num'];
		    for($i=1;$i<$numContracts+1;$i++)
		    {
		        //if(isset($_POST['OutsourceContract'][$i]))
		        //{
		            $contracts = new OutsourceContract;
		            $contracts->attributes = $_POST['OutsourceContract'][$i];
		            //$contracts->oc_cost = Yii::app()->format->unformatNumber($_POST['OutsourceContract'][$i]['oc_cost']);
		            $contracts->oc_proj_id = $id;
		            $contracts->oc_sign_date = $_POST['OutsourceContract'][$i]["oc_sign_date"];//$_POST[$i."_oc_end_date"];
		            $contracts->oc_end_date = $_POST['OutsourceContract'][$i]["oc_end_date"];
		            $contracts->oc_approve_date = $_POST['OutsourceContract'][$i]["oc_approve_date"];
		            array_push($modelOutsource, $contracts);
		            //$contracts->validate();
		            $contracts->save();
		        //}
		    }

		}

		$this->render('update',array(
			'model'=>$modelProj,'contracts'=>$modelContract,'outsource'=>$modelOutsource,'numContracts'=>$numContracts
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

			//delete projectContracts
			//ProjectContract::model()->deleteAll("pc_proj_id ='" . $id . "'");

			//delete workcodes
			//ProjectContract::model()->deleteAll("pc_proj_id ='" . $id . "'");


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
		/*$dataProvider=new CActiveDataProvider('Project');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

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
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model,$modelContract)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate(array($model,$modelContract));
			Yii::app()->end();
		}
	}


	public function actionDeleteSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $this->loadModel($autoId)->delete();
            }
        }    
    }
	public function actionLoadOutsourceByAjax($index)
    {
        $model = new OutsourceContract;

        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
        $this->renderPartial('//outsourceContract/_form', array(
            'model' => $model,
            'index' => $index,
            'display' => 'block',
        ), false, true);

        
    }
    public function actionLoadContractByAjax($index)
    {
        $model = new ProjectContract;
        //$model->pc_id = $index;
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
        $this->renderPartial('//ProjectContract/_form', array(
            'model' => $model,
            'index' => $index,
            'display' => 'block',
        ), false, true);

        
    }

    public function actionLoadContractByAjaxTemp($index)
    {
        $model = new ProjectContract;
        //$model->pc_id = $index;
        Yii::app()->clientscript->scriptMap['jquery.js'] = false;
        Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
        $this->renderPartial('//ProjectContract/_formUpdateTemp', array(
            'model' => $model,
            'index' => $index,
            'display' => 'block',
        ), false, true);

        
    }
  
}
