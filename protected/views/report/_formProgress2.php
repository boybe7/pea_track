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

	                $maxPayment = 5;
                	$index = 1;
                	foreach ($model as $key => $pj) {
                	  if($pj->pj_fiscalyear==$year && $pj->pj_work_cat==$cat)
                	  {	
                		
                	  	
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

                         //

                         $maxContract = $nPC < $nOC ? $nOC : $nPC ;

                         $pj_rowspan = $maxContract * $maxPayment;

                        
                         $iPC = 0;
                         $iOC = 0;
                         $pcCost = 0;
                         $ocCost = 0;
                        for ($i=0; $i <$pj_rowspan ; $i++) { 
                            
                            echo "<tr id='row".$i."'>";
                            	//draw project detail
                            	if($i==0)
                            	{
                            		echo "<td rowspan='".$pj_rowspan."'>".$index."</td>";
		                			echo "<td rowspan='".$pj_rowspan."'>".$pj->pj_name."<br>";
		                			//workcode
		                			$Criteria = new CDbCriteria();
		                            $Criteria->condition = "pj_id='$pj->pj_id'";
		                			$workcodes = WorkCode::model()->findAll($Criteria);
		                			foreach ($workcodes as $key => $wc) {
		                				echo $wc->code."<br>";
		                			}

		                			echo "</td>";
                            	}

                            	//draw PC
                            	if($i % $maxPayment == 0)
                            	{

                            		 
                            		if(!empty($pcs[$iPC]))
                            		{	
                            			$pc = $pcs[$iPC];	
	                            		echo "<td rowspan='".$maxPayment."'>".$pc->pc_details."<br><br>";
		                                if(!empty($pc->pc_guarantee))
		                                	echo "-หนังสือค้ำประกัน ".$pc->pc_guarantee."<br>";
		                                if(!empty($pc->pc_garantee_end))
		                                	echo "-เลขที่บันทึกส่งกองการเงิน ".$pc->pc_garantee_end."<br>";
		                                if(!empty($pc->pc_PO))
		                                {
		                                    $pc->pc_PO = str_replace("PO", "", $pc->pc_PO);
		                                    echo "-PO ".$pc->pc_PO."<br>";
		                                }	
				                	  	echo "</td>";

				                	  	echo "<td rowspan='".$maxPayment."' style='text-align:center'>".$pc->pc_code."</td>";
                                
		                                echo "<td rowspan='".$maxPayment."' style='text-align:center'>".renderDate($pc->pc_sign_date)."<br><br>";
		                                echo "<u>ครบกำหนด</u><br>";
		                                echo renderDate($pc->pc_end_date);
		                                echo "</td>";



		                                $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    

		                                $pcCost =$pc->pc_cost + $pp[0]["sum"];

		                                echo "<td rowspan='".$maxPayment."' style='text-align:right'>".number_format($pcCost,2)."</td>";



				                	}
				                	else{

				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                	}  	

			                	  	$iPC++;	
                            	}

                            	//draw Payment PC
                            	$Criteria = new CDbCriteria();
                                $Criteria->condition = "proj_id='$pc->pc_id'";
                                $paymentProjs = PaymentProjectContract::model()->findAll($Criteria);

                                if(!empty($paymentProjs[$i]))
                                {
                                		$pay = $paymentProjs[$i];
                                		echo "<td>".$pay->detail."</td>";
                                    	echo "<td style='text-align:right'>".$pay->money."</td>";

                                    	//find pay before
                                    	$str_date = explode("/", $pay->invoice_date);
                                        $invoice_date= "";
                                        if(count($str_date)>1)
                                            $invoice_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_project_contract')
                                            ->where('invoice_date < "'.$invoice_date.'" AND proj_id='.$pc->pc_id)
                                            ->queryAll();
                                            
                                        //print_r($pay->invoice_date);    
                                        $pay->money = str_replace(",", "", $pay->money);
                                        echo "<td style='text-align:right'>".number_format($pcCost - $pay->money - $pp[0]["sum"],2)."</td>";
                                        echo "<td>".$pay->invoice_no." ".renderDate($pay->invoice_date)."</td>";
                                        echo "<td>".$pay->bill_no." ".renderDate($pay->bill_date)."</td>";
                                
                                        if($i%$maxPayment==0)
                                        {
                                            echo "<td style='text-align:center'>".$pc->pc_T_percent."</td>";
                                            echo "<td style='text-align:center'>".$pc->pc_A_percent."</td>";     

                                        } 
                                        else{
                                            echo "<td></td><td></td>";
                                        }
                                }
                                else{
                                	echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                	echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                                	echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                }	

                                //draw OC
                            	if($i % $maxPayment == 0)
                            	{

                            		 
                            		if(!empty($ocs[$iOC]))
                            		{	
                            			$oc = $ocs[$iOC];	
                            			$vendor = vendor::model()->findByPk($oc->oc_vendor_id);
	                            		echo "<td rowspan='".$maxPayment."'>".$vendor->v_name."</td>";

	                            		echo "<td rowspan='".$maxPayment."'>".$oc->oc_detail."<br><br>";
		                                if(!empty($oc->oc_PO))
		                                {
		                                    $oc->oc_PO = str_replace("PO", "", $oc->oc_PO);
		                                    echo "-PO ".$oc->oc_PO."<br>";
		                                }
		                                if(!empty($oc->oc_letter))
		                                	echo "-หนังสือสั่งจ้าง ".$oc->oc_letter."<br>";
		                                if(!empty($oc->oc_guarantee))
		                                	echo "-หนังสือค้ำประกัน ".$oc->oc_guarantee."<br>";
		                                if(!empty($oc->oc_guarantee_cf))
		                                	echo "-หนังสือยืนยันค้ำประกัน ".$oc->oc_guarantee_cf."<br>";
		                                if(!empty($oc->oc_adv_guarantee))
		                                	echo "-หนังสือค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee."<br>";
		                                if(!empty($oc->oc_adv_guarantee_cf))
		                                	echo "-หนังสือยืนยันค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee_cf."<br>";
		                                
		                                if(!empty($oc->oc_insurance))
		                                	echo "-กรมธรรม์ประกันภัย ".$oc->oc_insurance."<br>";
		                                	
				                	  	echo "</td>";
		                                
		                                //echo renderDate($pc->pc_end_date);
		                                //echo "</td>";

										echo "<td rowspan='".$maxPayment."' style='text-align:center'>".$oc->oc_code."</td>";		                                
										echo "<td rowspan='".$maxPayment."' style='text-align:center'>".renderDate($oc->oc_sign_date)."</td>";
										echo "<td rowspan='".$maxPayment."' style='text-align:center'>".renderDate($oc->oc_end_date)."</td>";
										echo "<td rowspan='".$maxPayment."' style='text-align:center'>".renderDate($oc->oc_approve_date)."</td>";	


		                                $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    
                                        $oc->oc_cost = str_replace(",", "", $oc->oc_cost);
		                                $ocCost =$oc->oc_cost + $pp[0]["sum"];


		                                echo "<td rowspan='".$maxPayment."' style='text-align:right'>".number_format($ocCost,2)."</td>";



				                	}
				                	else{

				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                		echo "<td rowspan='".$maxPayment."'></td>";
				                	}  	

			                	  	$iOC++;	
                            	}


                            	//draw Payment PC
                            	$Criteria = new CDbCriteria();
                                $Criteria->condition = "contract_id='$oc->oc_id'";
                                $paymentProjs = PaymentOutsourceContract::model()->findAll($Criteria);

                                if(!empty($paymentProjs[$i]))
                                {
                                		$pay = $paymentProjs[$i];
                                		echo "<td>".$pay->detail."</td>";
                                    	echo "<td style='text-align:right'>".$pay->money."</td>";
                                    	echo "<td style='text-align:center'>".renderDate($pay->approve_date)."</td>";


                                    	//find pay before
                                    	$str_date = explode("/", $pay->invoice_receive_date);
                                        $invoice_date= "";
                                        if(count($str_date)>1)
                                            $invoice_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
                                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_outsource_contract')
                                            ->where('invoice_receive_date < "'.$invoice_date.'" AND contract_id='.$oc->oc_id)
                                            ->queryAll();
                                            
                                        //print_r($pp);    
                                        $pay->money = str_replace(",", "", $pay->money);
                                        echo "<td style='text-align:right'>".number_format($ocCost - $pay->money - $pp[0]["sum"],2)."</td>";
                                        
                                        if($i%$maxPayment==0)
                                        {
                                            echo "<td style='text-align:center'>".$oc->oc_T_percent."</td>";
                                            echo "<td style='text-align:center'>".$oc->oc_A_percent."</td>";     

                                        } 
                                        else{
                                            echo "<td></td><td></td>";
                                        }
                                }
                                else{
                                	echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                	echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                	echo "<td>&nbsp;</td><td>&nbsp;</td>";
                                }	


                            echo "</tr>";

                        }   


	                	 
	                	 
	                		

                		$index++;
                	  } 	
                	}

                }
                //workcat	


                ?>
            </tbody>
        </table>
