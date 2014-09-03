<?php

$html = '
<html><head><style>
table { border-collapse: collapse; margin-top: 0; text-align: center; }
th {border: 1px solid black;border-collapse: collapse;}
.detail td{border-left:1px  solid black;border-right:1px solid black;height:20px}

h1 { margin-bottom: 0; }
</style></head>
<body>

<div style="text-align:right">เลขที่ใบเสร็จ  '.$model->bill_No.'</div>

<table>
<tr>
<td width="60%"></td><td><img style="display: block;margin: 0 auto;vertical-align: middle;" src="images/garuda.png" width="80" /></td><td width="60%"></td>
</tr>
<tr>
<td width="60%"></td><td><h2>ใบเสร็จรับเงิน</h2></td><td width="60%"></td>
</tr>

</table>
<table>
<tr>
<td><img style="display: block;margin: 0 auto;vertical-align: middle;" src="dist/img/logo.png" width="100" /></td>
<td style="text-align:left;"><p style="margin-top: 0em;margin-bottom: 20em;">ในราชการ (กรมหรือหน่วย) โรงเรียนช่างฝีมือทหาร สถาบันวิชาการป้องกันประเทศ<br><br>
     ที่ทำการกองพยาบาล 3/1 ซอยพหลโยธิน 30 ถนนพหลโยธิน แขวงจันทรเกษม เขตจตุจักร กทม.10900</p>
</td>
</tr>

</table>
';

require_once('class_thaidate.php'); 
    //$date->setTimezone(new DateTimeZone('Asia/Bangkok'));
    $date = new Thaidate(date('Y-m-d : H:i:s'), 'F3');
$html .= "<div style='text-align:right;padding-right:150px'>".$date->getDateTime()."</div><br>";

  $patient = Patient::model()->findByPk($model->HN);
$html .= "<table><tr><td>ได้รับ  <input type='checkbox'>เงินสด     <input type='checkbox' >เช็คเลขที่________________________</td><td><input type='checkbox'>ใบสำคัญ_______________________ฉบับ</td></tr></table>";
$html .= "<br><table><tr><td>จาก   <i>".$patient->title."".$patient->firstname."  ".$patient->lastname."</i>_________________</td><td>HN  :".$model->HN."</td></tr></table>";
$html .="<br><div>ตามรายการดังต่อไปนี้</div>";

$html .= "<table>
          <thead >
           <tr><th width='50px'>ลำดับ</th><th width='50%'>รายการ</th><th width='100px'>จำนวน</th><th width='100px'>ราคาต่อหน่วย</th><th width='150px'>จำนวนเงิน (บาท)</th></tr>
          </thead>";
$drugs = Yii::app()->db->createCommand()
                                                ->select('drugID,quantity')
                                                ->from('patient_drug')
                                                ->where('HN=:id AND visit_date=:date', array(':id'=>$model->HN,':date'=>$model->visit_date))
                                                ->queryAll();
                        
                                     // print_r($model->drugs);
                                $sumPrice = 0;
                                $id = 1;
                                   foreach ($drugs as $key => $value) {
                                       $drug = Yii::app()->db->createCommand()
                                                ->select('drug_name,unit,price')
                                                ->from('drug')
                                                ->where('drug_id=:id AND drug_type_id=:type', array(':id'=>$value["drugID"],':type'=>$patient->DrugType->id))
                                                ->queryAll();
                                       
                                       $sumPrice += ($drug[0]["price"]*$value["quantity"]);
$html.= "<tr class='detail'><td>".$id++."</td><td style='text-align:left'>".$drug[0]["drug_name"]."</td><td style='text-align:center'>".$value["quantity"]." ".$drug[0]["unit"]."</td><td style='text-align:right'>".$drug[0]["price"]."</td><td style='text-align:right'>".number_format($drug[0]["price"]*$value["quantity"],0,".",",")."</td></tr>";
                                   
                                        
                                   }
while($id<10){
   $html.= "<tr class='detail'>__<td></td><td style='text-align:left'></td><td style='text-align:center'></td><td style='text-align:right'></td><td style='text-align:right'></td></tr>";
   $id++;     
}                                   
$html.="<tr><td colspan='2' style='border-top:1px solid black;'></td><td colspan='2' style='text-align:center;border:1px solid black'><b>รวมเงิน</b></td><td style='border:1px solid black;'><b>".number_format($sumPrice,0,".",",")."</b></td></tr>";                                   
$html .= "</table>";

$str = strval($sumPrice);
//$str = "1219";
$k = strlen($str);

$priceStr = '';
for ($i=0;$i<strlen($str);$i++) {
    //echo $str[$i]."<br>";
    $n='';
    $b='';
    switch (intval($str[$i])){
        case 1: $n="หนึ่ง"; break;
        case 2: $n="สอง"; break;
        case 3: $n="สาม"; break;
        case 4: $n="สี่"; break;
        case 5: $n="ห้า"; break;
        case 6: $n="หก"; break;
        case 7: $n="เจ็ด"; break;
        case 8: $n="แปด"; break;
        case 9: $n="เก้า"; break;
    }
   if(intval($str[$i])!=0) 
    switch ($k){
        
        case 2: $b="สิบ"; break;
        case 3: $b="ร้อย"; break;
        case 4: $b="พัน"; break;
        case 5: $b="หมื่น"; break;
        case 6: $b="แสน"; break;
        case 7: $b="ล้าน"; break;
        
    }
    if($k==2 && intval($str[$i])==2)
        $n = "ยี่";
    if($k==2 && intval($str[$i])==1)
        $n = "";
    
    $priceStr .=$n.$b;
    $k--;
}
//echo $priceStr;
$html .="<br><div>จำนวนเงิน (ตัวอักษร) <i>".$priceStr."</i> บาทถ้วน</div>";

$html .="<br><br><div style='text-align:left;padding-left:320px'>ลายมือชื่อ</div>";
$html .="<br><div style='text-align:center;padding-left:300px;'>(................".Yii::app()->user->title.Yii::app()->user->firstname."   ".Yii::app()->user->lastname."..............)</div>";
$html .="<br><div style='text-align:center;padding-left:320px;'>ผู้รับเงิน</div>";
$html .="<br><div style='text-align:left;padding-left:320px'>ตำแหน่ง ...........เจ้าหน้าที่การเงิน กพบ.รร.ชท.สปท. ...........</div>";
$html .="</html>";
//==============================================================
//==============================================================
//==============================================================
include("/../MPDF56/mpdf.php");

//echo $html;
$mpdf = new mPDF('UTF-8','A4');
//$mpdf = new mPDF('th', 'A4-L', '0', '',10, 5, 40, 20,0,0,"L");
$mpdf->SetAutoFont();

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================



?>
