
<script type="text/javascript">
	$('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    
    $('a[data-toggle="tab"]').on('shown', function (e) {
    	e.target // activated tab
    	e.relatedTarget // previous tab
    })

</script>
	<!-- <p class="help-block">Fields with <span class="required">*</span> are required.</p> -->
<div class="well">
	<ul class="nav nav-tabs">
        <li class="active"><a href="#projTab" data-toggle="tab">โครงการ</a></li>
         <li><a href="#outTab" data-toggle="tab">สัญญาจ้างต่อ</a></li>
    </ul>
         
    <div class="tab-content">
      <div class="tab-pane active" id="projTab">  
      	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'project-form',
			'enableAjaxValidation'=>false,
			'type'=>'horizontal',
  			'htmlOptions'=>  array('class'=>'well','style'=>''),
		)); ?>
    	

		
    	<div style="text-align:left"><?php echo $form->errorSummary($model); ?></div>
		<div class="row-fluid">
			<div class="offset8 span4">
      			<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span12','maxlength'=>4)); ?>
    		</div>
    	
  		</div>
  		
		<div class="row-fluid">
    		<div class="span4">
      			<?php echo $form->textFieldRow($model,'pj_code',array('class'=>'span12','maxlength'=>100)); ?>
    		</div>
    		<div class="span8">
      			<?php echo $form->textFieldRow($model,'pj_details',array('class'=>'span12','maxlength'=>500)); ?>
    		</div>
  		</div>
  		<div class="row-fluid">
    		<div class="span4">
      			<?php echo $form->textFieldRow($model,'pj_date_approved',array('class'=>'span12')); ?>
    		</div>
    		<div class="span8">
      			<?php echo $form->textFieldRow($model,'pj_work_cat',array('class'=>'span12')); ?>
    		</div>
  		</div>
		
			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
						
		</div>
        <?php $this->endWidget(); ?>
		<div class="tab-pane" id="outTab">
		</div>
	</div>		
</div>	

