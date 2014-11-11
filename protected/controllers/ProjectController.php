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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','create2','update','loadOutsourceByAjax'),
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

	public function actionCreate2($id)
	{
		$modelOutsource = array();
		//$modelOutsource = new OutsourceContract;
		$numContracts = 1;
		array_push($modelOutsource, new OutsourceContract);
		//$modelOutsource = $this->getContracts();

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

			// $valid=true;
	  //       foreach($modelOutsource as $i=>$item)
	  //       {
	  //           if(isset($_POST['OutsourceContract'][$i]))
	  //               $item->attributes=$_POST['OutsourceContract'][$i];
	  //           $valid=$item->validate() && $valid;
	  //       }
		}

		$this->render('create2',array(
			'model'=>$this->loadModel($id),'outsource'=>$modelOutsource,'numContracts'=>$numContracts
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
		$model=new Project;
		$modelContract = new ProjectContract;
		$modelContract2 = new ProjectContract;
		$modelContract3 = new ProjectContract;
		$modelContract4 = new ProjectContract;
		$modelContract5 = new ProjectContract;
		$modelWorkCode = new WorkCode;
		$modelOutsource = new OutsourceContract;

		$workcodes = "";
		//array_push($workcodes, new WorkCode);

		$activeTab  = 1;	
		$numContracts = 1;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			// $model->attributes=$_POST['Project'];
			// $model->pj_user_create = Yii::app()->user->ID;
			// $model->pj_user_update = Yii::app()->user->ID;
			// $model->pj_vendor_id = $_POST["vendor_id"];
			// $model->pj_name = $_POST["pj_vendor_id"];
			// //if($model->save())
			// //	$this->redirect(array('view','id'=>$model->pj_id));
			// $modelContract = new ProjectContract;
   //          $modelContract->attributes = $_POST['ProjectContract'];
   //          if ($model->validate() && $modelContract->validate()) {
   //              $model->save(false);   //second validation pass is not needed
   //              $modelContract->proj_id = $model->id;
   //              $modelContract->save(false);
   //              $this->redirect(array('view', 'id' => $model->id));
 
   //          }
			$numContracts = $_POST["numContract"];
			$transaction=Yii::app()->db->beginTransaction();
		    try {
		        $model->attributes = $_POST['Project'];
		        $model->pj_user_create = Yii::app()->user->ID;
			    $model->pj_user_update = Yii::app()->user->ID;
			    //$model->pj_vendor_id = $_POST["vendor_id"];
			    
			    
			    

			    $model->pj_name = $_POST["pj_vendor_id"];
			    if(isset($_POST['ProjectContract'][0]))
		        {
		         	$modelContract->attributes = $_POST['ProjectContract'][0];
		         	$modelContract->pc_sign_date = $_POST['ProjectContract'][0]["pc_sign_date"];
		         	$modelContract->pc_details = $_POST['ProjectContract'][0]["pc_details"];
		        } 	
		        if($numContracts>1 && isset($_POST['ProjectContract'][1]))
		        { 
		        	$modelContract2->attributes = $_POST['ProjectContract'][1];
		        	$modelContract2->pc_sign_date = $_POST['ProjectContract'][1]["pc_sign_date"];
		         	$modelContract2->pc_details = $_POST['ProjectContract'][1]["pc_details"];
		        	//$numContracts++;
		        }	
		        if($numContracts>2 && isset($_POST['ProjectContract'][2]))
		        { 
		        	$modelContract3->attributes = $_POST['ProjectContract'][2];
		        	$modelContract3->pc_sign_date = $_POST['ProjectContract'][2]["pc_sign_date"];
		         	$modelContract3->pc_details = $_POST['ProjectContract'][2]["pc_details"];
		        	//$numContracts++;
		        }
		        if($numContracts>3 && isset($_POST['ProjectContract'][3]))
		        { 
		        	$modelContract4->attributes = $_POST['ProjectContract'][3];
		        	$modelContract4->pc_sign_date = $_POST['ProjectContract'][3]["pc_sign_date"];
		         	$modelContract4->pc_details = $_POST['ProjectContract'][3]["pc_details"];
		        	//$numContracts++;
		        }
		        if($numContracts>4 && isset($_POST['ProjectContract'][4]))
		        { 
		        	$modelContract5->attributes = $_POST['ProjectContract'][4];
		        	$modelContract5->pc_sign_date = $_POST['ProjectContract'][4]["pc_sign_date"];
		         	$modelContract5->pc_details = $_POST['ProjectContract'][4]["pc_details"];
		        	//$numContracts++;
		        }
		        $workcodes = $_POST['workCode'];
		        $workCodeArray = explode(",", $_POST['workCode']);
				
				// foreach ($workCodeArray as $key => $value) {
		  //       		$wk = new WorkCode;
		  //       		$wk->code = $value;
		        		
		  //       		array_push($workcodes, $wk);
		        			
		  //       }
		        			    	
		        if ($model->save()) {

		        	
		        	foreach ($workCodeArray as $key => $value) {
		        		$wk = new WorkCode;
		         		//$wk->id = $key;
		         		$wk->code = $value;
		        		$wk->pj_id = $model->pj_id;
		        		
		        		$wk->save();	
		        	}
		        	
		        	switch ($numContracts) {
		        		case 2:
		        			$modelContract->pc_proj_id = $model->pj_id;
		        		    $modelContract2->pc_proj_id = $model->pj_id;
		        		    
		        			if  ( $modelContract->save() && $modelContract2->save()) {
					                $transaction->commit();
					                //$this->redirect(array('view', 'id' => $model->pj_id));
					                $activeTab = 2;
					            }
		        			break;
		        		case 3:
		        			$modelContract->pc_proj_id = $model->pj_id;
		        		    $modelContract2->pc_proj_id = $model->pj_id;
		        		    $modelContract3->pc_proj_id = $model->pj_id;
		        		    
		        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save()) {
					                $transaction->commit();
					                //$this->redirect(array('view', 'id' => $model->pj_id));
					                $activeTab = 2;
					            }
		        			break;
		        		case 4:
		        			$modelContract->pc_proj_id = $model->pj_id;
		        		    $modelContract2->pc_proj_id = $model->pj_id;
		        		    $modelContract3->pc_proj_id = $model->pj_id;
		        		    $modelContract4->pc_proj_id = $model->pj_id;
		        		    

		        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save() && $modelContract4->save()) {
					                $transaction->commit();
					                //$this->redirect(array('view', 'id' => $model->pj_id));
					                $activeTab = 2;
					            }
		        			break;
		        		case 5:
		        		    $modelContract->pc_proj_id = $model->pj_id;
		        		    $modelContract2->pc_proj_id = $model->pj_id;
		        		    $modelContract3->pc_proj_id = $model->pj_id;
		        		    $modelContract4->pc_proj_id = $model->pj_id;
		        		    $modelContract5->pc_proj_id = $model->pj_id;

		        			if  ( $modelContract->save() && $modelContract2->save() && $modelContract3->save() && $modelContract4->save() && $modelContract5->save()) {
					                $transaction->commit();
					                //$this->redirect(array('view', 'id' => $model->pj_id));
					                $activeTab = 2;
					            }
		        			break;
		        		
		        		default:
		        		    $modelContract->pc_proj_id = $model->pj_id;
		        			if  ( $modelContract->save()) {
					                $activeTab = 2;
					                $transaction->commit();
					                $this->redirect(array('create2', 'id' => $model->pj_id));
					      //           $this->redirect(array('create',
									 	// 'model'=>$model,'activeTab'=>$activeTab,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
			        //                  ));
					                
					    //             $this->render('create',array(
									// 	'model'=>$model,'activeTab'=>$activeTab,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
			
									// ));
					            }
		        			break;
		        	}
		            
		            
		        }
		        else   //something went wrong...
		           $transaction->rollBack();
		    }
		    catch(Exception $e) { // an exception is raised if a query fails
		        //something was really wrong - exception!
		        $transaction->rollBack();
		        Yii::trace(CVarDumper::dumpAsString($e->getMessage()));
		        //you should do sth with this exception (at least log it or show on page)
		        Yii::log( 'Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR );
		    }
		}

		$this->render('create',array(
			'model'=>$model,'outsource'=>$modelOutsource,'activeTab'=>$activeTab,'workcodes'=>$workcodes,'numContracts'=>$numContracts,'modelContract'=>$modelContract,'modelContract2'=>$modelContract2,'modelContract3'=>$modelContract3,'modelContract4'=>$modelContract4,'modelContract5'=>$modelContract5
			
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pj_id));
		}

		$this->render('update',array(
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
		$dataProvider=new CActiveDataProvider('Project');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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

	public function actionLoadOutsourceByAjax($index)
    {
        $model = new OutsourceContract;
        $this->renderPartial('//outsourceContract/_form', array(
            'model' => $model,
            'index' => $index,
//            'display' => 'block',
        ), false, true);
    }
}
