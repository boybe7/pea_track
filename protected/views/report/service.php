<?php
$this->breadcrumbs=array(
	'Service Report ',
	
);

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/drilldown.js' );

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
  <div class="span8 well"> 
    <div id="reportContent" style="width: auto; height: 400px; margin: 0 auto">
        
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
$(document).ready(function(){
    alert('hello');
    // Enter code here
});
    jQuery(function($) {
      alert("gg")
      
    });
  }
</script>

<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
var boy = "xxx";
var chart = $("#reportContent").highcharts({
                    chart:{
                    type:"pie",
                                style: {
                                    fontFamily: "Boon400"
                                },
                                events: {
                                  load: function(event) {
                                     
                                  }
                                }
                                
                                },
                    credits:{enabled: false},
                          colors:[
                              "#5485BC", "#EDD447", "#5C9384", "#981A37", "#FCB319","#86A033","#614931", "#00526F","#594266","#cb6828","#aaaaab","#a89375"
                              ],
                          title:{text: $( "#chart option:selected" ).text()},
                    tooltip:{
                      enabled: true,
                      animation: true
                    },
                    plotOptions: {
                              pie: {
                                  allowPointSelect: true,
                                  animation: true,
                                  cursor: "pointer",
                                  showInLegend: true,
                                  dataLabels: {
                                      enabled: false,                        
                                      formatter: function() {
                                          return this.percentage.toFixed(2) ;
                                      }
                                  },
                                  point: {
                                    events: {
                                       click: function() {
                                            
                                            //showData(this.drilldown);
                                            
                                        }
                                    }
                                }                      
                              },
                              series: {
                                  dataLabels: {
                                      enabled: true,
                                      formatter: function() {
                                          return Math.round(this.percentage*100)/100 + " %";
                                      },
                                      distance: -30,
                                      
                                  }
                              }
                          },
                          legend: {
                              enabled: true,
                              layout: "vertical",
                              align: "left",
                              width: 220,
                              verticalAlign: "middle",
                              borderWidth: 0,
                              useHTML: true,
                              labelFormatter: function() {
                                  
                                  return "<div><span>" + this.name + "</span><span>  " + format(this.y) + "  บาท</span></div>";
                              },
                          title: {
                            text: "",
                            style: {
                              fontWeight: "bold"
                            }
                          }
                          },

                          drilldown: {
                             
                          },      
                    series: [
                    ]
                  });



$("#gentReport").click(function(e){
    e.preventDefault();
    $.ajax({
        url: "genService",
        data: {fiscalyear: $("#fiscalyear").val(),report:$("#chart").val()},
        dataType: "json",
        success:function(response){
           
          var series1 = [];
          var seriesDrill = [];
          var drill = [];
                        
                           var idx = 0;
                           $.each(response, function(key, val) {
                                
                                if(val["drill"].length > 0)
                                {  
                                  
                                  
                                  series1.push({name:val["name"],y:parseInt(val["value"]),drilldown:"fruits"});
                                  
                                  //seriesDrill.push({id:"drill"+idx,data:val["drill"]});
                                                                    
                                  drill = val["drill"];
                                  idx++;

                                }else  
                                  series1.push({name:val["name"],y:parseInt(val["value"])});
                              
                           });
           
           $("#reportContent").highcharts({
                    chart:{
                    type:"pie",
                                style: {
                                    fontFamily: "Boon400"
                                },
                                events: {
                                  load: function(event) {
                                     
                                  }
                                }
                                
                                },
                    credits:{enabled: false},
                          colors:[
                              "#5485BC", "#EDD447", "#5C9384", "#981A37", "#FCB319","#86A033","#614931", "#00526F","#594266","#cb6828","#aaaaab","#a89375"
                              ],
                          title:{text: $( "#chart option:selected" ).text()},
                    tooltip:{
                      enabled: true,
                      animation: true
                    },
                    plotOptions: {
                              pie: {
                                  allowPointSelect: true,
                                  animation: true,
                                  cursor: "pointer",
                                  showInLegend: true,
                                  dataLabels: {
                                      enabled: false,                        
                                      formatter: function() {
                                          return this.percentage.toFixed(2) ;
                                      }
                                  },
                                  point: {
                                    events: {
                                       click: function() {
                                            
                                            //showData(this.drilldown);
                                            
                                        }
                                    }
                                }                      
                              },
                              series: {
                                  dataLabels: {
                                      enabled: true,
                                      formatter: function() {
                                          return Math.round(this.percentage*100)/100 + " %";
                                      },
                                      distance: -30,
                                      
                                  }
                              }
                          },
                          legend: {
                              enabled: true,
                              layout: "vertical",
                              align: "left",
                              width: 220,
                              verticalAlign: "middle",
                              borderWidth: 0,
                              useHTML: true,
                              labelFormatter: function() {
                                  
                                  return "<div><span>" + this.name + "</span><span>  " + format(this.y) + "  บาท</span></div>";
                              },
                          title: {
                            text: "",
                            style: {
                              fontWeight: "bold"
                            }
                          }
                          },

                          drilldown: {
                              series: [{
                                  id: "fruits",
                                  name: "Fruits",
                                  data: drill
                              }]
                          },      
                    series: [{
                      type: "pie",
                      dataLabels:{
                      
                      },
                      data: series1
                    }]
                  });

              
           console.log(chart);
            
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