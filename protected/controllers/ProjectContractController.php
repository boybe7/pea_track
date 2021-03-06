<?php

class ProjectContractController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function loadModel($id)
	{
		$model=ProjectContract::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionDelete($id)
	{
		if (Yii::app()->request->isAjaxRequest)
	    {
	           
	            if($this->loadModel($id)->delete())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure'));
	                
	            exit;
				        
	   }		
	}   

	public function actionGetProjectContract(){
            $request=trim($_GET['term']);
                    
            //$models=ProjectContract::model()->findAll(array("condition"=>"pc_code like '$request%'"));
            $Criteria = new CDbCriteria();
			$user_dept = Yii::app()->user->userdept;
			$Criteria->join = 'LEFT JOIN user ON pc_user_update=user.u_id';
			$Criteria->condition = "(pc_code like '$request%') AND department_id='$user_dept'";
			$models = ProjectContract::model()->findAll($Criteria);


            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $modelVendor = Vendor::model()->FindByPk($model['pc_vendor_id']);

                $data2 = Yii::app()->db->createCommand()
										->select('sum(cost) as sum')
										->from('contract_change_history')
										->where('contract_id=:id AND type=1', array(':id'=>$model['pc_id']))
										->queryAll();
											                        
				$change = $data2[0]["sum"]; 

                $data[] = array(
                        'id'=>$model['pc_id'],
                        'label'=>$model['pc_code']." ".$modelVendor->v_name,
                        'cost'=>number_format($model['pc_cost']+$change,2)
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}