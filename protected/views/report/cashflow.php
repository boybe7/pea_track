<?php
$this->breadcrumbs=array(
	'Cashflow Report',
	
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
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdf.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/compatibility.js"></script> -->
<script type="text/javascript">


window.onload = function (){

         //var success = new PDFObject({ url: "../test.pdf",height: "800px" }).embed("pdf");

   
     
   }; 
</script>


<h4>รายงานสรุปรายได้/ค่าใช้จ่าย</h4>

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
                            $list,array('empty' => 'กรุณาเลือกโครงการ','class'=>'span12'
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


  <div class="row-fluid">
    <div class="span2">
                        <?php 

                 
                        echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
                            $this->widget('zii.widgets.jui.CJuiDatePicker',

                            array(
                                'name'=>'pj_date_approved',
                                'options' => array(
                                                  'mode'=>'focus',
                                                  //'language' => 'th',
                                                  'changeMonth'=>true,
                                                  'changeYear'=>true,
                                                  'format'=>'dd/mm/yyyy', //กำหนด date Format
                                                  'showAnim' => 'slideDown',
                                                  ),
                                'htmlOptions'=>array('class'=>'span12', 'value'=>''),  // ใส่ค่าเดิม ในเหตุการ Update 
                             )
                        );
                        echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

                         ?>
    </div>
    <div class="span2">
    </div>
  </div>  
</div>


<div id="pdf" style=""></div>


<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();

    if($("#project").val()!="")
    {    
        $.ajax({
            url: "genSummary",
            cache:false,
            data: {project: $("#project").val()},
            success:function(response){
               // var success = new PDFObject({ url: "../summaryReport.pdf",height: "800px" }).embed("pdf");
                
               $("#pdf").html(response);                 
            }

        });
    }
    else
    {
        js:bootbox.alert("<font color=red>!!!!กรุณาเลือกโครงการ</font>","ตกลง");
                                                                            
    }
});
', CClientScript::POS_END);


Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();
    window.location.href = "genSummaryExcel?project="+$("#project").val();
    // $.ajax({
    //     url: "genExcel",
    //     data: {project: $("#project").val()},
    //     success:function(response){
            
    //         //$("#reportContent").html(response);
            
    //     }

    // });

});
', CClientScript::POS_END);


?>