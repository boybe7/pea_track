<?php
$this->breadcrumbs=array(
	'Bills'=>array('index'),
	$model->bill_No,
);

?>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'treatment-record-form',
	'enableAjaxValidation'=>false,
        'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;;'),
)); 



?>
        
      <div class="well">
        <div class="row-fluid">
            <div class="span2 pull-right">
             <?php echo $form->textFieldRow($model,'bill_No',array('class'=>'span12','readonly'=>true)); ?>
            </div>
        </div>    
        <div class="row-fluid">
            <div class="span2">
             <?php echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); ?>
            </div>
            <div class="span4">
             <?php //echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); 
                   echo "<span style='display: block;margin-bottom: 5px;'>ชื่อผู้ป่วย</span>";
                   $patient = Patient::model()->findByPk($model->HN);
                   echo  CHtml::textField('pt_name',$patient->title."".$patient->firstname."  ".$patient->lastname,array('class'=>'span12','readonly'=>true));
             ?>
            </div>
            <div class="span2">
             <?php //echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); 
                   echo "<span style='display: block;margin-bottom: 5px;'>วันที่</span>";
                   $str_date = explode("-", $model->visit_date);
                   $date = $str_date[2]."/".$str_date[1]."/".$str_date[0];
                   echo  CHtml::textField('pt_name',$date,array('class'=>'span12','readonly'=>true));
              ?>
            </div>
            <div class="span4">
                <?php
                   echo "<span style='display: block;margin-bottom: 5px;'>แพทย์ผู้รักษา</span>";
                   
                   //$str_date = explode("/", $model->visit_date);
                   //$visit_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                   $doctorID = Yii::app()->db->createCommand()
                                                ->select('doctorID')
                                                ->from('treatment_record')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,':date'=>$model->visit_date))
                                                ->queryAll();
                   
                   $doctor = Staff::model()->findByPk($doctorID[0]["doctorID"]);
                   
                   echo  CHtml::textField('pt_name',$doctor->title."".$doctor->firstname."  ".$doctor->lastname,array('class'=>'span12','readonly'=>true));
             
                ?>
            </div>
        </div>
          
      </div>
        
     <div class="row-fluid">
        
        <div class="well">
            <fieldset >
                 <legend style="font-size: 14px;line-height: 12px"><b>รายการยา</b></legend>
            <div class="row-fluid">
             
            </div>
            <table class="table table-bordered" style="background-color: white" name="tgrid" id="tgrid2" width="100%" cellpadding="0" cellspacing="0">
                        <thead >
	                    <tr>
                                <th  style="width:100px;text-align: center">รหัสยา</th>	                   
	                        <th  style="text-align: center">รายการยา</th>
                                <th  style="width:100px;text-align: center">จำนวน</th>
                                <th  style="width:100px;text-align: center">หน่วยนับ</th>
                                <th  style="text-align: center">ราคาต่อหน่วย (บาท)</th>
	                        <th  style="text-align: center">รวมเป็นเงิน  (บาท)</th>
	                    </tr>
	                </thead>
	                <tbody>
                            <?php
                                
                               $drugs = Yii::app()->db->createCommand()
                                                ->select('drugID,quantity')
                                                ->from('patient_drug')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,':date'=>$model->visit_date))
                                                ->queryAll();
                        
                                     // print_r($model->drugs);
                                $sumPrice = 0;
                               
                                   foreach ($drugs as $key => $value) {
                                       $drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,unit,price')
                                                ->from('drug')
                                                ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$value["drugID"],':type'=>$patient->DrugType->id))
                                                ->queryAll();
                                       
                                       $sumPrice += ($drug[0]["price"]*$value["quantity"]);
                                       
                                       //edit july2014
                                       echo "<tr id='".$value["drugID"]."'><td>".$value["drugID"]."</td><td>".$drug[0]["drug_name"]."</td><td style='text-align:center'>".$value["quantity"]."</td><td style='text-align:center'>".$drug[0]["unit"]."</td><td style='text-align:right'>".number_format($drug[0]["price"],2,".",",")."</td><td style='text-align:right'>".number_format($drug[0]["price"]*$value["quantity"],2,".",",")."</td></tr>";
                                   
                                        
                                   } 
                                
                            ?>
                            
                        </tbody>
                        
            </table>
                 <center><h3>รวมเป็นเงินทั้งสิ้น<?php
                 //edit july2014
                 echo "   <font color='red'>".number_format($sumPrice,2,".", ",")."</font>   ";  ?>บาท</h3></center>     
         </div>
         
         <div class="pull-right">
		<?php 
             if(!empty($model->bill_No))   
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'success',
                        'icon'=>'print',
			'label'=>'พิมพ์ใบเสร็จ',
                        
                        'url'=>array("bill/printbill/".$model->id), 
                    
		)); 
               echo "<span>  </span>";
               $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'info',
                        'icon'=>'print',
			'label'=>'พิมพ์ฉลากยา',
                        
                        'url'=>array("bill/printlabel/".$model->id), 
                    
		)); 
               echo "<span>  </span>";
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ยกเลิก',
                        
                        'url'=>array("index"), 
		)); 
                
                ?>
	</div>
         </fieldset >
     </div>   


	

<?php $this->endWidget(); ?>
