<?php
$this->breadcrumbs=array(
	'สรุปงานรายรับ-รายจ่ายงานโครงการ ',
	
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
    else
        $d = $dates[0];

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
                <th width="20px" rowspan="2">ลำดับ</th>
                <th width="200px" rowspan="2">ชื่อโครงการ</th>
                <th width="100px" rowspan="2">วงเงินตามสัญญา</th>
                <th width="100px" rowspan="2">รายรับ</th>
                <th width="100px" rowspan="2">ยอดรับคงเหลือ</th>
                <th width="150px" rowspan="2">ชื่อผู้รับจ้าง</th>
                <th width="100px" rowspan="2">วงเงินตามสัญญาจ้างช่วง</th>
                <th width="100px" rowspan="2">รายจ่าย</th>
                <th width="100px" rowspan="2">ยอดจ่ายคงเหลือ</th>
                <th width="100px"  rowspan="2">ประมาณการค่าบริหารโครงการ</th>
                <th colspan="3">รายจ่ายที่เกิดขึ้นจริง</th>
                </tr>
              <tr>
              	
                <th width="100px">ค่าบริหารโครงการ</th>
                <th width="100px">ค่ารับรอง</th>
                <th width="100px">คงเหลือ</th>
               
              </tr>  
            </thead>
            <tbody>
               
                <?php
                //fiscalyear
                $fiscalyear = array();

                foreach ($model as $key => $value) {
                	
                	//print_r($value);
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
                	
                	echo "<td style='background-color:#EBF8A4' colspan='13'>ปี ".$year." ".$mWorkCat->wc_name."</td>";
                	
                	echo "</tr>";
                	
                	//echo $year.":".$cat;

	                $maxPayment = 5;
                	$index = 1;

                	 //summary
                         $sum_pc_cost = 0;
                         $sum_pc_receive = 0;
                         
                         $sum_oc_cost = 0;
                         $sum_oc_receive = 0;
                       
                         $sum_m_real = 0;
                         $sum_m_type1 = 0;
                         $sum_m_expect = 0;
                       

                	foreach ($model as $key => $pj) {
                	  if($pj->pj_fiscalyear==$year && $pj->pj_work_cat==$cat)
                	  {	
                		
                	  	
                		//project contract
	                	 $Criteria = new CDbCriteria();
	                     $Criteria->condition = "pc_proj_id='$pj->pj_id'";
	                	 $pcs = ProjectContract::model()->findAll($Criteria);
                         $nPC = count($pcs);

                         $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(pc_cost) as sum')
                                            ->from('project_contract')
                                            ->where("pc_proj_id='$pj->pj_id'")
                                            ->queryAll();  
                        $pcCostAll = $pp[0]["sum"];                     
                        foreach ($pcs as $key => $pc) {
                            $pp2 = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll(); 
                            $pcCostAll += $pp2[0]["sum"];                 
                         } 
                         
                                                                                
                            

                         //2.outsource contract
                         $Criteria = new CDbCriteria();
                         $Criteria->condition = "oc_proj_id='$pj->pj_id'";
                         $ocs = OutsourceContract::model()->findAll($Criteria);
                         $nOC = count($ocs);

                         //management cost
                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=0";
                        $m_plan = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=2";
                        $m_real = ManagementCost::model()->findAll($Criteria);

                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=1";
                        $m_type1 = ManagementCost::model()->findAll($Criteria);

                        

                        //end

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=0")
                                            ->queryAll();
                        $sum_m_expect += $pp[0]["sum"];


                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=1")
                                            ->queryAll();
                        $m_type1_sum = $pp[0]["sum"];                    

                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(mc_cost) as sum')
                                            ->from('management_cost')
                                            ->where("mc_proj_id='$pj->pj_id' AND mc_type=2")
                                            ->queryAll();
                        $m_real_sum = $pp[0]["sum"];

                        $sum_m_real += $m_real_sum;
                        $sum_m_type1 += $m_type1_sum;
                        //profit
                        //1.income
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_project_contract')
                                            ->join('project_contract','proj_id=pc_id')
                                            ->where("pc_proj_id='$pj->pj_id'")
                                            ->queryAll();
                        //echo $pp[0]["sum"];
                        $income = $pp[0]["sum"];
                        
                        //1.outcome
                        
                        $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(money) as sum')
                                            ->from('payment_outsource_contract')
                                            ->join('outsource_contract','contract_id=oc_id')
                                            ->where("oc_proj_id='$pj->pj_id'")
                                            ->queryAll();                    
                        $outcome = $pp[0]["sum"];                    
                      



                         $maxContract = $nPC < $nOC ? $nOC : $nPC ;

                         $pj_rowspan = $maxContract ;

                        
                        

                         //end

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
		                			echo "<td rowspan='".$pj_rowspan."'>".$pj->pj_name."</td>";
                                    //draw PC
                                    echo "<td rowspan='".$pj_rowspan."'>".$pcCostAll."</td>";
                            	}

                           echo "<tr"; 


	                	 
	                	 
	                	}	

                		$index++;
                	  } 	
                		
                	}//end project   
                	
                	//summary
        			 
                	echo "<tr>";
                	

                	echo "</tr>";


                }
                //workcat	


                ?>
            </tbody>
        </table>
