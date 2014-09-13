<?php
$this->breadcrumbs=array(
	//'Staff'=>array('index'),
	'จัดการผู้ใช้งานระบบ',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


Yii::app()->clientScript->registerScript('delete','
$("#buttonDel").click(function(){
	    console.log($("#user-grid").yiiGridView("getChecked","username"))
        var checked=$("#user-grid").yiiGridView("getChecked","user-grid_c0");
        var count=checked.length;
        if(count>0 && confirm("Do you want to delete these "+count+" item(s)"))
        {
                $.ajax({
                        data:{checked:checked},
                        url:"'.CHtml::normalizeUrl(array('item/remove')).'",
                        success:function(data){$("#item-grid").yiiGridView("update",{});},              
                });
        }
        });


$("a[data-toggle=modal]").click(function(){
    var target = $(this).attr("data-target");
    var url = $(this).attr("href");
    if(url){
        $(target).find(".modal-body").load(url);
    }
});
');



?>

<center><h3>ผู้ใช้งานระบบ</h3></center>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่ม user',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'warning',
    'label'=>'Reset Password',
    'icon'=>'icon-repeat',
    //'url'=>array('create'),
    'htmlOptions'=>array(
    	'class'=>'pull-right',
    	'style'=>'margin:0px 0px 0px 10px;',
    	'onclick'=>'      
                       //console.log($.fn.yiiGridView.getSelection("user-grid").length);
                       if($.fn.yiiGridView.getSelection("user-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการ reset password?","ตกลง");
                       else  
                            js:bootbox.confirm("คุณต้องการจะ reset password เป็น 12345?","ยกเลิก","ตกลง",
			                   function(confirmed){
                                  if(confirmed)
                                  {	
			                   	      $.ajax({
										type: "POST",
										url: "resetPassword",
										data: { selectedID: $.fn.yiiGridView.getSelection("user-grid")}
										})
										.done(function( msg ) {
											$("#user-grid").yiiGridView("update",{});
										});
                                   }
			                  })',
        

    	),
));

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'danger',
    'label'=>'ลบ user',
    'icon'=>'minus-sign',
    //'url'=>array('delAll'),
    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
    'htmlOptions'=>array(
        //'data-toggle'=>'modal',
        //'data-target'=>'#myModal',
        'onclick'=>'      
                       //console.log($.fn.yiiGridView.getSelection("user-grid").length);
                       if($.fn.yiiGridView.getSelection("user-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
                       else  
                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
			                   function(confirmed){
			                   	 	
			                   	 //console.log("Confirmed: "+confirmed);
			                   	 //console.log($.fn.yiiGridView.getSelection("user-grid"));
                                if(confirmed)
			                   	 $.ajax({
										type: "POST",
										url: "deleteSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("user-grid")}
										})
										.done(function( msg ) {
											$("#user-grid").yiiGridView("update",{});
										});
			                  })',
        'class'=>'pull-right'
    ),
)); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
    'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'selectableRows' => 2,
       // 'template'=>"{summary}{items}{pager}",
    'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
	'columns'=>array(
		// 'u_id'=>array(
	 //  	            	  		'header'=>'',
  //                                               'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	 //  	            	  		'name'=> 'u_id',
	 //  	            	  		'value'=>'$data->u_id',
	 //  	            	  		'htmlOptions'=>array(
	 //  	            	  			'style'=>'text-align:center;width:40px'

	 //  	            	  		)
	 //  	            	  	),
		// 'username'=>array(
	 //  	            	  		'header'=>'username',
	 //  	            	  		'name'=> 'username',
  //                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	 //  	            	  		'value'=>'$data->username',
	 //  	            	  		'htmlOptions'=>array(
	 //  	            	  			'style'=>'text-align:center;'

	 //  	            	  		)
	 //  	            	  	),
		// Use CCheckbox column with selectableRows = 2 for Select All
        'checkbox'=> array(
        	    'id'=>'selectedID',
            	'class'=>'CCheckBoxColumn',
            	//'selectableRows' => 2, 
        		 'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		
            	),
		'username'=>array(
			    'header'=>'username', 
				'class' => 'editable.EditableColumn',
				'name' => 'username',
				'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	        ),

				'editable' => array( //editable section
					//'apply' => '$data->user_status != 4', //can't edit deleted users
					//'text'=>'Click',
					//'tooltip'=>'Click',
					'title'=>'Edit username',
					'url' => $this->createUrl('user/updateUser'),
					'success' => 'js: function(response, newValue) {
										if(!response.success) return response.msg;
									}',
					'options' => array(
						'ajaxOptions' => array('dataType' => 'json'),

					), 
					'placement' => 'right',
					'display' => 'js: function() {
					    
					    $(this).attr( "rel", "tooltip");
					    $(this).attr( "data-original-title", "Click to edit");
					    
					}'
				)
		),		 
		'u_group'=>array(
	  	            	  		'header'=>'ประเภท',
	  	            	  		'class' => 'editable.EditableColumn',
                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'u_group',
	  	            	  		//'value'=>'$data->getGroupName($data->u_group)',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
	  	            	  		 'editable' => array(
										'type' => 'select',
										'title'=>'Edit user group',
										'url' => $this->createUrl('user/updateUser'),
										'source' => $this->createUrl('user/getUserGroup'),
										'options' => array( //custom display
											'display' => 'js: function(value, sourceData) {
												var selected = $.grep(sourceData, function(o){ return value == o.value; }),
												colors = {1: "green", 2: "blue", 3: "purple", 4: "gray"};
												$(this).text(selected[0].text).css("color", colors[value]);
												//$(this).attr( "title", "Click to edit");
												$(this).attr( "rel", "tooltip");
					    						$(this).attr( "data-original-title", "Click to edit");
											}'
										),
										//onsave event handler
										'onSave' => 'js: function(e, params) {
												console && console.log("saved value: "+params.newValue);
											}',
										//source url can depend on some parameters, then use js function:
										/*
										'source' => 'js: function() {
										var dob = $(this).closest("td").next().find(".editable").text();
										var username = $(this).data("username");
										return "?r=site/getStatuses&user="+username+"&dob="+dob;
										}',
										'htmlOptions' => array(
										'data-username' => '$data->user_name'
										)
										*/
								)
	  	            	  	),
		
		// array(
		// 	//'class'=>'bootstrap.widgets.TbButtonColumn',
		// 	//'template'=>'{delete}' //removed {view}
	 //    'class' => 'bootstrap.widgets.TbButtonColumn',
		// 'header' => '-',
		// 'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),	  	            	  		
		// 'deleteConfirmation'=>'คุณต้องการจะลบข้อมูล ?',
		// 'template' => '{delete}{reset}',
		// 'buttons' => array(
		// 	'reset' => array
		// 	(
		// 		'label' => 'Reset Password',
		// 		'icon' => 'icon-repeat',
		// 		'options' => array(
		// 			'confirm' => 'คุณต้องการจะลบข้อมูล ?',
					
		// 		),
		// 		'url' => 'Yii::app()->createUrl("/user/delete", array("id"=>$data["u_id"]))',
		// 	),
		//  )
		// ),
	),
)); 


?>



<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>
 
<div class="modal-body">
    <p>One fine body...</p>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>array("create"),
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>