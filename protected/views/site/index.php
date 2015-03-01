<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );
//$cs->registerCssFile($theme->getBaseUrl() . '/css/ProgressTracker.css');

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

<h1>ภาพรวมโครงการ</h1>

 <?php

        $year = date("Y")+543;
        //echo $year;
        $sql = "SELECT wc_name,wc_id FROM project LEFT JOIN work_category ON wc_id= pj_work_cat WHERE pj_fiscalyear='$year' GROUP BY pj_work_cat";
		$command = Yii::app()->db->createCommand($sql);
		$workcats = $command->queryAll();	
		//echo $sql;
		//print_r($results);

		$collapse = $this->beginWidget('bootstrap.widgets.TbCollapse'); 
		$alert = array("success","info","warning","danger");
		$id = 0;
        foreach ($workcats as $key => $workcat):
        	  $wid = $workcat['wc_id'];	
	          
			  $Criteria = new CDbCriteria();
			  $Criteria->condition = "pj_work_cat='$wid' AND pj_fiscalyear='$year'";
			  $projects = Project::model()->findAll($Criteria);//$command->queryAll();	

			 // print_r($sql);
              echo '';
              echo '<div class="panel-group" id="accordion'.$wid.'">
					<div class="panel panel-default">
					<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$wid.'">
					  <div class="alert alert-'.$alert[$id].'" role="alert">'.$workcat['wc_name'].'</div>
					</a>
					</h4>
					</div>
					<div id="collapse'.$wid.'" class="panel-collapse collapse in">
					<div class="panel-body">';
			  $index = 1;			
	          foreach ($projects as $key => $project):
                 // print_r($project);     
	              $this->renderPartial('application.views.project._track', array(
	                  'model' => $project,
	                  'root'=>$id,
	                  'index'=>$index,
	                  'display' => 'block'
	              ));
	              $index++;
	          endforeach;

	          echo '</div>
   			 </div>
 		 </div>';

 		 $id++;
        endforeach;  
$this->endWidget();
        
?>
