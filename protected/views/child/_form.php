  <div>

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
        echo CHtml::link('Add GrandChild', '#', array('id' => 'loadGrandChildByAjax'));
        
        ?>
        <div id="grandchild">
            
            <?php
            echo '<input type="hidden" id="numc['.$index.']" value="1">';
            $index2 = 1;
            if($model->isNewRecord) 
            $this->renderPartial('//grandchild/_form', array(
                    'model' => $grandchild,
                    'index' => 1,
                    'display' => 'block'
                ));
            $index2++;
            
            foreach ($model->grandchild as $id => $child):
                
                $this->renderPartial('//grandchild/_form', array(
                    'model' => $child,
                    'index' => $id,
                    'display' => 'block'
                ));
                $index2++;
            endforeach;
            ?>
        </div>
</div>        
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('loadchild2', '
var _index = ' . $index . ';
var _index = $("#numc['.$index.']").val();

$("#loadGrandChildByAjax").click(function(e){
    var _index = $("#numc['.$index.']").val();
    //if(_index==0)
         _index++;

    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadGrandChildByAjax", array("load_for" => $this->action->id)) . '&index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#grandchild").append(response);
            $("#grandchild .crow").last().animate({
                opacity : 1,
                left: "+50",
                height: "toggle"
            });
            //_index++;
            $("#numc['.$index.']").val(_index);
            console.log("add num:"+$("#numc").val());
             _index = $("#numc['.$index.']").val();
            //console.log("add index:"+_index);
        }
    });
   
    //_index++;
});
', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('deleteChild', "
function deleteChild(elm, index)
{
    element=$(elm).parent().parent().parent();
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