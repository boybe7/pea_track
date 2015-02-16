<?php

class ContractChangeHistoryController extends Controller
{
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
				'actions'=>array('create','createTemp','createOutsourceTemp','update','updateTemp','delete','deleteTemp'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		 $model=new ContractChangeHistory;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['ContractChangeHistory']))
		{
			$model->attributes=$_POST['ContractChangeHistory'];
			$model->contract_id = $id;			
			$model->type = 1;
			$model->last_update =  (date("Y")+543).date("-m-d H:i:s");
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
	                
	            exit;
				        
	        }		
			

		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
            exit;               
        }

		$this->renderPartial('_form',array('model'=>$model,'index'=>$id));
	}

	public function actionCreateTemp($id)
	{
	

		 $model=new ContractChangeHistoryTemp;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['ContractChangeHistoryTemp']))
		{
			$model->attributes=$_POST['ContractChangeHistoryTemp'];
			$model->contract_id = $id;
			$model->u_id = Yii::app()->user->ID;
			$model->type = 1;
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
	                
	            exit;
				        
	        }		
			else
			  if($model->save())
				$this->redirect(array('admin'));

		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
            exit;               
        }

		$this->renderPartial('_form',array('model'=>$model,'index'=>$id));
	}

	public function actionCreateOutsourceTemp($id)
	{
	

		 $model=new ContractChangeHistoryTemp;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['ContractChangeHistoryTemp']))
		{
			$model->attributes=$_POST['ContractChangeHistoryTemp'];
			$model->contract_id = $id;
			$model->u_id = Yii::app()->user->ID;
			$model->type = 2;
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
	                
	            exit;
				        
	        }		
			else
			  if($model->save())
				$this->redirect(array('admin'));

		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model,'index'=>$id), true)));
            exit;               
        }

		$this->renderPartial('_form',array('model'=>$model,'index'=>$id));
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

		if(isset($_POST['ContractChangeHistory']))
		{
			$model->attributes=$_POST['ContractChangeHistory'];
			$model->last_update =  (date("Y")+543).date("-m-d H:i:s");
			if (Yii::app()->request->isAjaxRequest)
	         {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
			}	        
	        	//$this->redirect(array('admin'));

		}

		$this->renderPartial('_form',array('model'=>$model));
	}

	public function actionUpdateTemp($id)
	{
		$model=ContractChangeHistoryTemp::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContractChangeHistoryTemp']))
		{
			$model->attributes=$_POST['ContractChangeHistoryTemp'];
            //$model->type = 1;
			 if (Yii::app()->request->isAjaxRequest)
	         {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
			}	        
	        	//$this->redirect(array('admin'));

		}

		$this->renderPartial('_form',array('model'=>$model));

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

	public function actionDeleteTemp($id)
	{
		$model = ContractChangeHistoryTemp::model()->findByPk($id);
		$model->delete();

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ContractChangeHistory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ContractChangeHistory::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contract-change-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}