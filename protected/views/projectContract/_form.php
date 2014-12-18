<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/assets/7d883f12/bootstrap-datepicker/css/datepicker.css'); 
?>
<style type="text/css">
  .error {
    font-size: 14px;
  }
  .table-bordered th {
  	text-align: center;
  	vertical-align: middle;
  }
  .tr_white {
  	background-color: white;
  }

</style>
<fieldset class="well the-fieldset">
        <legend class="the-legend contract_no">สัญญาที่ <?php echo ($index);?></legend>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_id'); ?>
        <div class="row-fluid">
        	<div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_code'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_code', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_code',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_cost'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_cost', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_cost',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']pc_sign_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'ProjectContract[' . $index . '][pc_sign_date]',
                            'id'=>$index.'pc_sign_date',
                            'model'=>$model,
                            'value'=>$model->pc_sign_date,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span8'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
            </div>
            <div class="span2">

               <?php 
                   
                    echo CHtml::activeLabelEx($model, '[' . $index . ']pc_end_date'); 
                    echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
                        $this->widget('zii.widgets.jui.CJuiDatePicker',

                        array(
                            'name'=>'ProjectContract[' . $index . '][pc_end_date]',
                            'id'=>$index.'pc_end_date',
                            'model'=>$model,
                            'value'=>$model->pc_end_date,
                            'options' => array(
                                              'mode'=>'focus',
                                              //'language' => 'th',
                                              'format'=>'dd/mm/yyyy', //กำหนด date Format
                                              'showAnim' => 'slideDown',
                                              ),
                            'htmlOptions'=>array('class'=>'span8'),  // ใส่ค่าเดิม ในเหตุการ Update 
                         )
                    );
                    echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

               ?> 
            </div>
            <div class="span2">
            <?php
            		$this->widget('bootstrap.widgets.TbButton', array(
		              'buttonType'=>'link',
		              
		              'type'=>'danger',
		              'label'=>'ลบสัญญา',
		              'icon'=>'minus-sign',
		              
		              'htmlOptions'=>array(
		                'class'=>'pull-right',
		                'style'=>'margin:0px 10px 0px 10px;',
		                'onclick' => 'deleteContract(this, ' . $index . ')'
		              ),
		          ));

            ?>  
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span12">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_details'); ?>
              <?php echo CHtml::activeTextArea($model, '[' . $index . ']pc_details', array('rows'=>2, 'cols'=>50,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_details',array('class'=>'help-block error')); ?>
            </div>
        </div> 
        <div class="row-fluid">
        	<div class="span6">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_guarantee'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_guarantee', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_guarantee',array('class'=>'help-block error')); ?>
            </div>  
            <div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_T_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_T_percent', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_T_percent',array('class'=>'help-block error')); ?>
            </div>
	  		<div class="span3">		  
        	  <?php echo CHtml::activeLabelEx($model, '[' . $index . ']pc_A_percent'); ?>
              <?php echo CHtml::activeTextField($model, '[' . $index . ']pc_A_percent', array('size' => 20, 'maxlength' => 255,'class'=>'span12')); ?>
              <?php echo CHtml::error($model, '[' . $index . ']pc_A_percent',array('class'=>'help-block error')); ?>
            </div>
	  		
	  	</div>

	  	<fieldset class="well the-fieldset">
        	<legend class="the-legend">รายละเอียดการอนุมัติ</legend>
        	<div class="row-fluid"> 
	        <?php	
	  		$this->widget('bootstrap.widgets.TbButton', array(
	              'buttonType'=>'link',
	              
	              'type'=>'success',
	              'label'=>'เพิ่มการอนุมัติ',
	              'icon'=>'plus-sign',
	              
	              'htmlOptions'=>array(
	                'class'=>'pull-right',
	                'style'=>'margin:0px 10px 10px 10px;',
	                       
				     'onclick'=>'
				                  //$("#modal-body2").html($("#modal-body3").html());
				     			  $clone = 	$("#modal-body2").clone().data( "arr", $.extend( [], $("#modal-body2").data( "arr" ) ) );
                                  //console.log($("#modal-content")); 
                                  //console.log($("#modal-body2"));

                                                                  
                                  if($("#modal-body2").length)
                                       $clone = $("#modal-body2");
                                  else
                                       $clone = $("#modal-body3");      
                                  
				                  js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
			                   			function(confirmed){
			                   	 	        console.log("con:"+confirmed)
			                   	 						
                                			if(confirmed)
			                   	 		    {

			                   	 		    	$.ajax({
													type: "POST",
													url: "../contractapprovehistory/createTemp",
													dataType:"json",
													data: $(".modal-body #contract-approve-history-form").serialize()
													})									
													.done(function( msg ) {
														$("#approve-grid").yiiGridView("update",{});
														//consloe.log(msg);
														if(msg.status=="failure")
														{
															$("#modal-body2").html(msg.div);
															js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
								                   			function(confirmed){
								                   	 	        
								                   	 			
					                                			if(confirmed)
								                   	 		    {
								                   	 		    	$.ajax({
																		type: "POST",
																		url: "../contractapprovehistory/createTemp",
																		dataType:"json",
																		data: $(".modal-body #contract-approve-history-form").serialize()
																		})
																		.done(function( msg ) {
																			if(msg.status=="failure")
																			{
																				js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
																			}
																			else{
																				js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
																			}
																		});
								                   	 		    }
															})
														}
														else{
															js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

														}
													});
												$("#approve-grid").yiiGridView("update",{});
											
			                   	 		    }
										})
											
										',
			                
	              ),
	          ));

                  
				$this->widget('bootstrap.widgets.TbGridView',array(
					'id'=>'approve-grid',
				    'type'=>'bordered condensed',
					'dataProvider'=>ContractApproveHistoryTemp::model()->search($index),
					//'filter'=>$model,
					'selectableRows' => 2,
					'enableSorting' => false,
					'rowCssClassExpression'=>'"tr_white"',

				    // 'template'=>"{summary}{items}{pager}",
				    'htmlOptions'=>array('style'=>'padding-top:40px;'),
				    'enablePagination' => false,
				    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
					'columns'=>array(
						    'No.'=>array(
						        'header'=>'ลำดับ',
						        'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  		
								'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	        				),
						        'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						      ),
							'detail'=>array(
							    // 'header'=>'', 
								
								'name' => 'detail',

								'headerHtmlOptions' => array('style' => 'width:35%;text-align:center;background-color: #f5f5f5'),  	            	  		
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'htmlOptions'=>array(
					  	            	  			'style'=>'text-align:left'

					  	        )
					  	    ),
					  	    'approve by'=>array(
							    // 'header'=>'', 
								
								'header' => 'อนุมัติโดย/<br>ลงวันที่',
								'type'=>'raw', //to use html tag
								'value'=> '$data->approveBy."<br>".$data->dateApprove',	
								'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  		
								//'headerHtmlOptions' => array('style' => 'width: 110px'),
								'htmlOptions'=>array(
					  	            	  			'style'=>'text-align:center'

					  	        )
					  	    ),
					  	    'cost'=>array(
							    'header'=>'วงเงิน/<br>เป็นเงินเพิ่ม', 
								
								'name' => 'cost',
								// 'type'=>'raw', //to use html tag
								'value'=> function($data){
						            return number_format($data->cost, 2);
						        },	
								'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  		
								'htmlOptions'=>array(
					  	            	  			'style'=>'text-align:right'

					  	        )
					  	    ),
					  	    'time'=>array(
							    'header'=>'ระยะเวลาแล้วเสร็จ/<br>ระยะเลาขอขยาย', 
								
								'name' => 'timeSpend',
								// 'type'=>'raw', //to use html tag
									
								'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  		
								'htmlOptions'=>array(
					  	            	  			'style'=>'text-align:left'

					  	        )
					  	    ),	
					  	    array(
								'class'=>'bootstrap.widgets.TbButtonColumn',
								'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
								'template' => '{update}   {delete}',
								// 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
								'buttons'=>array(
										'delete'=>array(
											'url'=>'Yii::app()->createUrl("ContractApproveHistory/deleteTemp", array("id"=>$data->id))',	

										),
										'update'=>array(

											'url'=>'Yii::app()->createUrl("ContractApproveHistory/updateTemp", array("id"=>$data->id))',	
											
										)

									)

								
							),
						)

					));

	         ?>
	        </div>
        	<!-- <table class="table table-bordered">
        		<thead>
        			<th width="5%">ลำดับ </th>
        			<th width="35%">รายละเอียด</th>
        			<th width="15%">อนุมัติโดย/<br>วันที่อนุมัติ</th>        			
        			<th width="15%">วงเงิน/<br>เป็นเงินเพิ่ม</th>
        			<th width="25%">ระยะเวลาแล้วเสร็จ/<br>ระยะเลาขอขยาย</th>
        			<th width="5%">ลบ</th>
        		</thead>
        	</table> -->
		</fieldset>
        
       <?php   
          
          if(!$model->isNewRecord) 
          {
            $user = User::model()->findByPk($model->pc_user_update);  
            echo '<div class="pull-right"><b>แก้ไขล่าสุดโดย : '.$user->title.$user->firstname.'  '.$user->lastname.'</b>';
            echo '<br><b>วันที่ : '.$model->pc_last_update.'</b></div>';
          }

       ?>  
           <div id="myModal"  class="modal hide fade">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
    </div>
    <div class="modal-body">
    Date here: <input type="text" id="datePicker2" >
    </div>
    <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
    </div>
    </div>


       <input type="button" value="Show Popup" id="pop_button"/>
		<div id="popup" >
		    <div>
		        Date here: <input type="text" id="datePicker" >
		    </div>
		</div>
</fieldset>
<script type="text/javascript">
	$(document).ready(function() {

	//$('#myModal').modal('hide');	
    $("#popup").dialog({
        open: function() {
            $('#datePicker').removeAttr("disabled");
        },
        close: function () {
            $('#datePicker').datepicker('hide');
        }
    });
    $("#popup").dialog("close");

    $("#datePicker").datepicker();
    $("#datePicker2").datepicker();

    $("#pop_button").click(function() {
        //$('#datePicker').attr("disabled", true);
        $('#myModal').modal('show');
        //$("#popup").dialog("open");
    });
});
</script>
<?php 

		$this->widget('application.extensions.moneymask.MMask',array(
                    'element'=>'#OutsourceContract_' . $index . '_oc_cost',
                    'currency'=>'บาท',
                    'config'=>array(
                        'symbolStay'=>true,
                        'thousands'=>',',
                        'decimal'=>'.',
                        'precision'=>2,
                    )
                ));
?> 



<?php
// $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
//       'id'=>'mydialog',
//       'options'=>array(
//           'title'=>'Update Medico',
//           'autoOpen'=>false,
//       ),
//   ));  
// $this->endWidget('zii.widgets.jui.CJuiDialog');




Yii::app()->clientScript->registerScript('edit','
    var link;

    $("#modalCancel").click(function(e){
    	$("#modalApprove").modal("hide");
    });

    $("#modalSubmit").click(function(e){
       //console.log("submit"+$("#contract-approve-history-form").html());	
      
       //console.log(link);
       $.ajax( {
      		type: "POST",
      		url: link,
      		dataType:"json",
      		data: $("#contract-approve-history-form").serialize(),
      		success: function( msg ) {
        		//console.log(msg.status);

        		//$("#modalApprove").modal("hide");

        		if(msg.status=="failure")									
        		{
					//js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
					$("#contract-approve-history-form").html(msg.div);
				}
				else{
					$("#modalApprove").modal("hide");
					//js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
				}

				$("#approve-grid").yiiGridView("update",{});
      		}
    	} 
    	);

    });


    
	$("body").on("click",".update,#link",function(e){
				link = $(this).attr("href");
				//console.log(link)
				$.ajax({
                 type:"GET",
                 cache: false,
                 url:$(this).attr("href"),
                 success:function(data){
                 	        //console.log(data);
                 	        //var $selector = $("#modal-body2");

                 			//$("#contract-approve-history-form .d-picker").datepicker();
                 			$("#bodyApprove").html(data);
                 			//console.log($("#modalApprove").html());
                 			$("#dateApprove").datepicker("option", {dateFormat: "dd/mm/yyyy"});

                 			 $("#modalApprove").modal("show");

                 			 	
                 	        
             //     			js:bootbox.confirm($("#contract-approve-history-form").html(),"ยกเลิก","ตกลง",
			          //          			function(confirmed){
			          //          	 	        //console.log("con:"+confirmed)
			          //          	 		    //console.log($("#modal-body2").html());
			          //          	 		    //console.log($(this).html());				
             //                    			if(confirmed)
			          //          	 		    {
			          //          	 		    	//console.log("bootbox:"+$(".bootbox my-form-selector").parent().parent()); //<--it should print the object of modal bootbox, it ensures the form is in modal box, not one on hidden div-->
             //    								$(".bootbox my-form-selector").submit();
			          //          	 		    		//console.log("con:"+$(".modal-body #contract-approve-history-form").serialize())
			          //          	 		    		$.ajax({
													// 					type: "POST",
													// 					url: link,
													// 					dataType:"json",
													// 					data: $(".modal-body #contract-approve-history-form").serialize()
													// 					})
													// 					.done(function( msg ) {
													// 						if(msg.status=="failure")
													// 						{
													// 							js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
													// 						}
													// 						else{
													// 							js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
													// 						}
																			
													// 					});
													// $("#approve-grid").yiiGridView("update",{});

			          //          	 		    }
			          //          	 		    $("#approve-grid").yiiGridView("update",{});


			          //          	 		});
						
                 },

                });
         	return false;
    });
						
// link = $(this).attr("href");
// $("body").on("click",".update,#link",function(e){
//         $.ajax({
//                 type:"GET",
//                 url:$(this).attr("href"),
//                 success:function(data){
//                 	$("#mydialog").dialog("open").html(data)

//                    },
//                 });
//         return false;
//         });

// $("body").on("click",".butt",function(e){
//         $.ajax({
//                 type:"POST",
//                 dataType:"json",
//                 data:$("#contract-approve-history-form").serialize(),
//                 url:"../contractapprovehistory/updateTemp/2",
//                 success:function(data){
//                 	$("#approve-grid").yiiGridView("update",{});
//                 } 
//                 });
//         return false;
//         });


');




///Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('delOutsource', "
function deleteContract(elm, index)
{
	js:bootbox.confirm('คุณต้องการจะลบข้อมูล?','ยกเลิก','ตกลง',
		function(confirmed){
           	if(confirmed)
           	{	
					element=$(elm).parent().parent().parent();
				    /* animate div */
				    $(element).animate(
				    {
				        opacity: 0.25,
				        left: '+=50',
				        height: 'toggle'
				    }, 0,
				    function() {
				        /* remove div */
				        $(element).remove();
				    });
				    num = $('#num').val();
				    num--;
				    //$('#num').val(num);
				    
				    //console.log('del num:'+$('#num').val());
				    //rearrange no.
		              var collection = $('.contract_no');
		              //console.log(collection);
		              for(var k=0; k<collection.length; k++){
		                  var element = collection.eq(k);
		                  element.html('สัญญาที่ '+(k+1));
		                  console.log(element.html());
		              }
				    		                   	      
            }
            		
    });

    
}", CClientScript::POS_END);
?>

<script type="text/javascript" src="/pea_track/assets/7d883f12/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
