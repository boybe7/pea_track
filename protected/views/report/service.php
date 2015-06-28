<?php
$this->breadcrumbs=array(
	'Service Report ',
	
);

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );

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
@media print
{
body * { visibility: hidden;}
#reportContent * { visibility: visible; }
#reportContent { position: absolute; top: 40px; left: 30px; }

/*#print * { visibility: visible;height:100%;}
#print { position: absolute; top: 40px; left: 30px; }*/
}

</style>


<h4>รายงานสรุปรายได้ ค่าใช้จ่ายงานบริการวิศวกรรม</h4>
<div class="row-fluid">
  <div class="well span4">
    
      <div class="row-fluid">
    	<div class="span3">
    		<?php

                $projects =Project::model()->findAll(array(
        				'select'=>'pj_fiscalyear',
                'order'=>'pj_fiscalyear ASC',
        				//'group'=>'t.Category',
        				'distinct'=>true,
    				));   

    			//print_r($projects);	     
         
                $list = CHtml::listData($projects,'pj_fiscalyear','pj_fiscalyear');
                
                $list = array();
                $current_y =  date("Y")+543;
                for($i=$current_y;$i>=$current_y-10;$i--)
                    $list[$i] = $i;  
                
                //print_r($list);
                echo CHtml::label('ปี','fiscalyear');  
                echo CHtml::dropDownList('fiscalyear', '', 
                                $list,array('class'=>'span12'
                                	
                                ));
                 	
    		?>

    	</div>

    	<div class="span9">

    	<!-- </div> -->
    	<!-- <div class="span1"> -->
    	  <?php
    		$this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'success',
                  'label'=>'Excel',
                  'icon'=>'excel',
                  
                  'htmlOptions'=>array(
                    'class'=>'span6',
                    'style'=>'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
                    'id'=>'exportExcel'
                  ),
              ));

          $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'info',
                  'label'=>'',
                  'icon'=>'print white',
                  
                  'htmlOptions'=>array(
                    'class'=>'span4',
                    'style'=>'margin:25px 0px 0px 0px;',
                    'id'=>'printReport'
                  ),
              ));
          ?>
    	</div>
    
    </div>


    <div class="row-fluid">
      <div class="span12">
          <?php

                $projects =Project::model()->findByPK(58);   
                print_r($projects->getManageCost(" BETWEEN '2558-01-01' AND '2558-06-30' "));
              
                echo CHtml::label('กราฟ','chart');  
                echo CHtml::dropDownList('chart', '', 
                                array("1"=>"รายได้การให้บริการงานวิศวกรรม","2"=>"ค่าใช้จ่ายจ้างเหมาและค่าดำเนินงาน",
                                      ),array('class'=>'span12'
                              
                                  ));
                  
        ?>

      </div>
    </div>


      <?php
        $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'inverse',
                  'label'=>'view',
                  'icon'=>'list-alt white',
                  
                  'htmlOptions'=>array(
                    'class'=>'span4',
                    'style'=>'margin:25px 10px 0px 0px;',
                    'id'=>'gentReport'
                  ),
              ));
      ?>
  </div><!-- end span4--> 
  <div class="span8"> 
    <div id="reportContent" >
        
    </div>
  </div>
</div>    

<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "genService",
        data: {fiscalyear: $("#fiscalyear").val(),report:$("#chart").val()},
        success:function(response){
            
            $("#reportContent").html(response);
            
        }

    });

});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('printReport', '
$("#printReport").click(function(e){
    e.preventDefault();
     $.ajax({
        url: "printProgress",
        data: {project: $("#project").val(),fiscalyear: $("#fiscalyear").val(),workcat: $("#workcat").val()},
        success:function(response){
             window.open("../tempReport.pdf", "_blank", "fullscreen=yes");              
            
        }

    });

});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();

     window.location.href = "genProgressExcel?project="+$("#project").val()+"&fiscalyear="+$("#fiscalyear").val()+"&workcat="+$("#workcat").val();
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