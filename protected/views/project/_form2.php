<style type="text/css">
	
	.the-legend {
    
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 0;
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}
.the-fieldset {
    background-color: whiteSmoke;
	border: 1px solid #E3E3E3;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}
hr {
  border-bottom: 1px solid #E3E3E3;
  margin: -5px 0 18px 0;
}

.ui-autocomplete { max-height: 180px; overflow-y: auto; overflow-x: hidden;}
</style>
<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#pj_vendor_id").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });
 
  });

    
	$('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('a[data-toggle="tab"]').on('shown', function (e) {
    	e.target // activated tab
    	e.relatedTarget // previous tab
    });
   
   
</script>
	<!-- <p class="help-block">Fields with <span class="required">*</span> are required.</p> -->
<div class="well">
	<ul class="nav nav-tabs">
      <?php  
        
        	echo '<li><a href="#projTab" data-toggle="tab">โครงการ</a></li>
                 <li  class="active"><a href="#outTab" data-toggle="tab">สัญญาจ้างต่อ</a></li>
                ';	
       
      ?>
        
    </ul>
        
    <div class="tab-content">
        
      <?php 

   
          echo '<div class="tab-pane" id="projTab">';

        	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
      			'id'=>'project-form',
      			'enableAjaxValidation'=>false,
      			'type'=>'vertical',
        			'htmlOptions'=>  array('class'=>'','style'=>''),
      		)); 

      ?>
     <h4>รายละเอียดโครงการ</h4>
     <hr>

		
		<div class="row-fluid">
			<div class="well span8">
      			
      				<!-- <span style='display: block;margin-bottom: 5px;'>คู่สัญญา</span>  -->
      				
				<div class="row-fluid">
					<div class="span4">
      					<?php echo $form->textFieldRow($model,'pj_fiscalyear',array('class'=>'span12','maxlength'=>4,'readonly'=>true)); ?>
    				</div>
    				<div class="span8">
      					<?php echo $form->textFieldRow($model,'pj_date_approved',array('class'=>'span6','readonly'=>true));?>
    				
		      		</div>
		      		
		    		<?php 
      				//echo $form->textFieldRow($model,'pj_work_cat',array('class'=>'span12')); 
      				$workcat = Yii::app()->db->createCommand()
                    ->select('wc_id,wc_name as name')
                    ->from('work_category')
                    ->where('wc_id=:id', array(':id'=>$model->pj_work_cat))
                    ->queryAll();
              
              $workcatName = "";
              if(!empty($workcat))
             	  $workcatName = $workcat[0]["name"];

              echo $form->labelEx($model,'pj_work_cat',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
               
              echo CHtml::textField('pj_work_cat',$workcatName,array('class'=>'span12','readonly'=>true));
            

      				?>
      				<!-- <input type="hidden" name="vendor_id" id="vendor_id"> -->
      				<?php 
  						echo $form->hiddenField($model,'pj_vendor_id');
  						echo $form->labelEx($model,'pj_vendor_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$vendor = Yii::app()->db->createCommand()
                    ->select('v_name as name')
                    ->from('vendor')
                    ->where('v_id=:id', array(':id'=>$model->pj_vendor_id))
                    ->queryAll();
              
              $vendorName = "";
              if(!empty($vendor))
                $vendorName = $vendor[0]["name"];

              echo CHtml::textField('pj_vendor_id',$vendorName,array('class'=>'span12','readonly'=>true));
            
						
				      ?>
    			</div>
    		</div>	
			<div class="well span4">
      			<?php 
      			//echo $form->textFieldRow($model,'pj_code',array('class'=>'span10','maxlength'=>100)); 
      			echo "<span style='display: block;'>หมายเลขงาน</span>"; 
            
      			?>
      			<table class="table table-bordered " style="background-color: #eeeeee" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">                    
	                <tbody>
                            <?php
                                    $workCode = Yii::app()->db->createCommand()
                                                ->select('code,id')
                                                ->from('work_code')
                                                ->where('pj_id=:id', array(':id'=>$model->pj_id))
                                                ->queryAll();
                                    if(!empty($workCode))
                                    {    
                                       foreach ($workCode as $key => $value) {
                                         //print_r($value["code"]);
                                         echo "<tr><td>".$value["code"]."</td></tr>";

                                       }
                                    }
                            ?>
                            
                        </tbody>
                        
            </table>
    		</div>
    		
    		
  		</div>
      <h4>สัญญาโครงการ</h4>
      <hr>
      <?php 
            $project_contract = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('project_contract')
                        ->where('pc_proj_id=:id', array(':id'=>$model->pj_id))
                        ->queryAll();

            if(!empty($project_contract))
            {    
                $id = 1; 
                foreach ($project_contract as $key => $value) {
                    $modelPC =new ProjectContract;
                    $modelPC->attributes = $value;
                    $str_date = explode("-", $value["pc_sign_date"]);
                    if(count($str_date)>1)
                      $modelPC->pc_sign_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
                    $str_date = explode("-", $value["pc_end_date"]);
                    if(count($str_date)>1)
                      $modelPC->pc_end_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
                    $modelPC->pc_details = $value["pc_details"];
                    //print_r($value); 
                    echo '<fieldset class="">';                  
                    echo '<legend class="the-legend">สัญญาที่ '.$id.'</legend>';
                        echo '<div class="row-fluid">';
                          echo '<div class="span3">';
                          echo $form->textFieldRow($modelPC,'pc_code',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span3">';
                          echo $form->textFieldRow($modelPC,'pc_cost',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span3">';
                          echo $form->textFieldRow($modelPC,'pc_sign_date',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span3">';
                          echo $form->textFieldRow($modelPC,'pc_end_date',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                        echo '</div>';
                        echo '<div class="row-fluid">';
                          echo '<div class="span6">';
                          echo $form->textFieldRow($modelPC,'pc_details',array('rows'=>2, 'cols'=>50, 'class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span4">';
                          echo $form->textFieldRow($modelPC,'pc_guarantee',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span1">';
                          echo $form->textFieldRow($modelPC,'pc_T_percent',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                          echo '<div class="span1">';
                          echo $form->textFieldRow($modelPC,'pc_A_percent',array('class'=>'span12','readonly'=>true));
                          echo '</div>';
                        echo '</div>';
                    echo '</fieldset">';   
                    $id++;  
                }
            }              
          
            
        ?>   
           
           


						
		</div>
        <?php $this->endWidget(); ?>
		
        <!-- tab@2  Outsource Contracts -->
		<?php 
			
				echo '<div class="tab-pane active" id="outTab">';		    
		 

		    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'project-form2',
				'enableAjaxValidation'=>false,
				'type'=>'vertical',
  				'htmlOptions'=>  array('class'=>'','style'=>''),
			   ));
     
        echo '<div class="row-fluid">';
         $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'success',
              'label'=>'เพิ่มสัญญา',
              'icon'=>'plus-sign',
              
              'htmlOptions'=>array(
                'class'=>'pull-right',
                'style'=>'margin:0px 10px 0px 10px;',
                'id'=>'loadOutsourceByAjax'
              ),
          )); 

         $this->widget('bootstrap.widgets.TbButton', array(
              'buttonType'=>'link',
              
              'type'=>'danger',
              'label'=>'ลบสัญญา',
              'icon'=>'minus-sign',
              
              'htmlOptions'=>array(
                'class'=>'pull-right',
                'style'=>'margin:0px 10px 0px 10px;',
                'id'=>'delOutsourceByAjax'
              ),
          )); 
         
        echo '</div>';    
    ?>  

	    <div id="outsource">
         
	        <?php

	        echo  '<input type="hidden" id="num" name="num" value="'.$numContracts.'">';
	        $index = 1;

	        // 	$this->renderPartial('//outsourceContract/_form', array(
	        //         'model' => $outsource,
	        //         'index' => 1,
	        //         'display' => 'block'
	        //     ));

	        // $index++;
	        foreach ($outsource as $id => $child):

	            $this->renderPartial('//outsourceContract/_form', array(
	                'model' => $child,
	                'index' => $index,
	                'display' => 'block'
	            ));
	            $index++;
	        endforeach;
	        ?>
	    </div>
	  
             <div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
			

		   
		  <?php $this->endWidget();//end form widget ?>
		</div><!--  endtab2 -->
	</div>		
</div>	

<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	//$model = Vendor::model()->findByPk(14);
    	$model2=new Vendor;
    	$this->renderPartial('/vendor/_form2',array('model'=>$model2),false); 

    	?>
    </div>

    <div id="modal-body-contract">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	//$model = Vendor::model()->findByPk(14);
    	//$modelContract = new Vendor;
    	//$this->renderPartial('/vendor/_form2',array('model'=>$model2)); 

    	?>
    </div>
</div>
<script type="text/javascript">

	var _index = $("#num").val();
	$("#loadOutsourceByAjax2").click(function(e){
	     var _index = $("#num").val();
	     _index++;
	    e.preventDefault();
	    var _url = "../loadOutsourceByAjax?load_for=create2&index="+_index;
	    $.ajax({
	        url: _url,
	        success:function(response){
	            $("#outsource").append(response);
	            $("#outsource .crow").last().animate({
	                opacity : 1,
	                left: "+0",
	                height: "toggle"
	            });

	           
	            $("#num").val(_index);
	            
	             _index = $("#num").val();
	         
	        }

	    });
	});
</script>
 
<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('loadoutsource', '
var _index = ' . $index . ';
var _index = $("#num").val();
$("#loadOutsourceByAjax").click(function(e){
     var _index = $("#num").val();
     _index++;
    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadOutsourceByAjax", array("load_for" => $this->action->id)) . '&index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#outsource").append(response);
            $("#outsource .crow").last().animate({
                opacity : 1,
                left: "+0",
                height: "toggle"
            });

            //_index++;
            $("#num").val(_index);
            //console.log("add num:"+$("#num").val());
             _index = $("#num").val();
            //console.log("add index:"+_index);
        }

    });
    //_index++;
});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('delOutsource', '
$("#delOutsourceByAjax").click(function(e){
    var _index = $("#num").val();
    console.log("del index:"+_index);
    elm = "#OutsourceContract_"+_index+"_oc_code";
    console.log($(elm));
    element=$(elm).parent().parent().parent();
    /* animate div */

    $(element).animate(
    {
        opacity: 0.25,
        left: "+=50",
        height: "toggle"
    }, 500,
    function() {
        /* remove div */
        $(element).remove();
    });
    _index--;
    $("#num").val(_index);
    console.log("del num:"+$("#num").val());
});
', CClientScript::POS_END);
?>