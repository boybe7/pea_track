
<?php
class AjaxController extends Controller {

    public function actionGetCities() {        
    //Fetch all city name and id from state_id
        $data = Amphur::model()->findAll('PROVINCE_ID=:id', array(':id' => (int) $_POST['state_id']));        
    //Passing city id and city name to list data which generates the data suitable for list-based HTML elements
        $data = CHtml::listData($data, 'AMPHUR_ID', 'AMPHUR_NAME');
    //CHtml::tag which generates an HTML element
        foreach ($data as $value => $name) {            
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
    
    public function actionGetTumbon() {        
    //Fetch all city name and id from state_id
        $data = Tumbon::model()->findAll('AMPHUR_ID=:id', array(':id' => (int) $_POST['amphur_id']));        
    //Passing city id and city name to list data which generates the data suitable for list-based HTML elements
        $data = CHtml::listData($data, 'DISTRICT_ID', 'DISTRICT_NAME');
    //CHtml::tag which generates an HTML element
        foreach ($data as $value => $name) {            
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
 
    
    public function actionGetUnit() {        
    //Fetch all city name and id from state_id
        
        $data = Yii::app()->db->createCommand()
                                        ->select('unit,drug_id')
                                        ->from('drug')
                                        ->where('drug_name=:id', array(":id"=>$_POST['drug_id']))
                                        ->queryAll();
    //Passing city id and city name to list data which generates the data suitable for list-based HTML elements
          echo  CHtml::encode($data[0]["unit"].":".$data[0]["drug_id"]);
        // echo CHtml::hiddenField('drug_code',$_POST['drug_id'],array('class'=>'span12','readonly'=>true));
        //  echo CHtml::textField('unit',$data[0]["unit"],array('class'=>'span12','readonly'=>true));
    }
    
    public function actionGetDrug(){
            $request=trim($_GET['term']);
            $type=trim($_GET['type']);
        
            $model=Drug::model()->findAll(array("condition"=>"drug_name like '$request%' and drug_type_id ='$type' "));
            $data=array();
            foreach($model as $get){
                $data[]["label"]=$get->drug_name;
                $data[]["id"]=$get->drug_id;
            }
            $this->layout='empty';
            echo json_encode($data);
        
    }
    
    public function actionGetDiag(){
            $request=trim($_GET['term']);
            $model=  Diagnosis::model()->findAll(array("condition"=>"name like '$request%' order by name"));
            $data=array();
            foreach($model as $get){
                $data[]["label"]=$get->name;
                $data[]["code"]=$get->code;
            }
            $this->layout='empty';
            echo json_encode($data);
        
    }
    
    public function actionGetDiagCode(){
             $data = Yii::app()->db->createCommand()
                                        ->select('code,id')
                                        ->from('diagnosis')
                                        ->where('name=:id', array(":id"=>$_POST['name']))
                                        ->queryAll();
   
          echo  CHtml::encode($data[0]["code"].":".$data[0]["id"]);
        
    }
	
	public function actionGetDrugMethod(){
            $request=trim($_GET['term']);
           
        
            $model=DrugMethod::model()->findAll(array("condition"=>"name like '$request%' "));
            $data=array();
            foreach($model as $get){
                $data[]["label"]=$get->name;
                $data[]["id"]=$get->id;
            }
            $this->layout='empty';
            echo json_encode($data);
        
    }
}
?>