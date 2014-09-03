<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'diagnosis-form',
	'enableAjaxValidation'=>false,
        'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'width:500px;margin:0 auto;;'),
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

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
