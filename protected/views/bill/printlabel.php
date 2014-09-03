<?php

//==============================================================
//==============================================================
//==============================================================
include("/../MPDF56/mpdf.php");

//echo $html;
$mpdf = new mPDF('UTF-8','A7-L',10,10,10,10,10,10);
$mpdf->SetAutoFont();

$html = '
<html><head><style>
table { border-collapse: collapse; margin-top: 0; text-align: center; }
th {border: 1px solid black;border-collapse: collapse;}
.detail td{border-left:1px  solid black;border-right:1px solid black;height:20px}

h1 { margin-bottom: 0; }
</style></head>
<body>
<h2>กองพยาบาล โรงเรียนช่างฝีมือทหาร</h2>';

  $patient = Patient::model()->findByPk($model->HN);
$drugtype = DrugType::model()->findByPk($patient->drug_typeID);


$html .= "<center><table width='100%'><tr><td style='text-align:center'><b>".$drugtype->name."</b></td></tr></table></center>";

$str_date = explode("-", $model->visit_date);
$date1= $str_date[2]."/".$str_date[1]."/".$str_date[0];
$html .='
<table>

<tr>
<td width="50%" style="text-align:left;padding-right:100px">HN : '.$model->HN.'</td><td width="50%" style="text-align:right;">'.$date1.'</td>
</tr>
</table>

';


$html .= "<br><table><tr><td>".$patient->title."".$patient->firstname."  ".$patient->lastname."</td></tr></table>";

$drugs = Yii::app()->db->createCommand()
                                                ->select('drugID,quantity,method')
                                                ->from('patient_drug')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,':date'=>$model->visit_date))
                                                ->queryAll();
                                       $drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,unit')
                                                ->from('drug')
                                                ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$drugs[0]["drugID"],':type'=>$patient->DrugType->id))
                                                ->queryAll();
$html .="<br><div>".$drug[0]["drug_name"]."         ".$drugs[0]["quantity"]."  ".$drug[0]["unit"]."</div>"; 

$html .="<br><div>".$drugs[0]["method"]."</div>";                                       
                                   
$html .="</html>";

$mpdf->WriteHTML($html);

$id = 0;
$htmlA = array();
foreach ($drugs as $key => $value) {
  if($id!=0){
    $drug = Yii::app()->db->createCommand()
                          ->select('drug_name,unit')
                          ->from('drug')
                          ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$value["drugID"],':type'=>$patient->DrugType->id))
                          ->queryAll();
  
    
    $htmlA[$id] = '
    <html>
    <body>
    <h2>กองพยาบาล โรงเรียนช่างฝีมือทหาร</h2>
    
    ';
    
    
    $htmlA[$id] .= "<center><table width='100%'><tr><td style='text-align:center'><b>".$drugtype->name."</b></td></tr></table></center>";
    $str_date = explode("-", $model->visit_date);
    $date1= $str_date[2]."/".$str_date[1]."/".$str_date[0];


    $htmlA[$id] .='<table>

    <tr>
    <td width="50%" style="text-align:left;padding-right:100px">HN : '.$model->HN.'</td><td width="50%" style="text-align:right;">'.$date1.'</td>
    </tr>
    </table>';
    $patient = Patient::model()->findByPk($model->HN);
    $htmlA[$id] .= "<br><table><tr><td>".$patient->title."".$patient->firstname."  ".$patient->lastname."</td></tr></table>";

                                       $drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,unit')
                                                ->from('drug')
                                                ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$value["drugID"],':type'=>$patient->DrugType->id))
                                                ->queryAll();
    $htmlA[$id] .="<br><div>".$drug[0]["drug_name"]."         ".$value["quantity"]."  ".$drug[0]["unit"]."</div>"; 

    $htmlA[$id] .="<br><div>".$value["method"]."</div>";                                       
    $htmlA[$id] .="</html>";
    $mpdf->AddPage('A7-L',10,10,10,10,10,10);
    $mpdf->WriteHTML($htmlA[$id]);
  } 
  $id++;
 }                                        




$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================



?>
