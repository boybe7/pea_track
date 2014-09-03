
<script src="../dist/js/highcharts.js"></script>

<style>
    .table thead{
        background-color: rgb(0, 136, 204);
        color: white;
    }
</style>
<center><h3>รายงานจำนวนผู้เข้ารับบริการ</h3>
    <form action="printReport">
<div class="form-inline">
 <?php 
            
                echo 'ตั้งแต่วันที่ '; //ใส่ icon ลงไป
                    $this->widget('zii.widgets.jui.CJuiDatePicker',

                    array(
                        'name'=>'date1',
                        'id'=>'date1',
                        'attribute'=>'visit_date',
                        //'model'=>$model,
                        'options' => array(
                                          'mode'=>'focus',
                                          //'language' => 'th',
                                          'format'=>'dd/mm/yyyy',  //กำหนด date Format
                                          'showAnim' => 'slideDown',
                                          ),
                        //'htmlOptions'=>array('value'=>$model->visit_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                     )
                );
               echo '<div class="input-append"><span class="add-on"><i class="icon-calendar"></i></span></div>'; //ใส่ icon ลงไป
                             
                echo '  ถึงวันที่   '; //ใส่ icon ลงไป
                    $this->widget('zii.widgets.jui.CJuiDatePicker',

                    array(
                        'name'=>'date2',
                        'attribute'=>'visit_date',
                        //'model'=>$model,
                        'options' => array(
                                          'mode'=>'focus',
                                          //'language' => 'th',
                                          'format'=>'dd/mm/yyyy',  //กำหนด date Format
                                          'showAnim' => 'slideDown',
                                          ),
                        //'htmlOptions'=>array('value'=>$model->visit_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                     )
                );
               echo '<div class="input-append"><span class="add-on"><i class="icon-calendar"></i></span></div>'; //ใส่ icon ลงไป
 
  ?>
    <button class="btn btn-info" type="button" id="searchButton">ค้นหา <i class="icon-search icon-white"></i></button>
    <button class="btn btn-inverse noPrint " type="submit" id="printButton">พิมพ์รายงาน <i class="icon-print icon-white"></i></button>                                 
 
</div>
    </form>
</center>
                    
          <div class="well" style="margin-top: 10px;">    
                                    <div class="row-fluid"> 
                                         <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#chart" data-toggle="tab">กราฟ</a></li>
                                        <li><a href="#table" data-toggle="tab">ตาราง</a></li>
                                      
                                         </ul>

                                        <div class="tab-content"> 
                                            <div class="tab-pane active row-fluid" id="chart">
                                                 <div class="row-fluid">   
                                                    <div class="span12 section_to_print" >

                                                        <div id="chartcontainer" style="height: 400px;"></div>
                                                     </div>
                                               </div> 
                                               <div class="row-fluid">   
                                                    <div class="span12" >

                                                        <div  style="padding-top:10px;"><table id="tableData" class="table table-bordered" style="background-color: white;">

                                                        </table></div>
                                                     </div>
                                               </div>
                                            </div> 
                                            <div class="tab-pane" id="table">
                                              <div class="row-fluid">   
                                                    <div class="span12" >
                                        
                                                  <?php
                                                  if(!isset($_GET["ajax"]))
                                                      echo $this->renderPartial('_table',array('model'=>$model)); 
                                                   else  
                                                        echo $this->renderPartial('_table',array('model'=>$model)); 
                                                      ?>
                                                    </div>
                                              </div>
                                                <div class="row-fluid">   
                                                    <div class="span12" >
                                        
                                                  <?php 
                                                  
                                               /*   echo CHtml::ajaxSubmitButton('ดูข้อมูล',Yii::app()->createUrl('treatmentRecord/report'),
                                                                    array(
                                                                        'type'=>'POST',
                                                                        'data'=> 'js:{"date1":$("#date1").val(),"date2":$("#date2").val()}',                        
                                                                        'replace' => '#my-grid'           
                                                                    ),array('class'=>'someCssClass',));*/
                                                ?>  
                        <script type="text/javascript">
                          
                            //timeout = 10 * 1000; // in Milliseconds -> multiply with 1000 to use seconds
                            function refresh() {

                                <?php
                                echo CHtml::ajax(array(
                                        'url'=> CController::createUrl('treatmentRecord/report'),
                                        'type'=>'post',
                                        'data'=> 'js:{"date1":$("#date1").val(),"date2":$("#date2").val()}',
                                        'replace'=> '#my-grid'
                                        //'success'=>'allFine'
                                ))
                                ?>

                            }
                            //window.setInterval("refresh()", timeout);

                        </script>                                
                                                        
                                                        
                                                        
                                                          </div>
                                              </div>
                                              
                                               
                                            </div>
                                         </div>    
                                    </div> 
                                </div>
                                                                   

 <script>
        //mask input as format "#,###"
	//if you want to show decimal(.00),please set aPad:true
        
    var chart;
    var categories = [];
    var name;
    var cdata = [];
    var show = false;
    var colors = Highcharts.getOptions().colors;
    var tableDetail;
    
     function setChart(name, categories, data, color,show,title) {
			chart.xAxis[0].setCategories(categories, false);
			 while(chart.series.length > 0)
                                chart.series[0].remove(true);
			chart.addSeries({
				name: name,
				data: data,
                                showInLegend : show,
				color: color || colors[0]
			}, false);
                        chart.xAxis[0].setTitle({text:title});
			chart.redraw();
        }
        
        
     function setChart(data,title) {
			
                        chart.xAxis[0].setCategories(data[0].categories, false);
			 while(chart.series.length > 0)
                                chart.series[0].remove(true);
			
                            
                        chart.addSeries({
				name: data[0].name,
				data: data[0].data,
                                showInLegend : true
				//color: color || colors[0]
			}, false);
                        
                        chart.addSeries({
				name: data[1].name,
				data: data[1].data,
                                showInLegend : true
				//color: color || colors[0]
			}, false);
                           
                        chart.xAxis[0].setTitle({text:title});
			chart.redraw();
        }
        
    function showData(data) {
			$("#tableData").html("");
                        $("#tableData").append("<thead><tr><th style='text-align: center' width='10%'>ลำดับ</th><th width='30%' style='text-align: center'>ชื่อ-นามสกุล</th><th width='25%' style='text-align: center'>ตำแหน่ง</th><th width='35%' style='text-align: center'>สังกัด</th></tr></thead><tbody></tbody></table>");
                        i=1;
                        $.each(data, function(idx, output) {
                               
                                $("#tableData tbody").append("<tr><td style='text-align: center'>"+i+"</td><td>"+output["firstname_th"]+"  "+output["lastname_th"]+"</td><td>"+output["name_th"]+"</td><td>"+output["full"]+"<br>"+output["full1"]+"</td></tr>"); 
                                
                                i++;
                            });
        }
        
        
    jQuery(function($) {
	       
          chart = new Highcharts.Chart({
            chart: {
                type: 'column',
                renderTo: 'chartcontainer'
            },
            title: {
                text: 'รายงานจำนวนผู้เข้ารับบริการ'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
               title: {
                    text: 'ปี พ.ศ.'
                    
                }
            },
            yAxis: {
                min: 0,
                allowDecimals: false,
                title: {
                    text: 'จำนวนคน'
                }
            },
            scrollbar: {
                enabled: true
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} คน</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
             exporting: {      
                width:2000,    // maximum scale to export image
                buttons: { 
                    exportButton: {
                        enabled:false
                    },
                    printButton: {
                        enabled:false
                    }

                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                var drilldown = this.drilldown;
                                if (drilldown) { // drill down
                                    
                                    setChart(drilldown,"เดือน");
                                    //setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color,true,"เดือน");
                                    
                                } else { // restore
                                    /*if(this.toggle) 
                                    {    setChart(name, categories, cdata,"red",false,"ปี");
                                         $("#tableData").html(tableDetail);
                                    }else
                                        showData(this.dataList);
                                     this.toggle = true;*/
                                     //setChart(name, categories, cdata,"red",false,"ปี");
                                     setChart(cdata,"ปี พ.ศ.");
                                }
                            }
                        }
                    }
                },
                series: {
                    pointPadding: 0.05,
                    groupPadding: 0.1
                }
            }
        });
        
         

	}); 
     
       $("#searchButton").click(function() {
               $.ajax({
                       type: "POST",
                       url: "ajax",
                       cache: false,
                       data:{"date1":$("#date1").val(),"date2":$("#date2").val()},
                       dataType: "json"
                    }).done(function( data ) {
                    //console.log(data);
                    
                         categories = [];
                         var series1 = [];
                         var series2 = [];
                         $.each(data[0], function(idx, val) {
                                categories.push(val["year"]);
                                var cat2 = [];
                                var sd1 = [];
                                var sd2 = [];
                                $.each(data[1], function(key2, val2) {
                                      cat2.push(val2["name"]);
                                      sd1.push({y:parseInt(val2["free"]),dataList:val2["name"],toggle:false});
                                      sd2.push({y:parseInt(val2["cost"]),dataList:val2["name"],toggle:false});
                                });
                                var seriesOpt_drill = {
                                        name: "ยางบประมาณ",
                                        categories: cat2,
                                        data: sd1,
                                        color: colors[2]

                                   }
                                   
                                   var seriesOpt_drill2 = {
                                        name: "รายรับสถานพยาบาล",
                                        categories: cat2,
                                        data: sd2,
                                        color: colors[3]

                                   }
                                   
                                   var seriesOptArray = Array(seriesOpt_drill,seriesOpt_drill2);
                                   series1.push({y:parseInt(val["free"]),drilldown:seriesOptArray});
                                   series2.push({y:parseInt(val["cost"]),drilldown:seriesOptArray});
                        });
                        
                         chart.xAxis[0].setCategories(categories);
                         
                         
                         var seriesOpts_01 = {
                                name: "ยางบประมาณ",
                                data: series1,
                                categories: categories,
                                showInLegend : true,
                                dataLabels: {
                                    enabled: true
                                }
                          
                           }
                         
                         var seriesOpts_02 = {
                                name: "รายรับสถานพยาบาล",
                                data: series2,
                                categories: categories,
                                showInLegend : true,
                                dataLabels: {
                                    enabled: true
                                }
                          
                           }
                           cdata[0] = seriesOpts_01;
                           cdata[1] = seriesOpts_02;
                           chart.hideLoading();
                           while(chart.series.length > 0)
                                chart.series[0].remove(true);
                                
                           chart.addSeries(seriesOpts_01, false);
                           chart.addSeries(seriesOpts_02, false);
                           
                           chart.redraw();
                            
                });
                
                refresh(); 
                
            
                
       });

 </script>
           
