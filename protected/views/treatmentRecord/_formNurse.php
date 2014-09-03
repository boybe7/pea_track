<script>
    function changeSymptom(id){
       $("#symp_code").val(id); 
       // console.log($("#symptomList option[value='"+$("#symp_code").val()+"']").text());
    }  
    function addSympton(){
      
         $('#tgrid').find('tbody').append('<tr id='+$("#symp_code").val()+'><td>'+
                 $("#symp_code").val()+'</td><td>'+$("#symptomList option[value='"+$("#symp_code").val()+"']").text()+
                 '</td><td style="text-align:center"><a href="#" onclick=deleteRow("'+$("#symp_code").val()+'")><i class="icon-remove"></i></a></td></tr>');
         id=0;
         var symptom = '';
         $('#tgrid tbody tr td').each(function(key, value) {
               if(key == (0+id))
               { 
                   console.log($(this).text())
                   symptom += $(this).text()+",";
                   id += 3;   
                }    
               // console.log(key+":"+$(this).text())
         });
         $("#symptom").val(symptom.substring(0,symptom.length-1));
         console.log(symptom.substring(0,symptom.length-1))
    }
   
    function deleteRow(id){
     
        $("#tgrid tr[id='"+id+"']").remove();
        id=0;
         var symptom = '';
         $('#tgrid tbody tr td').each(function(key, value) {
               if(key == (0+id))
               { 
                   console.log($(this).text())
                   symptom += $(this).text()+",";
                   id += 3;   
                }    
                console.log(key+":"+$(this).text())
         });
         $("#symptom").val(symptom.substring(0,symptom.length-1));
    }
    
    $(function() {
        var date = new Date();
        var hour = date.getHours().toString();
        var minute = date.getMinutes().toString();
        
        //if(hour.length<2)
        //    hour = "0"+hour;
        if(minute.length<2)
            minute = "0"+minute;
      
        //$('#TreatmentRecord_hour').val(hour);
        //$('#TreatmentRecord_minute').val(minute);
        
        $('#TreatmentRecord_visit_time').val(hour+":"+minute);
        
        var curr_date = date.getDate();
        var curr_month = date.getMonth() + 1; //Months are zero based
        var curr_year = date.getFullYear()+543;
        $('#visit_date').val(curr_date+"/"+curr_month+"/"+curr_year);
    });
</script>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'treatment-record-form',
	'enableAjaxValidation'=>false,
        'type'=>'vertical',
        'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;;'),
)); 



?>
        
       
	<?php echo $form->errorSummary($model); ?>
      <div class="well">
        <div class="row-fluid">
            <div class="span2">
             <?php echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); ?>
            </div>
            <div class="span3 offset4">
             <?php 
             //echo $form->textFieldRow($model,'visit_date',array('class'=>'span12')); 
             
                echo $form->labelEx($model,'visit_date'); 
                echo '<div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>'; //ใส่ icon ลงไป
                    $form->widget('zii.widgets.jui.CJuiDatePicker',

                    array(
                        'name'=>'visit_date',
                        'attribute'=>'visit_date',
                        'model'=>$model,
                        'options' => array(
                                          'mode'=>'focus',
                                          //'language' => 'th',
                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
                                          'showAnim' => 'slideDown',
                                          ),
                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->visit_date),  // ใส่ค่าเดิม ในเหตุการ Update 
                     )
                );
                echo '</div>';
             ?>
            </div>
             <div class="span3">
             <?php
            // echo $form->textFieldRow($model,'visit_time',array('class'=>'span6'));
