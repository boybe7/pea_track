<?php
$this->breadcrumbs=array(
	'Service Report ',
	
);

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/jquery.json-2.3.min.js' );
//$cs->registerScriptFile( $theme->getBaseUrl() . '/js/drilldown.js' );

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
    		
          ?>
    	</div>
    
    </div>


    <div class="row-fluid">
      <div class="span12">
          <?php

               
              
                echo CHtml::label('กราฟ','chart');  
                echo CHtml::dropDownList('chart', '', 
                                array("1"=>"รายได้การให้บริการงานวิศวกรรม","2"=>"ค่าใช้จ่ายจ้างเหมาและค่าดำเนินงาน",
                                      "3"=>"ค่าใช้จ่ายจ้างเหมาและค่าดำเนินงานแยกตามประเภทงาน",
                                      "4"=>"เปรียบเทียบรายได้กับค่าใช้จ่าย"
                                      ),array('class'=>'span12'
                              
                                  ));
                  
        ?>

      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
          <?php

               
              
                echo CHtml::label('ประเภทงาน','workcat');  
                $workcat = Yii::app()->db->createCommand()
                    ->select('wc_id,wc_name as name')
                    ->from('work_category')
                    ->where('department_id='.Yii::app()->user->userdept)
                    ->queryAll();
     
                $typelist = CHtml::listData($workcat,'wc_id','name');
                echo CHtml::dropDownList('workcat', '',$typelist,array('empty'=>'ทุกประเภท','class'=>'span12'
                              
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

        $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'info',
                  'label'=>'Word',
                  'icon'=>'word',
                  
                  'htmlOptions'=>array(
                    'class'=>'span4',
                    'style'=>'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
                    'id'=>'exportWord'
                  ),
              ));

          // $this->widget('bootstrap.widgets.TbButton', array(
          //         'buttonType'=>'link',
                  
          //         'type'=>'success',
          //         'label'=>'',
          //         'icon'=>'print white',
                  
          //         'htmlOptions'=>array(
          //           'class'=>'span2',
          //           'style'=>'margin:25px 0px 0px 0px;',
          //           'id'=>'printReport'
          //         ),
          //     ));
      ?>
  </div><!-- end span4--> 
  <div class="span8 well"> 
    <div id="reportContent" style="width: auto; height: 400px; margin: 0 auto;">
       <?php $this->widget('ext.highcharts.HighchartsWidget', array('id' => 'divChart',
                       'htmlOptions'=>array(),  
                       'scripts' => array(
                          'modules/drilldown', // in fact, this is mandatory :)
                          'modules/exporting',
                          ),

                       'options'=>array(
                           'gradient' => array('enabled'=> true),
                           'chart' => array('type' => 'pie',
                                                      'options3d'=>array(
                                                            'enabled'=> true,
                                                            'alpha'=> 45,
                                                            'beta'=> 0
                                             )  
                            ), 
                            'colors'=>array(
                              '#BA514B','#5280BE','#8165A2','#9DBB5B','#50A9C7','#F29B4B','#A8BED5'
                              ),
                            'credits'=> array(
                                  'enabled'=> false
                              ),
                           'title' => array('text' => '','style' => array(
                                          'fontWeight' => 'bold',
                                          'fontSize'=>'25px',
                                          'fontFamily' => 'TH SarabunPSK'
                                          ) ), 
                           'tooltip'=>array(
                                'pointFormat'=>'<b>{point.percentage:.2f}% <br> {point.y} บาท</b>'
                            ),
                           'legend' => array(
                                    'enabled'=> true,
                                    'layout'=> "vertical",
                                    'align'=>"left",
                                    'width'=> 220,
                                    'verticalAlign'=>"middle",
                                    'borderWidth'=> 0,
                                    'itemStyle'=> array(
                                        'fontWeight'=> "bold",
                                        'fontSize'=>'18px',
                                        'fontFamily' => 'TH SarabunPSK'
                                     ),
                                    'title'=> array(
                                      'text'=> "",
                                      'style'=> array(
                                        'fontWeight'=> "bold",
                                        'fontSize'=>'18px',
                                        'fontFamily' => 'TH SarabunPSK'
                                     )
                                    )
                                   
                               ),
                           'plotOptions'=>array (
                             
                              'pie' => array(
                                  'allowPointSelect'=> true,
                                  'borderWidth'=> 3,
                                  //'animation'=> true,
                                  'depth'=> 35,
                                  'cursor'=> "pointer",
                                  'dataLabels' => array(
                                      'enabled' => false,
                                      'distance' => -50,
                                      'style' => array(
                                          'fontWeight' => 'bold',
                                          //'fontFamily' => 'Boon700',
                                          'fontSize'=>'18px',
                                          'fontFamily' => 'TH SarabunPSK',
                                          'color' => 'white',
                                          'textShadow' => '0px 1px 2px black',
                                      ),
                                  ),
                                 
                              ),

                            ),
                            'exporting'=> array(
                              'type'=> 'image/jpeg',
                              'url'=>''
                            ),
                            'drilldown'=> array(
                               'id'=>'xx',
                            
                               'data'=> array(10.85, 7.35, 33.06, 2.81)
                            )   

                        )

                    )); ?>
    </div>

    <div id="reportContent" style="width: auto; height: 400px; margin: 0 auto; display:none">
       <?php $this->widget('ext.highcharts.HighchartsWidget', array('id' => 'divChart2',
                       'htmlOptions'=>array(),  
                       'scripts' => array(
                          'modules/drilldown', // in fact, this is mandatory :)
                          'modules/exporting',
                          ),

                       'options'=>array(
                           'gradient' => array('enabled'=> true),
                           'chart' => array('type' => 'pie',
                                                      'options3d'=>array(
                                                            'enabled'=> true,
                                                            'alpha'=> 45,
                                                            'beta'=> 0
                                             )  
                            ), 
                            'colors'=>array(
                              '#BA514B','#5280BE','#8165A2','#9DBB5B','#50A9C7','#F29B4B','#A8BED5'
                              ),
                            'credits'=> array(
                                  'enabled'=> false
                              ),
                           'title' => array('text' => '','style' => array(
                                          'fontWeight' => 'bold',
                                          'fontSize'=>'25px',
                                          'fontFamily' => 'TH SarabunPSK'
                                          ) ), 
                           'tooltip'=>array(
                                'pointFormat'=>'<b>{point.percentage:.2f}% <br> {point.y} บาท</b>'
                            ),
                           'legend' => array(
                                    'enabled'=> true,
                                    'layout'=> "vertical",
                                    'align'=>"left",
                                    'width'=> 220,
                                    'verticalAlign'=>"middle",
                                    'borderWidth'=> 0,
                                    'itemStyle'=> array(
                                        'fontWeight'=> "bold",
                                        'fontSize'=>'18px',
                                        'fontFamily' => 'TH SarabunPSK'
                                     ),
                                    'title'=> array(
                                      'text'=> "",
                                      'style'=> array(
                                        'fontWeight'=> "bold",
                                        'fontSize'=>'18px',
                                        'fontFamily' => 'TH SarabunPSK'
                                     )
                                    )
                                   
                               ),
                           'plotOptions'=>array (
                             
                              'pie' => array(
                                  'allowPointSelect'=> true,
                                  'borderWidth'=> 3,
                                  //'animation'=> true,
                                  'depth'=> 35,
                                  'cursor'=> "pointer",
                                  'dataLabels' => array(
                                      'enabled' => false,
                                      'distance' => -50,
                                      'style' => array(
                                          'fontWeight' => 'bold',
                                          //'fontFamily' => 'Boon700',
                                          'fontSize'=>'18px',
                                          'fontFamily' => 'TH SarabunPSK',
                                          'color' => 'white',
                                          'textShadow' => '0px 1px 2px black',
                                      ),
                                  ),
                                 
                              ),

                            ),
                            'exporting'=> array(
                              'type'=> 'image/jpeg',
                              'url'=>''
                            ),
                            'drilldown'=> array(
                               'id'=>'xx',
                            
                               'data'=> array(10.85, 7.35, 33.06, 2.81)
                            )   

                        )

                    )); ?>
    </div>
  </div>
