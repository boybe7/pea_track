<?php
$this->breadcrumbs=array(
	'Progress Report ',
	
);


?>

<style>

.reportTable thead th {
	text-align: center;
	font-weight: bold;
	background-color: #eeeeee;
	vertical-align: middle;
	}

.reportTable td {
	
}

<?php
function renderDate($value)
{
    $th_month = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $dates = explode("/", $value);
    $d=0;
    $mi = 0;
    $yi = 0;
    foreach ($dates as $key => $value) {
         $d++;
         if($d==2)
            $mi = $value;
         if($d==3)
            $yi = $value;
    }
    if(substr($mi, 0,1)==0)
        $mi = substr($mi, 1);
    if(substr($dates[0], 0,1)==0)
        $d = substr($dates[0], 1);


    $renderDate = $d." ".$th_month[$mi]." ".substr($yi,2);
    if($renderDate==0)
        $renderDate = "";   

    return $renderDate;             
}
?>

</style>

        <table class="table table-bordered reportTable">
        
            <thead>
              <tr> 
                <th rowspan="2">ลำดับ</th>
                <th rowspan="2">โครงการ</th>
                <th rowspan="2">รายละเอียดงาน</th>
                <th rowspan="2">เลขที่สัญญา</th>
                <th rowspan="2">วันที่ลงนามสัญญา</th>
                <th colspan="8">รายรับ</th>
                <th rowspan="2">ชื่อบริษัทจ้างช่วง</th>
                <th rowspan="2">รายละเอียดงาน</th>
                <th rowspan="2">เลขที่สัญญา</th>
                <th rowspan="2">วันที่ลงนามสัญญา</th>
                <th rowspan="2">วันที่ครบกำหนด</th>
                <th rowspan="2">วันที่รับรองงบ</th>
                <th colspan="7">วงเงินช่วง</th>
                <th colspan="3">ค่าบริหารโครงการ</th>
                <th rowspan="2">วงเงินที่คาดว่าจะได้รับ</th>
              </tr>
              <tr>
              	<th>วงเงินตามสัญญา</th>
                <th>รายการ</th>
                <th>ได้รับเงิน</th>
                <th>คงเหลือเรียกเก็บเงิน</th>
                <th>เลขที่ใบแจ้งหนี้</th>
                <th>เลขที่ใบเสร็จรับเงิน</th>
                <th>T%</th>
                <th>A%</th>

                <th>ตามสัญญา</th>
                <th>รายการ</th>
                <th>จ่ายเงิน</th>
                <th>อนุมัติจ่าย</th>
                <th>คงเหลือจ่ายเงิน</th>
                <th>T%</th>
                <th>B%</th>

				<th>ประมาณการ</th>
                <th>ค่ารับรอง</th>
                <th>ใช้จริง</th>

              </tr>  
            </thead>
            <tbody>
                <tr style="line-height: 0px">
                    <td style="padding-top:0px;padding-bottom:0px;"></td>
                    <!-- Project-->
                    <td style="padding-left:150px;padding-right:150px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:150px;padding-right:150px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:60px;padding-right:60px;padding-top:0px;padding-bottom:0px;"></td>
					<!-- Project Contract-->                    
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:5px;padding-right:5px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:5px;padding-right:5px;padding-top:0px;padding-bottom:0px;"></td>

					<!-- Outsource Contract-->
                    <td style="padding-left:150px;padding-right:150px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:150px;padding-right:150px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:60px;padding-right:60px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:60px;padding-right:60px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:5px;padding-right:5px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:5px;padding-right:5px;padding-top:0px;padding-bottom:0px;"></td>

                    <!-- Management Cost-->
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    <td style="padding-left:50px;padding-right:50px;padding-top:0px;padding-bottom:0px;"></td>
                    

                    <td style="padding-left:80px;padding-right:80px;padding-top:0px;padding-bottom:0px;"></td>
                    
                </tr>
                <?php
                //fiscalyear
                $fiscalyear = array();
                foreach ($model as $key => $value) {
                	if(!in_array($value->pj_fiscalyear."/".$value->pj_work_cat, $fiscalyear))
                	   $fiscalyear[] = $value->pj_fiscalyear."/".$value->pj_work_cat;
                

                }

                //print_r($model);

                asort($fiscalyear);
                foreach ($fiscalyear as $key => $value) {
                	$data = explode("/", $value);
                	$year = $data[0];
                	$cat = $data[1];

                	$mWorkCat = WorkCategory::model()->findByPk($cat);

                	//echo $mWorkCat->wc_name;
                	echo "<tr>";
                	for ($i=0; $i < 30; $i++) { 
                		if($i==1)
                			echo "<td style='background-color:#EBF8A4'>ปี ".$year." ".$mWorkCat->wc_name."</td>";
                		else
                		    echo "<td style='background-color:#EBF8A4'></td>";			
                	}
                	echo "</tr>";
                	
                	//echo $year.":".$cat;
                	$index = 1;
                	foreach ($model as $key => $pj) {
                	  if($pj->pj_fiscalyear==$year && $pj->pj_work_cat==$cat)
                	  {	
                		
                	  	
                		 //1.project contract
	                	 $Criteria = new CDbCriteria();
	                     $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	                	 $pcs = ProjectContract::model()->findAll($Criteria);

                         $nPC = count($pcs);
                         $sumPC_numPay = 0;
                         foreach ($pcs as $key => $pc) {
                            $sumPC_numPay += $pc->pc_num_payment;
                         }

                         $tr_pc = $sumPC_numPay + ($nPC - 1);
                        
                         //2.outsource contract
                         $Criteria = new CDbCriteria();
                         $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                         $ocs = OutsourceContract::model()->findAll($Criteria);

                         $nOC = count($ocs);
                         $sumOC_numPay = 0;
                         foreach ($ocs as $key => $oc) {
                            $sumOC_numPay += $oc->oc_num_payment;
                         }

                         $tr_oc = $sumOC_numPay;// + ($nOC - 1);

                         //3.rowspan of project
                         $tr_project = $tr_pc < $tr_oc ? $tr_oc:$tr_pc ;


                         //draw table
                         //project data
                         $pcid;

                         for ($i=0; $i <$tr_project ; $i++) { 
                            echo "<tr>";
                                //project
                                if($i==0)
                                {
                                    echo "<td rowspan='$tr_project'>".$index."</td>";
                                    echo "<td rowspan='$tr_project'>".$pj->pj_name."<br>";
                                    //workcode
                                    $Criteria = new CDbCriteria();
                                    $Criteria->condition = "pj_id='$pj->pj_id'";
                                    $workcodes = WorkCode::model()->findAll($Criteria);
                                    foreach ($workcodes as $key => $wc) {
                                        echo $wc->code."<br>";
                                    }

                                    echo "</td>";
                                }

                                //pc
                                if(!empty($pcs[$i]))
                                {
                                    $rowspan = $pcs[$i]->pc_num_payment;
                                    
                                    $pcid = $pcs[$i]->pc_id;
                                    echo $rowspan."/";
                                    echo "<td rowspan='$rowspan'>".$pcs[$i]->pc_details."<br><br>";
                                    if(!empty($pcs[$i]->pc_guarantee))
                                        echo "-หนังสือค้ำประกัน ".$pcs[$i]->pc_guarantee."<br>";
                                    if(!empty($pcs[$i]->pc_garantee_end))
                                        echo "-เลขที่บันทึกส่งกองการเงิน ".$pcs[$i]->pc_garantee_end."<br>";
                                    if(!empty($pcs[$i]->pc_PO))
                                    {
                                        $pcs[$i]->pc_PO = str_replace("PO", "", $pcs[$i]->pc_PO);
                                        echo "-PO ".$pcs[$i]->pc_PO."<br>";
                                    }   
                                    echo "</td>";

                                    $pc = $pcs[$i];

                                    echo "<td style='text-align:center' rowspan='$rowspan'>".$pc->pc_code."</td>";                               
                                    echo "<td style='text-align:center' rowspan='$rowspan'>".renderDate($pc->pc_sign_date)."<br><br>";
                                    echo "<u>ครบกำหนด</u><br>";
                                    echo renderDate($pc->pc_end_date);
                                    echo "</td>";

                                    echo "<td style='text-align:right' rowspan='$rowspan'>".number_format($pc->pc_cost,2)."</td>";



                                }   


                                 //project payment
                                    $Criteria = new CDbCriteria();
                                    $Criteria->condition = "proj_id='$pcid'";
                                    $paymentProjs = PaymentProjectContract::model()->findAll($Criteria);

                                    if(!empty($paymentProjs[$i]))
                                    {
                                        $pay = $paymentProjs[$i];
                                        echo "<td>".$pay->detail."</td>";
                                        echo "<td style='text-align:right'>".$pay->money."</td>";
                                        $pc = ProjectContract::model()->findByPk($pcid);

                                        //find pay before
                                        $str_date = explode("/", $pay->invoice_date);
                                        $invoice_date= "";
                                        if(count($str_date)>1)
                                            $invoice_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_project_contract')
                                            ->where('invoice_date < "'.$invoice_date.'" AND proj_id='.$pcid)
                                            ->queryAll();
                                            
                                        //print_r($pay->invoice_date);    
                                        $pay->money = str_replace(",", "", $pay->money);
                                        echo "<td style='text-align:right'>".number_format($pc->pc_cost - $pay->money - $pp[0]["sum"],2)."</td>";
                                        echo "<td>".$pay->invoice_no." ".renderDate($pay->invoice_date)."</td>";
                                        echo "<td>".$pay->bill_no." ".renderDate($pay->bill_date)."</td>";

                                        //T & A percent
                                        if($i==0)
                                        {
                                            echo "<td style='text-align:center'>".$pc->pc_T_percent."</td>";
                                            echo "<td style='text-align:center'>".$pc->pc_A_percent."</td>";     

                                        } 
                                        else{
                                            echo "<td></td><td></td>";
                                        }   
                                       
                                    }  


                               //oc
                                if(!empty($ocs[$i]))
                                {
                                    $rowspan = $ocs[$i]->oc_num_payment;
                                    
                                    $ocid = $ocs[$i]->oc_id;
                                    echo $rowspan."/";
                                    echo "<td rowspan='$rowspan'>".$ocs[$i]->oc_details."<br><br>";
                                    if(!empty($ocs[$i]->oc_guarantee))
                                        echo "-หนังสือค้ำประกัน ".$ocs[$i]->pc_guarantee."<br>";
                                    if(!empty($ocs[$i]->pc_garantee_end))
                                        echo "-เลขที่บันทึกส่งกองการเงิน ".$ocs[$i]->pc_garantee_end."<br>";
                                    if(!empty($ocs[$i]->pc_PO))
                                    {
                                        $pcs[$i]->pc_PO = str_replace("PO", "", $pcs[$i]->pc_PO);
                                        echo "-PO ".$pcs[$i]->pc_PO."<br>";
                                    }   
                                    echo "</td>";

                                    $pc = $pcs[$i];

                                    echo "<td style='text-align:center' rowspan='$rowspan'>".$pc->pc_code."</td>";                               
                                    echo "<td style='text-align:center' rowspan='$rowspan'>".renderDate($pc->pc_sign_date)."<br><br>";
                                    echo "<u>ครบกำหนด</u><br>";
                                    echo renderDate($pc->pc_end_date);
                                    echo "</td>";

                                    echo "<td style='text-align:right' rowspan='$rowspan'>".number_format($pc->pc_cost,2)."</td>";



                                }   
                          

                            echo"</tr>";
                         }
                         


                		$index++;
                	  } 	
                	
                    }
                }
                //workcat	


                ?>
            </tbody>
        </table>