//             echo $form->timepickerRow(
//                    $model,
//                    'visit_time',
//                    array('options' => array('showMeridian' => false))
//                );
         
              //echo $form->labelEx($model,'visit_time');
              
              $hours = array();
              $minutes = array();
              for($i=0;$i<60;$i++)
              {
                  $index = $i;
                  if($i<10)
                      $index = '0'.$i;
                  if($i<24)
                  {
                      $hours[$index] = $index;
                      $minutes[$index] = $index;
                  }else{
                      $minutes[$index] = $index;
                  }    
                  
              }
              
              echo $form->textFieldRow($model,'visit_time',array('class'=>'span6','readonly'=>true));
              //echo $form->dropDownListRow($model, 'hour', $hours,array('class'=>'span5','labelOptions' => array('label' => false)), array('options' => array('hour'=>array('selected'=>true)))); 
              //echo CHtml::dropDownList('hour', $model,$hours,array('class'=>'span5','multiple'=>false,'prompt'=>'00','options' => array('hour'=>array('selected'=>true))));
              //echo ":";
              //echo $form->dropDownListRow($model, 'minute', $minutes,array('class'=>'span5','labelOptions' => array('label' => false)), array('options' => array('minute'=>array('selected'=>true)))); 
              //echo CHtml::dropDownList('minute', $model,$minutes,array('class'=>'span5','options' => array($model->minute=>array('selected'=>true))));
              
             // echo $form->dropDownListRow($model, 'hour', array('00','01'), array('class'=>'span5','options' => array('2'=>array('selected'=>true))));  
             // echo $form->dropDownListRow($model, 'minute', array('00','01'), array('class'=>'span5','options' => array('2'=>array('selected'=>true))));  
             ?>
            </div>
        </div>
        <div class="row-fluid">
            
            <div class="span3">
             <?php echo $form->textFieldRow($model,'firstname',array('class'=>'span12','readonly'=>true)); ?>
            </div>
             <div class="span3">
             <?php echo $form->textFieldRow($model,'lastname',array('class'=>'span12','readonly'=>true)); ?>
            </div>
             <div class="span3">
             <?php 
             //echo $form->textFieldRow($model,'nurseID',array('class'=>'span12'));
             
             $nurse = Yii::app()->db->createCommand()
                    ->select('staff_id,concat(title,firstname, " ", lastname) as name')
                    ->from('staff')
                    ->where('type_id=:id', array(':id'=>'N'))
                    ->queryAll();
             
           // print_r($nurse);
            
            //print_r(StaffType::model()->findAll());
             $typelist = CHtml::listData($nurse,'staff_id','name');
             echo $form->dropDownListRow($model, 'nurseID', $typelist,array('class'=>'span12'), array('options' => array('nurseID'=>array('selected'=>true)))); 
             ?>
            </div>
             <div class="span3">
             <?php 
           
             $doctor = Yii::app()->db->createCommand()
                    ->select('staff_id,concat(title,firstname, " ", lastname) as name')
                    ->from('staff')
                    ->where('type_id=:id', array(':id'=>'D'))
                    ->queryAll();
     
             $typelist = CHtml::listData($doctor,'staff_id','name');
             echo $form->dropDownListRow($model, 'doctorID', $typelist,array('class'=>'span12'), array('options' => array('doctorID'=>array('selected'=>true)))); 
             ?>
            </div>
        </div>  
      </div>
        
     <div class="row-fluid">
        <div class="span8">  
        <div class="well">
            <div class="row-fluid">
                <div class="span2">
                    
                    <?php 
                    
                    echo $form->labelEx($model,'symp_code'); 
                    echo CHtml::textField('symp_code','',array('class'=>'span12','readonly'=>true));
                    
                    ?>
                </div>
                <div class="span6">
                 <?php   
                       $typelist = CHtml::listData(Symptom::model()->findAll(array('order'=>'name')),'code','name');
                       echo $form->labelEx($model,'symptomID'); 
                       echo CHtml::dropDownList('symptomList',0, $typelist,array('class'=>'span12','onchange'=>'changeSymptom(this.value);','prompt'=>'---------------'));
                     //  echo $form->dropDownListRow($model, 'symptomID', $typelist,array('class'=>'span12','onchange'=>'changeSymptom(this.value);','prompt'=>'---------------'), array('options' => array('symptomID'=>array('selected'=>true)))); 
                       //print_r($typelist);  
                       //autocompelete
                       /*$symptoms = array();
                       $id = 0;
                       foreach ($typelist as $key => $value) {
                            $symptoms[$id++] = $value;
                        }
                       // print_r($symptoms);  
                       $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                            'name'=>'normal',
                            'source'=>$symptoms,//array('ac1','ac2','ac3'),
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                'minLength'=>'2',
                                
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;',
                            ),
                        ));*/
                       
                 ?>
                </div>
                 <div class="span4 ">
                     <div>&nbsp;</div>
                  <?php   
                     $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'link',
                        'type'=>'success',
                        'label'=>'เพิ่ม',
                        'icon'=>'plus-sign',
                        'url'=>'',
                        'htmlOptions'=>array('class'=>'span4','onclick'=>'addSympton()'),
                    )); 
                    echo '&nbsp;';  
                   /*  $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'link',
                        'type'=>'danger',
                        'label'=>'ลบ',
                        'icon'=>'minus-sign',
                        'url'=>array('create'),
                        'htmlOptions'=>array('class'=>'span4'),
                    ));*/
                 ?>
                </div>
            </div>
            <table class="table table-bordered" style="background-color: white" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">
                        <thead >
	                    <tr>
                                <th width="130px"  style="text-align: center">รหัสอาการ</th>	                   
	                        <th  style="text-align: center">อาการ</th>	                        
	                        <th width="30px"></th>
	                    </tr>
	                </thead>
	                <tbody>
                            <?php
                                 $symlist =  explode(",", $model->symptomID);
                                 
                                 $symp_str = '';
                                 foreach ($symlist as $key => $value) {
                                   // echo "Key: $key; Value: $value<br />\n";
                                    $symptom = Yii::app()->db->createCommand()
                                                ->select('name')
                                                ->from('symptom')
                                                ->where('code=:id', array(':id'=>$value))
                                                ->queryAll();
                                    if(!empty($symptom))
                                    {    
                                       echo "<tr id='".$value."'><td>".$value."</td><td>".$symptom[0]["name"]."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$value."')><i class='icon-remove'></i></a></tr>";
                                
                                       $symp_str .= $value.",";
                                    }
                                 }
                                
                                $symp_str = substr($symp_str,0,strlen($symp_str)-1);
                                echo '<input type="hidden" name="symptom2" id="symptom2" value="'.$symp_str.'">';
                            ?>
                            <input type="hidden" name="symptom" id="symptom">
                        </tbody>
                        
            </table>
         </div>
        </div>
         <div class="span4">  
        <div class="well">
             <fieldset >
                 <legend style="font-size: 14px;line-height: 12px"><b>Vital signs</b></legend>
                 <?php echo $form->textFieldRow($model,'temperature',array('class'=>'span12','prepend' => '<i class="icon-temp"></i>','append' => '°C','maxlength'=>5)); ?>
                 <?php echo $form->textFieldRow($model,'rate',array('class'=>'span12','prepend' => '<i class="icon-rate"></i>','append' => '/min','maxlength'=>3)); ?>
                 <?php echo $form->textFieldRow($model,'pulse',array('class'=>'span12','prepend' => '<i class="icon-pulse"></i>','append' => '/min','maxlength'=>3)); ?>
                 <?php echo $form->labelEx($model,'bloodpressure'); ?>
            <div class="row-fluid">
                <div class="span4">  
                 <?php 
                     
                      echo $form->textFieldRow($model,'bloodPressure1',array('class'=>'span10','prepend' => '<i class="icon-tint"></i>','labelOptions' => array('label' => false),'maxlength'=>3));
                           
                      //echo $form->textFieldRow($model,'bloodPressure2',array('class'=>'span5','labelOptions' => array('label' => false),'append' => '/mmHg'));
                 ?>  
                </div>
                <div class="span1"><span class="span12"><center>/</center></span> </div>
                <div class="span5">  
                 <?php 
                     
                      //echo $form->textFieldRow($model,'bloodPressure1',array('class'=>'span5','prepend' => '<i class="icon-pulse"></i>','labelOptions' => array('label' => false)));
                           
                      echo $form->textFieldRow($model,'bloodPressure2',array('class'=>'span7','labelOptions' => array('label' => false),'append' => '/mmHg','maxlength'=>3));
                 ?>  
                </div> 
            </div>
             </fieldset> 
         </div>
        </div>
     </div>   


	<div class="form-actions">
                <div class="pull-right">    
		<?php 
                 $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
                        'htmlOptions' => array('class'=>''),
                    
		)); 
         
               echo "<span>  </span>";
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ยกเลิก',
                        'htmlOptions' => array('class'=>''),
                        'url'=>array("index"), 
		)); 
                
               
                ?>
            </div>
	</div>

<?php $this->endWidget(); ?>