</div>    
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript">
  var chart;
  function format(num, fix) {
    var p = num.toFixed(fix).split(".");
    return p[0].split("").reduceRight(function(acc, num, i, orig) {
        if ("-" === num && 0 === i) {
            return num + acc;
        }
        var pos = orig.length - i - 1
        return  num + (pos && !(pos % 3) ? "," : "") + acc;
    }, "") + (p[1] ? "." + p[1] : "");
}

function download(url, data, method){
  //url and data options required
  if( url && data ){ 
    //data can be string of parameters or array/object
    data = typeof data == 'string' ? data : jQuery.param(data);
    //split params into form inputs
    var inputs = '';
    jQuery.each(data.split('&'), function(){ 
      var pair = this.split('=');
      inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />'; 
    });
    //send request
    jQuery('<form action="'+ url +'" method="'+ (method||'post') +'">'+inputs+'</form>')
    .appendTo('body').submit().remove();
  };
};

</script>

<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '


$("#gentReport").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "genService",
        data: {fiscalyear: $("#fiscalyear").val(),report:$("#chart").val(),workcat:$("#workcat").val()},
        dataType: "json",
        success:function(response){
           
          var series1 = [];
          var seriesDrill = [];
          var drill = [];
                        
                           var idx = 0;
                           $.each(response, function(key, val) {
                                
                                if(val["drill"].length > 0)
                                {  
                                  
                                  if(idx==0)
                                    series1.push({name:val["name"],y:parseInt(val["value"]),selected: true,sliced: true,drilldown:"drill"+idx});
                                  else
                                    series1.push({name:val["name"],y:parseInt(val["value"]),sliced: true,drilldown:"drill"+idx});
                                  
                                  seriesDrill.push({id:"drill"+idx,data:val["drill"],sliced: true,showInLegend : true});
                                                                   
                                  drill = val["drill"];
                                  idx++;

                                }else  
                                  series1.push({name:val["name"],y:parseInt(val["value"]),sliced: true});
                              
                           });
           
          var chart = $("#divChart").highcharts();

            // remove old data
            $(chart.series).each(function() {
                this.remove();
            });

            // add new data
            var seriesOpts_01 = {
                
                name: "",
                data: series1,
                showInLegend : true
                          
            }
            chart.addSeries(seriesOpts_01);

            var seriesOpts_02 = {
                
                name: "",
                series: seriesDrill,
                showInLegend : true
                          
            }

            chart.options.drilldown = seriesOpts_02;
            chart.setTitle({text: $( "#chart option:selected" ).text()+" ปี "+$("#fiscalyear").val()}); 

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

Yii::app()->clientScript->registerScript('exportWord', '

var charts = [];

$("#exportWord").click(function(e){
    e.preventDefault();


    //chart 1: income
    nchart = 0;
    $.ajax({
        url: "genService",
        data: {fiscalyear: $("#fiscalyear").val(),report:"all",workcat:""},
        dataType: "json",
        success:function(response){
           
           $.each(response, function(key, response2) {

                    var series1 = [];
                    var seriesDrill = [];
                    var drill = [];
                                  
                                     var idx = 0;
                                     $.each(response2["data"], function(key, val) {
                                          
                                          if(val["drill"].length > 0)
                                          {  
                                            
                                            if(idx==0)
                                              series1.push({name:val["name"],y:parseInt(val["value"]),selected: true,sliced: true,drilldown:"drill"+idx});
                                            else
                                              series1.push({name:val["name"],y:parseInt(val["value"]),sliced: true,drilldown:"drill"+idx});
                                            
                                            seriesDrill.push({id:"drill"+idx,data:val["drill"],sliced: true,showInLegend : true});
                                                                             
                                            drill = val["drill"];
                                            idx++;

                                          }else  
                                            series1.push({name:val["name"],y:parseInt(val["value"]),sliced: true});
                                        
                                     });
                     
                    var chart = $("#divChart2").highcharts();

                      // remove old data
                      $(chart.series).each(function() {
                          this.remove();
                      });

                      // add new data
                      var seriesOpts_01 = {
                          
                          name: "",
                          data: series1,
                          showInLegend : true
                                    
                      }
                      chart.addSeries(seriesOpts_01);

                      var seriesOpts_02 = {
                          
                          name: "",
                          series: seriesDrill,
                          showInLegend : true
                                    
                      }

                      chart.options.drilldown = seriesOpts_02;
                      chart.setTitle({text: response2["name"]+" ปี "+$("#fiscalyear").val()}); 

                      /*ADD CHART DATA TO ARRAY, getSVG for exporting*/

                     charts.push({title:"test",text:"text",svg:chart.getSVG()})
                     nchart++;
                     //console.log(charts); 
            });   

             var json={
              "type":"doc", 
              "title":$("#fiscalyear").val(),
              "header":"header",
              "footer":"footer",
              "data": $.toJSON(charts)
            };


            /*TRICK CLIENT INTO DOWNLOAD FILE WITH jQuery*/
                 download("docgen",json,"POST");
            
        }

    });



          

});
', CClientScript::POS_END);
?>