<?php
/* @var $this FatherController */
/* @var $model Father */
/* @var $form CActiveForm */
?>
 
<div class="form">
 
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'father-form',
        'focus' => array($model, 'name'),
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
            ));
    ?>
 
    <p class="note">Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
 
    <?php
    echo CHtml::link('Add Child', '#', array('id' => 'loadChildByAjax'));
    ?>
    <div id="children">
        <?php
        $index = 0;
        if($model->isNewRecord) 
        $this->renderPartial('//child/_form', array(
                'model' => $child,
                'index' => 0,
                'display' => 'block'
            ));
        $index++;
        foreach ($model->children as $id => $child):

            $this->renderPartial('//child/_form', array(
                'model' => $child,
                'index' => $id,
                'display' => 'block'
            ));
            $index++;
        endforeach;
        ?>
    </div>
 
    <div style="clear:both;"></div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
 
    <?php $this->endWidget(); ?>
 
</div><!-- form -->
 
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('loadchild', '
var _index = ' . $index . ';
$("#loadChildByAjax").click(function(e){
    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadChildByAjax", array("load_for" => $this->action->id)) . '&index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#children").append(response);
            $("#children .crow").last().animate({
                opacity : 1,
                left: "+50",
                height: "toggle"
            });
        }
    });
    _index++;
});
', CClientScript::POS_END);
?>