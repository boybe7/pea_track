
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
    else
    	$d = $dates[0];

    $renderDate = $d." ".$th_month[$mi]." ".$yi;
    if($renderDate==0)
        $renderDate = "";   

    return $renderDate;             
}

function renderDate2($value)
{
    $th_month = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $dates = explode("-", $value);
    $d=0;
    $mi = 0;
    $yi = 0;
    foreach ($dates as $key => $value) {
         $d++;
         if($d==2)
            $mi = $value;
         if($d==1)
            $yi = $value;
    }
    if(substr($mi, 0,1)==0)
        $mi = substr($mi, 1);
    if(substr($dates[2], 0,1)==0)
        $d = substr($dates[2], 1);
    else
    	$d = $dates[2];

    $renderDate = $d." ".$th_month[$mi]." ".$yi;
    if($renderDate==0)
        $renderDate = "";   

    return $renderDate;             
}

$pj = $model;
$month_th = array("1" => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม","4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน","7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน","10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");

if($monthBegin==$monthEnd && $yearBegin==$yearEnd)
    $monthBetween = $month_th[$monthBegin]." ".$yearBegin;
else if($yearBegin==$yearEnd)
	$monthBetween = $month_th[$monthBegin]."-".$month_th[$monthEnd]." ".$yearEnd;
else
    $monthBetween = $month_th[$monthBegin]." ".$yearBegin."-".$month_th[$monthEnd]." ".$yearEnd;

$number = cal_days_in_month(CAL_GREGORIAN, $monthEnd, $yearEnd-543);
$monthBegin2 = $monthBegin<10 ? "0".$monthBegin : $monthBegin;
$monthEnd2 = $monthEnd<10 ? "0".$monthEnd : $monthEnd;
$dayBegin = $yearBegin."-".$monthBegin2."-"."01";

$number = $number<10 ? "0".$number : $number;
$dayEnd = $yearEnd."-".$monthEnd2."-".$number;
$monthCondition = " BETWEEN '".$dayBegin."' AND '".$dayEnd."'";

//echo $monthCondition;

$maxPayment = 6;
$sumPayPCAll = 0;
$sumPayOCAll = 0;
foreach ($model as $key => $pj) {
		
	
	echo "<center><div class='header'><b>สรุปรายได้/ค่าใช้จ่าย <br>".$pj->pj_name."<br>ประจำเดือน ".$monthBetween."</b></div></center>";
	
	echo "<table border='1' class='span12' style='margin-left:0px;margin-bottom:20px;'>";
		echo "<tr style='background-color:#F5C27F'>";
		 echo "<td style='text-align:center;width:15%'>วดป.<br>ใบเสร็จรับเงิน</td>";
		 echo "<td style='text-align:center;width:20%'>รายการ</td>";
		 echo "<td style='text-align:center;width:20%'>จำนวนเงิน</td>";
		 echo "<td style='text-align:center;width:15%'>วดป.<br>อนุมัติรับเงิน</td>";
		 echo "<td style='text-align:center;width:20%'>รายการ</td>";
		 echo "<td style='text-align:center;width:20%'>รายจ่าย</td>";
		echo "</tr>";

						//project contract
	    				$Criteria = new CDbCriteria();
	                     $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	                	 $pcs = ProjectContract::model()->findAll($Criteria);
                         $nPC = count($pcs);

                         //2.outsource contract
                         $Criteria = new CDbCriteria();
                         $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                         $ocs = OutsourceContract::model()->findAll($Criteria);
                         $nOC = count($ocs);
                         $maxContract = $nPC < $nOC ? $nOC : $nPC ;
                         $pj_rowspan = $maxContract * $maxPayment;

                         //management
                         $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type!=0 AND mc_date ".$monthCondition)
                                            ->queryAll();
                        $m_sum = $pp[0]["sum"];
                        //echo $m_sum;   

        $iPC = 0;
        $iOC = 0;
        
        $iPayOC = 0;
        $iPayPC = 0;
        //echo count($pcs);
        for ($i=0; $i < $pj_rowspan; $i++) 
        { 
        	echo '<tr>';
			
        	//draw PC
        	if(!empty($pcs[$iPC]))
        	{
        		$pc = $pcs[$iPC];
        		
        		$vendor = Vendor::model()->findByPk($pc->pc_vendor_id);
        		//print_r($vendor);
        		//echo "<br>";
				if($i%$maxPayment==0)
	        	{
	        		$sumPayPC = 0;	
	        		$iPC++;
	        		if($nPC==1)
						echo '<td>วงเงินสัญญา'.$iPC.'</td><td></td>';
					else if(!empty($vendor))
						echo '<td colspan="2">'.$vendor->v_name.'</td>';
					$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
                    $costPC = $pp[0]["sum"] + $pc->pc_cost;                        
					echo '<td align="right">'.number_format($costPC,2).'</td>';

					$Criteria = new CDbCriteria();
                	$Criteria->condition = "proj_id='$pc->pc_id' AND bill_date!='' AND bill_date ".$monthCondition;
                	$payment = PaymentProjectContract::model()->findAll($Criteria);

                	$iPayPC = 0;
	        	}
	        	else{

		        		//draw payment
		        	if(!empty($payment[$iPayPC]))
		        	{

		        		echo '<td align="center">'.renderDate($payment[$iPayPC]->bill_date).'</td>';
		        		echo '<td >'.$payment[$iPayPC]->detail.'</td>';
		        		$money = str_replace(",", "", $payment[$iPayPC]->money);
		        		$sumPayPC += $money;
		        		echo '<td align="right">'.number_format($money,2).'</td>';
		        		 $iPayPC++;
		        	}
	                else{
		        		
	                	if($i%$maxPayment==$maxPayment-1 && $i<=$iPC*$maxPayment)
		        		{	
		        			echo '<td>&nbsp;</td><td align="center" style="color:red"><u>คงเหลือค้างรับ</u></td>';
		        		    ///echo '<td align="right" style="color:red"><u>'.$costPC.'</u></td>';
		        		
		        		    $rm = $costPC-$sumPayPC==0 ? "-": number_format($costPC-$sumPayPC,2);
		        		    $sumPayPCAll += $sumPayPC;
		        		    echo '<td align="right" style="color:red"><u>'.$rm.'</u></td>';
		        		}
		        		else
		        		     echo '<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td>';	
		        		
		
		        	}
	        	}
               
        	}
        	else
        	{
	        			//draw payment
		        	if(!empty($payment[$iPayPC]))
		        	{

		        		echo '<td align="center">'.renderDate($payment[$iPayPC]->bill_date).'</td>';
		        		echo '<td >'.$payment[$iPayPC]->detail.'</td>';
		        		$money = str_replace(",", "", $payment[$iPayPC]->money);
		        		$sumPayPC += $money;
		        		echo '<td align="right">'.number_format($money,2).'</td>';
		        		$iPayPC++;
		        	}
		        	else{
		        		
		        		if($i%$maxPayment==$maxPayment-1 && $i<=$iPC*$maxPayment)
		        		{	
		        			echo '<td>&nbsp;</td><td align="center" style="color:red"><u>คงเหลือค้างรับ</u></td>';
		        		    //echo '<td align="right" style="color:red"><u>'.$costPC.'</u></td>';
		        			$rm = $costPC-$sumPayPC==0 ? "-": number_format($costPC-$sumPayPC,2);
		        			$sumPayPCAll += $sumPayPC;
		        		    echo '<td align="right" style="color:red"><u>'.$rm.'</u></td>';
		        		}
		        		else	
		        		   echo '<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>';
		        	}
	                
	        }



        	//draw OC
			if(!empty($ocs[$iOC]))
        	{
        		$oc = $ocs[$iOC];
        		$vendor = Vendor::model()->findByPk($oc->oc_vendor_id);


				if($i%$maxPayment==0)
	        	{
	        		$iOC++;
	        		$sumPayOC = 0;
					echo '<td colspan="2">&nbsp;'.$vendor->v_name.'</td>';
					$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll();
                    $costOC = $pp[0]["sum"] + str_replace(",", "", $oc->oc_cost);                        
					echo '<td align="right">'.number_format($costOC,2).'</td>';

					$Criteria = new CDbCriteria();
                	$Criteria->condition = "contract_id='$oc->oc_id' AND approve_date!='' AND approve_date ".$monthCondition;
                	$paymentOC = PaymentOutsourceContract::model()->findAll($Criteria);
                	//echo(count($paymentOC));
                	$iPayOC = 0;
	        	}
	        	else{

		        		//draw payment
		        	if(!empty($paymentOC[$iPayOC]))
		        	{

		        		echo '<td align="center">'.renderDate($paymentOC[$iPayOC]->approve_date).'</td>';
		        		echo '<td >'.$paymentOC[$iPayOC]->detail.'</td>';
		        		$money = str_replace(",", "", $paymentOC[$iPayOC]->money);
		        		$sumPayOC += $money;
		        		echo '<td align="right">'.number_format($money,2).'</td>';
		        		$iPayOC++;
		        	}
		        	else{
		        		if($i%$maxPayment==$maxPayment-1 && $i<=$iOC*$maxPayment)
		        		{	
		        			echo '<td>&nbsp;</td><td align="center" style="color:red"><u>ค้างจ่าย</u></td>';
		        		    //echo '<td align="right" style="color:red"><u>'.$costPC.'</u></td>';
		        			$rm = $costOC-$sumPayOC==0 ? "-": number_format($costOC-$sumPayOC,2);
		        			$sumPayOCAll += $sumPayOC;
		        		    echo '<td align="right" style="color:red"><u>'.$rm.'</u></td>';
		        		}
		        		else	
		        		   echo '<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>';	
		        		
		
		        	}
	                
	        	}
		    
        	}
        	else{
        			if(!empty($paymentOC[$iPayOC]))
		        	{

		        		echo '<td align="center">'.renderDate($paymentOC[$iPayOC]->approve_date).'</td>';
		        		echo '<td >'.$paymentOC[$iPayOC]->detail.'</td>';
		        		$money = str_replace(",", "", $paymentOC[$iPayOC]->money);
		        		$sumPayOC += $money;
		        		echo '<td align="right">'.number_format($money,2).'</td>';
		        		$iPayOC++;
		        	}
		        	else{
		        		if($i%$maxPayment==$maxPayment-1 && $i<=$iOC*$maxPayment)
		        		{	
		        			echo '<td>&nbsp;</td><td align="center" style="color:red"><u>ค้างจ่าย</u></td>';
		        		    //echo '<td align="right" style="color:red"><u>'.$costPC.'</u></td>';
		        			$rm = $costOC-$sumPayOC==0 ? "-": number_format($costOC-$sumPayOC,2);
		        			$sumPayOCAll += $sumPayOC;
		        		    echo '<td align="right" style="color:red"><u>'.$rm.'</u></td>';
		        		}
		        		else	
		        		   echo '<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>';
		        	}
	                
				
			    	
        	}        	
        		
			echo '</tr>';
	                 	
        }                 
        //summary project
        echo '<tr style="background-color:#D7A8F7">';
        	echo '<td colspan="2">รวมรายรับ ณ เดือน '.$month_th[$monthEnd].' '.$yearEnd.'</td>';
         	echo '<td align="right">'.number_format($sumPayPCAll,2).'</td>';
         	echo '<td colspan="2">รวมรายจ่าย ณ เดือน '.$month_th[$monthEnd].' '.$yearEnd.'</td>';
         	echo '<td align="right">'.number_format($sumPayOCAll,2).'</td>';
        echo '</tr>';
         echo '<tr style="background-color:#D7A8F7">';
        	echo '<td>&nbsp;</td>';echo '<td>&nbsp;</td>';echo '<td>&nbsp;</td>';
         	
         	echo '<td colspan="2">ค่าบริหารโครงการ เดือน '.$month_th[$monthEnd].' '.$yearEnd.'</td>';
         	echo '<td align="right">'.number_format($m_sum,2).'</td>';
        echo '</tr>';
         echo '<tr style="background-color:#D7A8F7">';
        	echo '<td>&nbsp;</td>';echo '<td>&nbsp;</td>';echo '<td>&nbsp;</td>';
         	echo '<td colspan="2"><b>กำไร/ขาดทุน</b></td>';
         	echo '<td align="right"><b>'.number_format($sumPayPCAll-$sumPayOCAll-$m_sum,2).'<b></td>';
        echo '</tr>';
	echo "</table>";
}

			
?>