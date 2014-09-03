<?php

class PatientController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','select'),
				'expression'=>'Yii::app()->user->isNurse()'
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
                $model = $this->loadModel($id);
                if($model->sex == "M")
                     $model->sex = "ชาย";
                 if($model->sex == "F")
                     $model->sex = "หญิง";
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Patient;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                //get current max HN
                        $data2 = Yii::app()->db->createCommand()
                                                ->select('max(HN) as max')
                                                ->from('patient')
                                                ->queryAll();
                        $fy=date("Y")+543;
                        $fyear = substr($fy, strlen($fy)-2);
                        if(!empty($data2[0]["max"]))
                        {
                            $y = substr($data2[0]["max"], 0,2);
                            if($y!=$fyear){
                                $model->HN = $fyear."0001";
                            }else{
                                $k = substr($data2[0]["max"], 2);
                                $k = intval($k)+1;
                                $zero = '';
                                for($i=0;$i<4-strlen($k);$i++)
                                   $zero .= "0";
                                $model->HN = $fyear.$zero.$k;
                            }
                        }else{
                            $model->HN = $fyear."0001";
                        }    

		if(isset($_POST['Patient']))
		{
			$model->attributes=$_POST['Patient'];
                        $model->address = $_POST['Patient']["address"];
                        $model->title = $_POST['Patient']['title'];
                        $model->firstname = $_POST['Patient']['firstname'];
                        $model->lastname = $_POST['Patient']['lastname'];
                        $model->sex = $_POST['Patient']['sex'];
                        $model->birthdate = $_POST['Patient']['birthdate'];
                        $model->id_no = $_POST['Patient']['id_no'];
                        $model->phone = $_POST['Patient']['phone'];
                        $model->emergency_phone = $_POST['Patient']['emergency_phone'];
                        $model->allergy = $_POST['Patient']['allergy'];
                        $model->drug_typeID = $_POST['Patient']['drug_typeID'];
                        $model->sub_district = $_POST['Patient']['sub_district'];
                        $model->district = $_POST['Patient']['district'];
                        $model->province = $_POST['Patient']['province'];
                        
                        
                                
			if($model->save())
				$this->redirect(array('view','id'=>$model->HN));
		}

		$this->render('create',array(
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                        $fy=date("Y")+543;
                $str_date = explode("/", $model->birthdate);
                $model->age = $fy - $str_date[2];
		if(isset($_POST['Patient']))
		{
			
                        $model->attributes=$_POST['Patient'];
                        $model->address = $_POST['Patient']["address"];
                        $model->title = $_POST['Patient']['title'];
                        $model->firstname = $_POST['Patient']['firstname'];
                        $model->lastname = $_POST['Patient']['lastname'];
                        $model->sex = $_POST['Patient']['sex'];
                        $model->birthdate = $_POST['Patient']['birthdate'];
                        $model->id_no = $_POST['Patient']['id_no'];
                        $model->phone = $_POST['Patient']['phone'];
                        $model->emergency_phone = $_POST['Patient']['emergency_phone'];
                        $model->allergy = $_POST['Patient']['allergy'];
                        
                        $model->sub_district = $_POST['Patient']['sub_district'];
                        $model->district = $_POST['Patient']['district'];
                        $model->province = $_POST['Patient']['province'];
                        //header('Content-type: text/plain');
                        //print_r($_POST['Patient']);
                        //exit;
			if($model->save())
				$this->redirect(array('view','id'=>$model->HN));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionSelect($id)
	{
		$model=$this->loadModel($id);

		$this->render('view',array(
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
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];

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
		$model=Patient::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='patient-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
