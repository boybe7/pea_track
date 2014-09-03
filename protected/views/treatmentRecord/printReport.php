<?php
$html = '<html><head><style>
table { border-collapse: collapse; margin-top: 0; text-align: center; }
th {border: 1px solid black;border-collapse: collapse;}
.detail td{border-left:1px  solid black;border-right:1px solid black;height:20px}

h1 { margin-bottom: 0; }

body,table {text-align: center; }
td{height:40px}
</style></head>
<body><center><h1>รายงานจำนวนผู้เข้ารับบริการ</h1></center>';
                $str_date = explode("/", $_GET["date1"]);
                $date1= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                $year1 = $str_date[2];
                $m1 = $str_date[1];
                $str_date = explode("/", $_GET["date2"]);
                $year2 = $str_date[2];
                $m2 = $str_date[1];
                $date2= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                
$html .= '<center><div><h4>ตั้งแต่วันที่ '.$_GET["date1"].'   ถึงวันที่  '.$_GET["date2"].'</h4></div></center>';                
$html .= '<center><table border=1 width=100%><tr><td rowspan=2>ปี พ.ศ.</td><td rowspan=2>เดือน</td><td colspan=2>จำนวนผู้เข้ารับบริการ (คน)</td></tr>';
$html .= '<tr><td>รายรับสถานพยาบาล</td><td>ยางบประมาณ</td></tr>';
                 

                for($y=$year1;$y<=$year2;$y++)
                {
                    
                       $data = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year AND drug_typeID="F"', array(
                                            ":year"=>$y,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                       
                       $data2 = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                             ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year AND drug_typeID="P"', array(
                                            ":year"=>$y,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                 
                }
                
                       $mEnd = 12;
                       if($year1==$year2)
                           $mEnd = $m2;
                       $y =  $year1;
                       
                       $year_str = $year1;
                       $sum1 = 0;
                       $sum2 = 0;
                       for($i=$m1;$i<=$mEnd && $y<=$year2;$i++)
                       {
                               
                            $dataM = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year  AND drug_typeID="F" AND month(visit_date)=:month', array(
                                            ":year"=>$y,":month"=>$i,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                            
                            $dataM2 = Yii::app()->db->createCommand()
                                        ->select('count(id) as num')
                                        ->from('treatment_record,patient')
                                        ->where('treatment_record.HN=patient.HN AND (visit_date BETWEEN :date1 AND :date2) AND year(visit_date)=:year  AND drug_typeID="P" AND month(visit_date)=:month', array(
                                            ":year"=>$y,":month"=>$i,":date1"=>$date1,
                                            ":date2"=>$date2))
                                        ->queryAll();
                            $month = "";
                            switch ($i){
                                    case 1:$month="มกราคม";break;
                                    case 2:$month="กุมภาพันธ์";break;
                                    case 3:$month="มีนาคม";break;
                                    case 4:$month="เมษายน";break;
                                    case 5:$month="พฤษภาคม";break;
                                    case 6:$month="มิถุนายน";break;
                                    case 7:$month="กรกฎาคม";break;
                                    case 8:$month="สิงหาคม";break;
                                    case 9:$month="กันยายน";break;
                                    case 10:$month="ตุลาคม";break;
                                    case 11:$month="พฤศจิกายน";break;
                                    case 12:$month="ธันวาคม";break;
                            } 
                            
                           $sum1 += intval($dataM[0]["num"]);
                           $sum2 += intval($dataM2[0]["num"]); 
                          
                          $html .= '<tr><td>'.$year_str.'</td><td>'.$month.'</td><td>'.$dataM[0]["num"].'</td><td>'.$dataM2[0]["num"].'</td></tr>';
                           //$recordM[] = array("name"=>$month." ".$y,"free"=>$dataM[0]["num"],"cost"=>$dataM2[0]["num"]);
                          $year_str = '';
                           if($i==12)
                           {   
                               $i=0;
                               $y++;
                               $year_str = $y;
                               $mEnd = $m2;
                                $html .= '<tr><td colspan=2>รวม</td><td>'.$sum1.'</td><td>'.$sum2.'</td></tr>';
                           
                                
                                 $sum1 = 0;
                                 $sum2 = 0;
                           }
                       }
                       
                        $html .= '<tr><td colspan=2>รวม</td><td>'.$sum1.'</td><td>'.$sum2.'</td></tr>'; 

$html .= '</table></center>';   
$html .= '<center><div><h3>รวมจำนวนผู้เข้ารับบริการทั้งหมด '.($sum1+$sum2).' คน</h3></div></center>';     
$html .="</body></html>";
//==============================================================
//==============================================================
//==============================================================
include("/../MPDF56/mpdf.php");

//echo $html;
$mpdf = new mPDF('UTF-8','A4');
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
