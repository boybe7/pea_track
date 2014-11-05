

	<div class="row-fluid">
	  <div class="span4">	
	    <?php 
	    //echo $form->textFieldRow($model,'[' . $index . ']name',array('class'=>'span12','maxlength'=>255)); 

       echo $index;
	    ?>
       
	    <?php echo CHtml::activeLabelEx($model, '[' . $index . ']name'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']name', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']name'); ?>
      </div>  
      <div class="span4">
		<?php echo CHtml::activeLabelEx($model, '[' . $index . ']age'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']age'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']age'); ?>
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
    num = $('#num').val();
    num--;
    $('#num').val(num);
    console.log('del num:'+$('#num').val());
}", CClientScript::POS_END);
?>