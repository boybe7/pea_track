<style>
    .ui-autocomplete { max-height: 180px; overflow-y: auto; overflow-x: hidden;}
    input[type="text"].redfont {color:#ff0000;font-size: 18px; }
    .red {color:#ff0000;font-size: 25px; }
    /*
    .ui-menu-item a
    {
        max-width:100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    } */ 
</style>
<script>
        $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    
        $('a[data-toggle="tab"]').on('shown', function (e) {
    e.target // activated tab
    e.relatedTarget // previous tab
    })
    
    function changeSymptom(id){
       $("#diag_code").val(id); 
       // console.log($("#symptomList option[value='"+$("#symp_code").val()+"']").text());
    } 
    
    function changeDrugs(id){
       $("#drug_code").val(id); 
       //console.log($("#drugList option[value='"+id+"']").text());
       //drugname = $("#drugList option[value='"+id+"']").text();
       //str = drugname.split("-");
       
       //$("#unit").val(str[1]);
       // console.log($("#symptomList option[value='"+$("#symp_code").val()+"']").text());
    }
    
   
    function addSympton(){
      
//         $('#tgrid').find('tbody').append('<tr id='+$("#diag_code").val()+'><td>'+
//                 $("#diag_code").val()+'</td><td>'+$("#diagList option[value='"+$("#diag_code").val()+"']").text()+
//                 '</td><td style="text-align:center"><a href="#" onclick=deleteRow("'+$("#diag_code").val()+'")><i class="icon-remove"></i></a></td></tr>');
//        
         
          $('#tgrid').find('tbody').append('<tr id='+$("#diag_id").val()+'><td>'+
                 $("#diag_code").val()+'</td><td>'+$("#diag_name").val()+
                 '</td><td style="text-align:center"><a href="#" onclick=deleteRow("'+$("#diag_id").val()+'")><i class="icon-remove"></i></a></td></tr>');
        
          id=0;
         var symptom = '';
         $('#tgrid tbody tr td').each(function(key, value) {
               if(key == (0+id))
               { 
                   //console.log($(this).text())
                   symptom += $(this).text()+",";
                   id += 3;   
                }    
               // console.log(key+":"+$(this).text())
         });
         $("#diagnosis").val(symptom.substring(0,symptom.length-1));
         $('.ui-autocomplete-input').val('');
         //console.log(symptom.substring(0,symptom.length-1))
    }
    function addDrug(){
         str = $("#drugList option[value='"+$("#drug_code").val()+"']").text();
         console.log($("#drug_code").val());
         drug = str.split("-");
         /*$('#tgrid2').find('tbody').append('<tr id='+$("#drug_code").val()+'><td>'+$("#drug_code").val()+"</td><td>"+
                 drug[0]+'</td><td style="text-align:center">'+$("#quantity").val()+'</td><td style="text-align:center">'+$("#unit").val()+'</td><td>'+$("#method option:selected").text()+
                 '</td><td style="text-align:center"><a href="#" onclick=deleteDrug("'+$("#drug_code").val()+'")><i class="icon-remove"></i></a></td></tr>');
         
    */
        if($("#quantity").val()=="")
            $("#quantity").val("1");
        $('#tgrid2').find('tbody').append('<tr id='+$("#drug_code").val()+'><td>'+$("#drug_code").val()+"</td><td>"+
                 $("#drug_name").val()+'</td><td style="text-align:center">'+parseInt($("#quantity").val())+'</td><td style="text-align:center">'+$("#unit").val()+'</td><td>'+$("#drug_method").val()+
                 '</td><td style="text-align:center"><a href="#" onclick=deleteDrug("'+$("#drug_code").val()+'")><i class="icon-remove"></i></a></td></tr>');
          
        id=0;
         var symptom = '';
         
         $('#tgrid2 tbody tr td').each(function(key, value) {
                if(key%2 == 0) 
                  symptom += $(this).text()+":";    
                if(key == (4+id))
                { 
                   symptom = symptom.substring(0,symptom.length-1);
                   symptom += ",";
                   id += 6;   
                }  
                
                //console.log(key+":"+$(this).text())
         });
         
         $("#drug").val(symptom.substring(0,symptom.length-1));
         //console.log(symptom.substring(0,symptom.length-1))
         $('.ui-autocomplete-input').val('');

    }
    function deleteDrug(id){
     
        $("#tgrid2 tr[id='"+id+"']").remove();
        id=0;
         var symptom = '';
         $('#tgrid2 tbody tr td').each(function(key, value) {
                if(key%2 == 0) 
                  symptom += $(this).text()+":";    
                if(key == (4+id))
                { 
                   symptom = symptom.substring(0,symptom.length-1);
                   symptom += ",";
                   id += 6;   
                }  
                
                //console.log(key+":"+$(this).text())
         });
         
         $("#drug").val(symptom.substring(0,symptom.length-1));
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
         $("#diagnosis").val(symptom.substring(0,symptom.length-1));
    }
    
    $(function(){
        
  
            $("#drugList").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
            });
            
            $("#diagList").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
            });
			
	    $("#drugMethod").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
            });
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
             <div class="span4">
             <?php //echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); 
                   echo "<span style='display: block;margin-bottom: 5px;'>ชื่อผู้ป่วย</span>";
                   echo  CHtml::textField('pt_name',$model->title."".$model->firstname."  ".$model->lastname,array('class'=>'span12','readonly'=>true));
             ?>
            </div>
            <div class="span3">
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
        <div class="row-fluid">
            <div class="span6">
             <?php //echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); 
                   echo "<span style='display: block;margin-bottom: 5px;'>แพ้ยา</span>";
                  // echo  CHtml::textField('allergy',$model->allergy,array('class'=>'span12 redfont'));
                   echo  CHtml::label($model->allergy,'',array('class'=>'span12 red'));
             ?>
             </div> 
            <div class="span6">
             <?php //echo $form->textFieldRow($model,'HN',array('class'=>'span12','readonly'=>true)); 
                   echo "<span style='display: block;margin-bottom: 5px;'>อาการ</span>";
                   
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
                                
                                       $symp_str .= $symptom[0]["name"].",";
                                    }
                   }
                   
                   $symp_str = substr($symp_str,0,strlen($symp_str)-1);
                   echo  CHtml::textField('symptomSTR',$symp_str,array('class'=>'span12',));
             ?>
             </div>
        </div>  
      </div>
        
     <div class="row-fluid">
        <div class="span7">  
        <div class="well">
             <fieldset >
                 <legend style="font-size: 14px;line-height: 12px"><b>วินิจฉัยโรค</b></legend>
            <div class="row-fluid">
                <div class="span2">
                    
                    <?php 
                    
                    echo "<span style='display: block;margin-bottom: 5px;'>รหัสโรค</span>"; 
                    echo CHtml::textField('diag_code','',array('class'=>'span12','readonly'=>true));
                    
                    ?>
                </div>
                <div class="span6">
                 <?php 
                      echo CHtml::hiddenField('diag_name','',array('class'=>'span12','readonly'=>true));
                      echo CHtml::hiddenField('diag_id','',array('class'=>'span12','readonly'=>true));
                       $typelist = CHtml::listData(Diagnosis::model()->findAll(array('order'=>'name')),'code','name');
                        echo "<span style='display: block;margin-bottom: 5px;'>ชื่อโรค</span>";  
                       //echo CHtml::dropDownList('diagList',0, $typelist,array('class'=>'span12','onchange'=>'changeSymptom(this.value);','prompt'=>'---------------'));
                     //  echo $form->dropDownListRow($model, 'symptomID', $typelist,array('class'=>'span12','onchange'=>'changeSymptom(this.value);','prompt'=>'---------------'), array('options' => array('symptomID'=>array('selected'=>true)))); 
                       //print_r($typelist);  
                       //autocompelete
                      $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'diagList',
                            'id'=>'diagList',
                       
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Ajax/GetDiag').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                    },
                                    success: function (data) {
                                            response(data);
                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                    'showAnim'=>'fold',
                                     'minLength'=>'0',
                                     'select'=>'js: function(event, ui) {
                                          $("#diag_name").val(ui.item.value); 

                                           $.ajax({
                                                url: "'.$this->createUrl('Ajax/GetDiagCode').'",
                                                type: "POST",
                                                data: {
                                                    name: ui.item.value,
                                                },
                                                success: function (data) {
                                                       data = data.split(":");
                                                      $("#diag_code").val(data[0])
                                                      $("#diag_id").val(data[1])
                                                }
                                            })
                                           
                                     }',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
                       
                 ?>
                </div>
                 <div class="span4 ">
                     <div style='display: block;margin-bottom: 5px;'>&nbsp;</div>
                  <?php   
                     $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'link',
                        'type'=>'success',
                        'label'=>'เพิ่ม',
                        'icon'=>'plus-sign',
                        'url'=>'',
                        'htmlOptions'=>array('class'=>'span5','onclick'=>'addSympton()'),
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
            </fieldset>      
            <table class="table table-bordered" style="background-color: white" name="tgrid" id="tgrid" width="100%" cellpadding="0" cellspacing="0">
                        <thead >
	                    <tr>
                                <th width="130px"  style="text-align: center">รหัสโรค</th>	                   
	                        <th  style="text-align: center">ชื่อโรค</th>	                        
	                        <th width="30px"></th>
	                    </tr>
	                </thead>
	                <tbody>
                            <?php
                                 //$symlist =  explode(",", $model->symptomID);
                                 
                                 //$symp_str = '';
                                 //foreach ($symlist as $key => $value) {
                                   // echo "Key: $key; Value: $value<br />\n";
                                    $symptom = Yii::app()->db->createCommand()
                                                ->select('name')
                                                ->from('diagnosis')
                                                ->where('code=:id', array(':id'=>$model->diagID1))
                                                ->queryAll();
                                    if(!empty($symptom))
                                    {    
                                       echo "<tr id='".$model->diagID1."'><td>".$model->diagID1."</td><td>".$symptom[0]["name"]."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$model->diagID1."')><i class='icon-remove'></i></a></tr>";
                                
                                    }
                                    
                                    $symptom = Yii::app()->db->createCommand()
                                                ->select('name')
                                                ->from('diagnosis')
                                                ->where('code=:id', array(':id'=>$model->diagID2))
                                                ->queryAll();
                                    if(!empty($symptom))
                                    {    
                                       echo "<tr id='".$model->diagID2."'><td>".$model->diagID2."</td><td>".$symptom[0]["name"]."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$model->diagID2."')><i class='icon-remove'></i></a></tr>";
                                
                                    }
                                    
                                    $symptom = Yii::app()->db->createCommand()
                                                ->select('name')
                                                ->from('diagnosis')
                                                ->where('code=:id', array(':id'=>$model->diagID3))
                                                ->queryAll();
                                    if(!empty($symptom))
                                    {    
                                       echo "<tr id='".$model->diagID3."'><td>".$model->diagID3."</td><td>".$symptom[0]["name"]."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$model->diagID3."')><i class='icon-remove'></i></a></tr>";
                                
                                    }
                                 //}
                                
                                //$symp_str = substr($symp_str,0,strlen($symp_str)-1);
                                //echo '<input type="hidden" name="symptom2" id="symptom2" value="'.$symp_str.'">';
                            ?>
                            <input type="hidden" name="diagnosis" id="diagnosis">
                        </tbody>
                        
            </table>
             
         </div>
        </div>
         <div class="span5">  
        <div class="well">
             <fieldset >
                 <legend style="font-size: 14px;line-height: 12px"><b>Vital signs</b></legend>
                 <div class="row-fluid">
                    <div class="span4">
                        <?php echo $form->textFieldRow($model,'temperature',array('class'=>'span5','prepend' => '<i class="icon-temp"></i>','append' => '°C','maxlength'=>2)); ?>
                    </div>  
                     <div class="span4">
                          <?php echo $form->textFieldRow($model,'rate',array('class'=>'span5','prepend' => '<i class="icon-rate"></i>','append' => '/min','maxlength'=>3)); ?>
                     </div>
                     <div class="span4">
                         <?php echo $form->textFieldRow($model,'pulse',array('class'=>'span5','prepend' => '<i class="icon-pulse"></i>','append' => '/min','maxlength'=>3)); ?>
                     </div>
                 </div>    
                 
                
                 
                 <?php echo $form->labelEx($model,'bloodpressure'); ?>
            <div class="row-fluid">
                <div class="span3">  
                 <?php 
                     
                      echo $form->textFieldRow($model,'bloodPressure1',array('class'=>'span10','prepend' => '<i class="icon-tint"></i>','labelOptions' => array('label' => false),'maxlength'=>3));
                           
                      //echo $form->textFieldRow($model,'bloodPressure2',array('class'=>'span5','labelOptions' => array('label' => false),'append' => '/mmHg'));
                 ?>  
                </div>
                <div class="span1"><span class="span12"><center>/</center></span> </div>
                <div class="span4">  
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

     <div class="well">
             <ul class="nav nav-tabs">
            <li class="active"><a href="#drugT" data-toggle="tab">รายการยา</a></li>
            <li><a href="#history" data-toggle="tab">ประวัติการรับยา</a></li>
            </ul>
         
         <div class="tab-content">
           <div class="tab-pane active" id="drugT">  
            
            <div class="row-fluid">
                <div class="span2">
                    
                    <?php 
                    
                    echo "<span style='display: block;margin-bottom: 5px;'>ประเภทยา</span>"; 
                    $patient = Patient::model()->with('DrugType')->findByPk($model->HN);
                    //echo CHtml::textField('drugtypeID',$patient->DrugType->name,array('class'=>'span12','readonly'=>true));
                    echo CHtml::textField('drugtype',$patient->DrugType->name,array('class'=>'span12','readonly'=>true));
                    
                    ?>
                </div>
             
                <div class="span3">
                 <?php 
                       //echo "<span style='display: block;margin-bottom: 5px;'>รหัสยา</span>"; 
                       echo CHtml::hiddenField('drug_code','',array('class'=>'span12','readonly'=>true));
                       echo CHtml::hiddenField('drug_name','',array('class'=>'span12','readonly'=>true));
                       echo CHtml::hiddenField('drug_method','',array('class'=>'span12','readonly'=>true));
                       $typelist = CHtml::listData(Drug::model()->findAll(),'drug_id','name');
                       $drugs = Yii::app()->db->createCommand()
                               // ->select('id,drug_id,drug_name,unit, concat(drug_name,"-",unit) as name')
                               ->select('id,drug_id,drug_name,unit, concat(drug_name) as name')
                                ->from('drug')
                                ->where('drug_type_id=:id ORDER by drug_name', array(':id'=>$patient->drug_typeID))
                                ->queryAll();
                       
                       $typelist = CHtml::listData($drugs,'drug_id','name');
                       
                       echo "<span style='display: block;margin-bottom: 5px;'>ชื่อยา</span>";  
                       echo "<input type='hidden' name='drugID' id='drugID'>";
                       //echo CHtml::dropDownList('drugList',0, $typelist,array('class'=>'span12','onchange'=>'changeDrugs(this.value);','prompt'=>'---------------'));
                       /*echo CHtml::dropDownList('drugList',0, $typelist,array('class'=>'span12','onchange'=>'changeDrugs(this.value);','prompt'=>'---------------',
                     
                                    'ajax' => array(
                                            'type' => 'POST', //request type
                                            'url' => CController::createUrl('ajax/getUnit'), //url to call.                
                                            'replace' => '#unit', //selector to update   
                                            'data' => array('drug_id' => 'js:this.value')
                                    ))); */
                       
                       $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'drugList',
                            'id'=>'drugList',
                       
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Ajax/GetDrug').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        type: "'.$patient->drug_typeID.'"
                                    },
                                    success: function (data) {
                                            response(data);
                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                    'showAnim'=>'fold',
                                     'minLength'=>'0',
                                     'select'=>'js: function(event, ui) {
                                        
                                        
                                        $.ajax({
                                            url: "'.$this->createUrl('Ajax/getUnit').'",
                                            type: "POST",
                                            
                                            data: {
                                                drug_id: ui.item.value
                                            },
                                            success: function (data) {
                                                data = data.split(":");
                                                $("#unit").val(data[0]);
                                                $("#drug_code").val(data[1]);
                                                 $("#drug_name").val(ui.item.value)
                                            }
                                        
                                        })
                                        
                                           
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));

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
                <div class="span1">
                    
                    <?php 
                    
                    echo "<span style='display: block;margin-bottom: 5px;'>จำนวน</span>"; 
                    echo CHtml::textField('quantity','',array('class'=>'span12'));
                    
                    ?>
                </div>
                <div class="span1">
                    
                    <?php 
                    
                    echo "<span style='display: block;margin-bottom: 5px;'>หน่วยนับ</span>"; 
                    echo CHtml::textField('unit','',array('class'=>'span12','readonly'=>true));
                    
                    ?>
                </div>
                   <div class="span3">
                    
                    <?php 
                    
                    echo "<span style='display: block;margin-bottom: 5px;'>วิธีการใช้ยา</span>"; 
                     //echo CHtml::textField('method','',array('class'=>'span12'));
                     //$typelist = CHtml::listData(DrugMethod::model()->findAll(),'id','name');
                     
                      // echo CHtml::dropDownList('method',0, $typelist,array('class'=>'span12','prompt'=>'---------------'));
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'drugMethod',
                            'id'=>'drugMethod',
                       
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Ajax/GetDrugMethod').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term
                                    },
                                    success: function (data) {
                                            response(data);
                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                    'showAnim'=>'fold',
                                     'minLength'=>'0',
                                     'select'=>'js: function(event, ui) {
									            
                                                 $("#drug_method").val(ui.item.label)
                                        
                                     }',
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));

                    ?>
                </div>
                 <div class="span2 ">
                     <div style='display: block;margin-bottom: 5px;'>&nbsp;</div>
                  <?php   
                     $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'link',
                        'type'=>'success',
                        'label'=>'เพิ่ม',
                        'icon'=>'plus-sign',
                        'url'=>'',
                        'htmlOptions'=>array('class'=>'span7','onclick'=>'addDrug()'),
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
                  
            <table class="table table-bordered" style="background-color: white" name="tgrid" id="tgrid2" width="100%" cellpadding="0" cellspacing="0">
                        <thead >
	                    <tr>
                                <th  style="width:100px;text-align: center">รหัสยา</th>	                   
	                        <th  style="text-align: center">รายการยา</th>
                                <th  style="width:100px;text-align: center">จำนวน</th>
                                <th  style="width:100px;text-align: center">หน่วยนับ</th>
                                <th  style="text-align: center">วิธีการใช้</th>
	                        <th width="30px"></th>
	                    </tr>
	                </thead>
	                <tbody>
                            <?php
                                 //$symlist =  explode(",", $model->symptomID);
                                 
                                 //$symp_str = '';
                                 //foreach ($symlist as $key => $value) {
                                   // echo "Key: $key; Value: $value<br />\n";
                                   /* $drugs = Yii::app()->db->createCommand()
                                                ->select('drugID,quantity,method')
                                                ->from('patient_drug')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,":date"=>$model->visit_date))
                                                ->queryAll();*/
                                    
                                     // print_r($model->drugs);
                                   foreach ($model->drugs as $key => $value) {
                                       $drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,unit')
                                                ->from('drug')
                                                ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$value["drugID"],':type'=>$patient->DrugType->id))
                                                ->queryAll();
                                      echo "<tr id='".$value["drugID"]."'><td>".$value["drugID"]."</td><td>".$drug[0]["drug_name"]."</td><td style='text-align:center'>".$value["quantity"]."</td><td style='text-align:center'>".$drug[0]["unit"]."</td><td>".$value["method"]."</td><td style='text-align:center'><a href='#' onclick=deleteDrug('".$value["drugID"]."')><i class='icon-remove'></i></a></tr>";
                                   } 
                                 /*   if(!empty($symptom))
                                    {    
                                       echo "<tr id='".$model->diagID1."'><td>".$model->diagID1."</td><td>".$symptom[0]["name"]."</td><td style='text-align:center'><a href='#' onclick=deleteRow('".$model->diagID1."')><i class='icon-remove'></i></a></tr>";
                                
                                    }*/
                                    
                                   
                                 //}
                                
                                //$symp_str = substr($symp_str,0,strlen($symp_str)-1);
                                //echo '<input type="hidden" name="symptom2" id="symptom2" value="'.$symp_str.'">';
                            ?>
                            <input type="hidden" name="drug" id="drug">
                        </tbody>
                        
            </table>
           </div>
             <div class="tab-pane" id="history">
                 <table class="table table-bordered" style="background-color: white" width="100%" cellpadding="0" cellspacing="0">
                        <thead >
	                    <tr>
                                                   
	                        <th  style="text-align: center">รายการยา</th>
                                <th  style="width:100px;text-align: center">จำนวน</th>
                                <th  style="width:100px;text-align: center">หน่วยนับ</th>
                                <th  style="text-align: center">วันที่ได้รับยา</th>
	                       
	                    </tr>
	                </thead>
	                <tbody>
                 <?php
                    $pt_drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,visit_date,quantity,unit')
                                                ->from('patient_drug,drug')
                                                ->where('drugID=drug_id AND HN=:id AND drug_type_id=:type', array(':id'=>$model->HN,':type'=>$patient->DrugType->id))
                                                ->queryAll();
                    foreach ($pt_drug as $key => $value) {
                        
                         $date_str = explode("-", $value["visit_date"]);
                         $value["visit_date"] = $date_str[2]."/".$date_str[1]."/".$date_str[0];
                         echo "<tr><td>".$value["drug_name"]."</td><td style='text-align:center'>".$value["quantity"]."</td><td style='text-align:center'>".$value["unit"]."</td><td style='text-align:center'>".$value["visit_date"]."</td></tr>";
                    }
                        
                 ?>
                        </tbody>
                 </table>       
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
                    
		)); 
               echo "<span>  </span>";
               /* $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ออกใบสั่งยา',
                        
                        'url'=>array("indexDoctor"), 
		)); 
                 echo "<span>  </span>";*/
                $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'danger',
			'label'=>'ยกเลิก',
                        
                        'url'=>array("indexDoctor"), 
		)); 
                ?>
                </div>
	</div>

<?php $this->endWidget(); ?>
