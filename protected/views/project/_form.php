
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
  			    'htmlOptions'=>  array('class'=>'','style'=>''),
			)); ?>

			<div style="text-align:left"><?php echo $form->errorSummary($model); ?></div>

			<div class="row-fluid">
				<div class="pull-right span3">
      				<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span12','maxlength'=>4)); ?>
    			</div>
    		</div>
  		
			<div class="row-fluid">
    			<div class="span4">
      				<?php echo $form->textFieldRow($model,'pj_code',array('class'=>'span12','maxlength'=>100)); ?>
    			</div>
    			<div class="span7">
      				<?php echo $form->textFieldRow($model,'pj_details',array('class'=>'span12','maxlength'=>500)); ?>
    			</div>
  			</div>

			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>

			<?php $this->endWidget(); ?>
	  </div> <!--end proTab-->
	  <div class="tab-pane" id="outsourceTab">
	  	
	  </div>
	</div>
</div><!--end well-->	  
