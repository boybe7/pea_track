
<script src="../dist/js/highcharts.js"></script>
<script src="../dist/js/jquery.printElement.min.js"></script>

<style>
    .table thead{
        background-color: rgb(0, 136, 204);
        color: white;
    }
    
   @media print 
    {
        .noPrint 
        {
            display:none;
        }
        th,td {
            border:solid #222 !important;
            border-width:1px 1px 1px 1px !important;
            width: 60%;
        }
        
        .fixwidth { }
        input[type=text]{ border:none;width: 100px; }
        
        .input-append 
        {
            display:none;
             border:none 
        }
    }


</style>
<center><h3>รายงานสรุปยอดเงินรายรับสถานพยาบาล</h3>
<div class="form-inline ">
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
                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
                                          'showAnim' => 'slideDown',
                                          ),
                        //'htmlOptions'=>array('value'=>$model->visit_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                     )
                );
              // echo '<div class="input-append noPrint "><span class="add-on noPrint"><i class="icon-calendar"></i></span></div>'; //ใส่ icon ลงไป
                             
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
              // echo '<div class="input-append noPrint "><span class="add-on "><i class="icon-calendar"></i></span></div>'; //ใส่ icon ลงไป
 
  ?>
    <button class="btn btn-info noPrint " type="button" id="searchButton">ค้นหา <i class="icon-search icon-white"></i></button>
    <button class="btn btn-inverse noPrint " type="button" id="printButton">พิมพ์รายงาน <i class="icon-print icon-white"></i></button>                                 
</div>
</center>
                    
          <div id="printarea" style="margin-top: 10px;">  
              
          </div>
                                                                   
          <div id="sum"></div>
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
        
    $("#searchButton").click(function() {
               $.ajax({
                       type: "POST",
                       url: "ajaxIncome",
                       cache: false,
                       data:{"date1":$("#date1").val(),"date2":$("#date2").val()},
                       dataType: "json"
                    }).done(function( data ) {
                        
                        $('#printarea').html('<table class="table table-bordered" style="background-color: white" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">'+
                                    '<thead ><tr><th  style="text-align: center">วันที่</th>'+                       
                                            '<th class="fixwidth" style="text-align: center;width: 500px">จำนวนเงิน(บาท)</th>'+
                                    '</tr></thead><tbody></tbody></table>');
                       
                        if(data==null || data.length == 0)
                        {
                            $('#tgrid').find('tbody').html('<tr><td colspan=2><h4>ไม่พบข้อมูล</h4></td></tr>');
                        }else{
                            $('#tgrid').find('tbody').html(''); 
                            var sum = 0;
                            $.each(data, function(idx, val) {
                                sum += parseInt(val["no"]); 
                                $('#tgrid').find('tbody').append('<tr><td style="text-align:center">'+val["name"]+'</td><td style="text-align:center">'+parseInt(val["no"])+'</td></tr>');
                            });
                            
                            $('#sum').html('<center><h4>รวมเป็นเงินทั้งสิ้น '+ sum +'  บาท</h4></center>'); 
                        }     
                    });
     });   
     
     $("#printButton").click(function() {
             // $("#title").html("<h3>รายงานการวินิจฉัยโรคตามช่วงเวลา</h3>");
              window.print();
     });   
        
    jQuery(function($) {
	       
         /* chart = new Highcharts.Chart({
            chart: {
                type: 'column',
                renderTo: 'chartcontainer'
            },
            title: {
                text: 'รายงานการวินิจฉัยโรคตามช่วงเวลา'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
               title: {
                    text: 'โรค'
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
                pointFormat: '<tr><td style="color:{series.color};padding:0">{point.key}: </td>' +
                    '<td style="padding:0"><b>{point.y} คน</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
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
                       url: "ajaxDiag",
                       cache: false,
                       data:{"date1":$("#date1").val(),"date2":$("#date2").val()},
                       dataType: "json"
                    }).done(function( data ) {
                    
                    
                         categories = [];
                         var series1 = [];
                         var series2 = [];
                         $.each(data, function(idx, val) {
                                categories.push(val["name"]);
                            
                                 series1.push({y:parseInt(val["no"])});
                        });
                        
                         chart.xAxis[0].setCategories(categories);
                         
                         
                         var seriesOpts_01 = {
                                name: "โรค",
                                data: series1,
                                categories: categories,
                                showInLegend : false,
                                dataLabels: {
                                    enabled: true
                                }
                          
                           }
                        
                           cdata[0] = seriesOpts_01;
                          
                           chart.hideLoading();
                           while(chart.series.length > 0)
                                chart.series[0].remove(true);
                                
                           chart.addSeries(seriesOpts_01, false);
                           //chart.addSeries(seriesOpts_02, false);
                           
                           chart.redraw();
                            
                });
                
                refresh(); */
               
                
       });

 </script>
           
