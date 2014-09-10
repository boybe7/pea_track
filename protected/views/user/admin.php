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
	$.fn.yiiGridView.update('staff-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>ผู้ใช้งานระบบ</h3></center>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'success',
    'label'=>'เพิ่มผู้ใช้งานระบบ',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right'),
)); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'staff-grid',
        'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
       // 'template'=>"{summary}{items}{pager}",
        'htmlOptions'=>array('style'=>'padding-top:40px'),
        'enablePagination' => true,
        'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
	'columns'=>array(
		'u_id'=>array(
	  	            	  		'header'=>'id',
                                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'u_id',
	  	            	  		'value'=>'$data->u_id',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center;width:40px'

	  	            	  		)
	  	            	  	),
		// 'username'=>array(
	 //  	            	  		'header'=>'username',
	 //  	            	  		'name'=> 'username',
  //                                'headerHtmlOptions' => array('style' => 'text-align:center;background-color: #f5f5f5'),
	 //  	            	  		'value'=>'$data->username',
	 //  	            	  		'htmlOptions'=>array(
	 //  	            	  			'style'=>'text-align:center;'

	 //  	            	  		)
	 //  	            	  	),
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
					'url' => $this->createUrl('user/updateUser'),
					'success' => 'js: function(response, newValue) {
										if(!response.success) return response.msg;
									}',
					'options' => array(
						'ajaxOptions' => array('dataType' => 'json')
					), 
					'placement' => 'right',
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
										'url' => $this->createUrl('user/updateUser'),
										'source' => $this->createUrl('user/getUserGroup'),
										'options' => array( //custom display
											'display' => 'js: function(value, sourceData) {
												var selected = $.grep(sourceData, function(o){ return value == o.value; }),
												colors = {1: "green", 2: "blue", 3: "purple", 4: "gray"};
												$(this).text(selected[0].text).css("color", colors[value]);
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
		
		array(
			//'class'=>'bootstrap.widgets.TbButtonColumn',
			//'template'=>'{delete}' //removed {view}
			'class' => 'bootstrap.widgets.TbButtonColumn',
		'header' => 'Actions',
		'deleteConfirmation'=>'คุณต้องการจะลบข้อมูล ?',
		'template' => '{delete}{deleteC}',
		'buttons' => array(
			'deleteC' => array
			(
				'label' => 'Delete company',
				'icon' => 'icon-trash',
				'options' => array(
					'confirm' => 'คุณต้องการจะลบข้อมูล ?',
					
				),
				'url' => 'Yii::app()->createUrl("/user/delete", array("id"=>$data["u_id"]))',
		),
	)
		),
	),
)); 



?>

