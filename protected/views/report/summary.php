<?php
$this->breadcrumbs=array(
	'Summary Report ',
	
);


?>

<style>

.reportTable thead th {
	text-align: center;
	font-weight: bold;
	background-color: #eeeeee;
	vertical-align: middle;
	}

.reportTable td {
	
}

</style>
<script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdfobject.js"></script>
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdf.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/compatibility.js"></script> -->
<script type="text/javascript">

  //
  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
  //
  var url = '../sample.pdf';



window.onload = function (){

        var success = new PDFObject({ url: "../sample.pdf",height: "800px" }).embed("pdf");

   console.log("loaded");
     
   }; 
</script>


<h4>Project Summary Report </h4>

<div class="well">
  <div class="row-fluid">
	<div class="span2">
		<?php

            $projects =Project::model()->findAll(array(
    				'select'=>'pj_fiscalyear',
    				//'group'=>'t.Category',
    				'distinct'=>true,
				));   

			//print_r($projects);	     
     
            $list = CHtml::listData($projects,'pj_fiscalyear','pj_fiscalyear');

            echo CHtml::label('ปีงบประมาณ','fiscalyear');  
            echo CHtml::dropDownList('fiscalyear', '', 
                            $list,array('empty' => 'ทั้งหมด','class'=>'span12'
                            	,
                            	'ajax' => array(
							                'type' => 'POST', //request type
							                'url' => CController::createUrl('ajax/getProjectList'), //url to call.                
							                'update' => '#project', //selector to update   
							                'data' => array('year' => 'js:this.value','workcat_id' => 'js:$("#workcat").val()'),
							        )
                            	));
             	
		?>

	</div>
	<div class="span3">
		<?php

		    $workcat = Yii::app()->db->createCommand()
                    ->select('wc_id,wc_name as name')
                    ->from('work_category')
                    ->queryAll();
     
            $list = CHtml::listData($workcat,'wc_id','name');
    
            echo CHtml::label('ประเภทงาน','workcat');  
            echo CHtml::dropDownList('workcat', '', 
                            $list,array('empty' => 'ทั้งหมด','class'=>'span12'
                            	,
                            	'ajax' => array(
							                'type' => 'POST', //request type
							                'url' => CController::createUrl('ajax/getProjectList'), //url to call.                
							                'update' => '#project', //selector to update   
							                'data' => array('workcat_id' => 'js:this.value','year' => 'js:$("#fiscalyear").val()'),
							        )	
                            	));
             	
		?>

	</div>
	<div class="span4">
		<?php

		    $projects =Project::model()->findAll(array(
    				'select'=>'pj_id,pj_name',
    				'distinct'=>true,
				));   

			//print_r($projects);	     
     
            $list = CHtml::listData($projects,'pj_id','pj_name');
    
            echo CHtml::label('โครงการ','project');  
            echo CHtml::dropDownList('project', '', 
                            $list,array('empty' => 'ทั้งหมด','class'=>'span12'
                            	));
             	
		?>

	</div>
	<div class="span2">
	  <?php
		$this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'inverse',
              'label'=>'ออกรายงาน',
              'icon'=>'list-alt white',
              
              'htmlOptions'=>array(
                'class'=>'span12',
                'style'=>'margin:25px 0px 0px 0px;',
                'id'=>'gentReport'
              ),
          ));
      ?>
	</div>
	<div class="span1">
	  <?php
		$this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'success',
              'label'=>'Excel',
              'icon'=>'excel',
              
              'htmlOptions'=>array(
                'class'=>'span12',
                'style'=>'margin:25px 0px 0px 0px;padding-left:0px;padding-right:0px',
                'id'=>'exportExcel'
              ),
          ));
      ?>
	</div>
  </div>
</div>


<div id="pdf">It appears you don't have Adobe Reader or PDF support in this web browser. <a href="/pdf/sample.pdf">Click here to download the PDF</a></div>


<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "genProgress",
        data: {project: $("#project").val()},
        success:function(response){
            
            $("#reportContent").html(response);
            
        }

    });

});
', CClientScript::POS_END);

?>