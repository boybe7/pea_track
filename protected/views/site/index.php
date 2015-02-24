<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

//notify here
 

//end notify

?>



<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	//$model = Vendor::model()->findByPk(14);
    	$model=new Notify('search');
      
        $this->renderPartial('/notify/_content',array('model'=>$model),false); 

    	?>
    </div>
</div>


<?php
Yii::app()->clientScript->registerScript('loadcontract', '
    var _url = "'. Yii::app()->controller->createUrl("notify/content").'";
    $.ajax({
        url: _url,
        success:function(msg){

                
    			js:bootbox.alert($("#modal-body").html(),"close");
    	}
    });			


', CClientScript::POS_END);


?>



<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'ยินดีต้อนรับเข้าสู่ '.CHtml::encode(Yii::app()->name),
)); ?>

<?php $this->endWidget(); ?>

