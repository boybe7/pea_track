	<div class="row-fluid">
	  <div class="span4">	
	    <?php 

	    //echo $form->textFieldRow($model,'[' . $index . ']name',array('class'=>'span12','maxlength'=>255)); 


	    ?>

	    <?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_vendor_id'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_vendor_id', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']oc_vendor_id'); ?>
      </div>  
      <div class="span4">
		<?php echo CHtml::activeLabelEx($model, '[' . $index . ']oc_cost'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']oc_cost'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']oc_cost'); ?>
      </div>
      <div class="span4">
        <?php echo CHtml::link('Delete', '#', array('onclick' => 'deleteChild(this, ' . $index . '); return false;'));
        ?>
       </div>
    </div>


<?php
Yii::app()->clientScript->registerScript('deleteChild', "
function deleteChild(elm, index)
{
    element=$(elm).parent().parent();
    /* animate div */
    $(element).animate(
    {
        opacity: 0.25,
        left: '+=50',
        height: 'toggle'
    }, 500,
    function() {
        /* remove div */
        $(element).remove();
    });
}", CClientScript::POS_END);
?>