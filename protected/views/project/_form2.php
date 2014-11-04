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
      			<table class="table" style="background-color: white" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">                    
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
        

  			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
						
		</div>
        <?php $this->endWidget(); ?>
		
        <!-- tab@2  Outsource Contracts -->
		<?php 
			
				echo '<div class="tab-pane active" id="outTab">';		    
		 

		    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'project-form2',
				'enableAjaxValidation'=>true,
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
         
        echo '</div>';    
    ?>  

	    <div id="outsource">
	        <?php
	        $index = 0;
	        if($model->isNewRecord) 
	        	$this->renderPartial('//outsourceContract/_form', array(
	                'model' => $outsource,
	                'index' => 0,
	                'display' => 'block'
	            ));

	        $index++;
	        foreach ($model->outsource as $id => $child):

	            $this->renderPartial('//outsourceContract/_form', array(
	                'model' => $child,
	                'index' => $id,
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

 
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('loadoutsource', '
var _index = ' . $index . ';
$("#loadOutsourceByAjax").click(function(e){
    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadOutsourceByAjax", array("load_for" => $this->action->id)) . '&index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#outsource").append(response);
            $("#outsource .crow").last().animate({
                opacity : 1,
                left: "+50",
                height: "toggle"
            });
        }
    });
    _index++;
});
$("#deleteOutsource").click(function(e){
    $(element).remove();
    _index--;
});
', CClientScript::POS_END);
?>