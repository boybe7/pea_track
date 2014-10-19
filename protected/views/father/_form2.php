<div style="margin-bottom: 20px; display: <?php echo!empty($display) ? $display : 'none'; ?>; width:100%; clear:left;" class="crow">
 
    <div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']name'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']name', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']name'); ?>
    </div>
 
    <div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']age'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']age'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']age'); ?>
    </div>
    <div class="row" style="width:100px;float: left;">
        <br />
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