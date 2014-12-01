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
    echo CHtml::link('Del Child', '#', array('id' => 'delChildByAjax'));
    ?>
    <div id="children">
        <input type="hidden" id="num" value="1">
        <?php
        $index = 1;
        if($model->isNewRecord) 
        $this->renderPartial('//child/_form', array(
                'model' => $child,
                'grandchild' => $grandchild,
                'index' => 1,
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
var _index = $("#num").val();

$("#loadChildByAjax").click(function(e){
    var _index = $("#num").val();
    //if(_index==0)
         _index++;

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
            //_index++;
            $("#num").val(_index);
            console.log("add num:"+$("#num").val());
             _index = $("#num").val();
            //console.log("add index:"+_index);
        }
    });
   
    //_index++;
});
', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('delchild', '
$("#delChildByAjax").click(function(e){
    var _index = $("#num").val();
    console.log("del index:"+_index);
    elm = "#Child_"+_index+"_name";
    console.log($(elm));
    element=$(elm).parent().parent();
    /* animate div */

    $(element).animate(
    {
        opacity: 0.25,
        left: "+=50",
        height: "toggle"
    }, 500,
    function() {
        /* remove div */
        $(element).remove();
    });
    _index--;
    $("#num").val(_index);
    console.log("del num:"+$("#num").val());
});
', CClientScript::POS_END);
?>