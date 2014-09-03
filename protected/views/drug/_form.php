<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'drug-form',
	'enableAjaxValidation'=>false,
         'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'width:500px;margin:0 auto;;'),
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'drug_id',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'drug_name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'unit',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

	 <?php 
            $typelist = CHtml::listData(DrugType::model()->findAll(),'id','name');
            echo $form->dropDownListRow($model, 'drug_type_id', $typelist,array('class'=>'span5','prompt'=>'--กรุณาเลือก--')); 
        ?>   

	<div class="form-actions">
		<?php 
                
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
                    
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

<?php $this->endWidget(); ?>
