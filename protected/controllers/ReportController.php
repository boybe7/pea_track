<?php

class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
       

	/**
	 * Displays the progress page
	 */
	public function actionProgress()
	{
            		
		// display the progress form
		$this->render('progress');
	}

	public function actionSummary()
	{
    	
		// display the progress form
		$this->render('summary');
	}

	 public function actionGenProgress()
    {
        
    	
    	if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	else
    	   $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

        $this->renderPartial('_formProgress2', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }

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

	public function actionGenSummaryExcel()
    {
    	   $model = Project::model()->findByPk($_GET["project"]);

		   Yii::import('ext.phpexcel.XPHPExcel');    
		   $objPHPExcel= XPHPExcel::createPHPExcel();
		   $objReader = PHPExcel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load("report/templateSummary.xls");

		    $title = new PHPExcel_Style();
		    $title->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,     
			            'bold'=>true,         
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			          
			            
			    ));
		    $header = new PHPExcel_Style();
			$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'64ED74')
			        ),
			            
			    ));

			$header2 = new PHPExcel_Style();
			$header2->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'F7E672')
			        ),
			            
			    ));

			$detail = new PHPExcel_Style();
			$detail->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15, 
			            //'bold'=>true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        )			            
			    ));
			$detail_tb = new PHPExcel_Style();
			$detail_tb->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'top'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		   $row_start = 2;
		   $row = 2;
		    $pj = $model;
			//project contract
			$Criteria = new CDbCriteria();
			$Criteria->condition = "pc_proj_id='$pj->pj_id'";
			$pcs = ProjectContract::model()->findAll($Criteria);

		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"โครงการ ".$pcs[0]->pc_details);
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"ให้ ".$pj->pj_name);
		   $objPHPExcel->getActiveSheet()->setSharedStyle($title, "A".$row_start.":J".$row);
		   $objPHPExcel->getActiveSheet()->getStyle("A".$row_start.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		   
		   
		   $row++;
		   $row_pj = $row;
		   $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':J'.$row);
		   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row++,"ส่วนผู้ว่าจ้าง : ".$pj->pj_name);
		   $objPHPExcel->getActiveSheet()->setSharedStyle($header, "A".$row_pj.":J".($row-1));
		   $objPHPExcel->getActiveSheet()->getStyle("A".$row_pj.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		   
		   $row_detail = $row;
		   foreach ($pcs as $key => $pc) {
				//echo   "<tr><td width='30%'>ใบสั่งจ้างเลขที่ : ".$pc->pc_code."</td><td width='30%'>วันที่เริ่มในสัญญา : ".renderDate($pc->pc_sign_date)."</td><td width='50%' colspan=2>วันที่สิ้นสุดในสัญญา : ".renderDate($pc->pc_end_date)."</td></tr>";
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ใบสั่งจ้างเลขที่ : ".$pc->pc_code);
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"วันที่เริ่มในสัญญา : ".$this->renderDate($pc->pc_sign_date));

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"วันที่สิ้นสุดในสัญญา : ".$this->renderDate($pc->pc_end_date));
				$row++;
			}
		   	
		    //workcode
			$Criteria = new CDbCriteria();
			$Criteria->condition = "pj_id='$pj->pj_id'";
			$wcs = WorkCode::model()->findAll($Criteria);
			

			$i=0;
			$row_code = $row;
			foreach ($wcs as $key => $wc) {
				if($i==0)  
				  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"หมายเลขงาน : ".$wc->code);
				else
				  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"                   : ".$wc->code);
				$i++;
				$row++;
			}
			if($i==0)
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"หมายเลขงาน : ");

			$row = $row_code;
			$i=0;
			$sum_pc_cost = 0;
			$check = false;
			foreach ($pcs as $key => $pc) {

				$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    

				$pcCost =$pc->pc_cost + $pp[0]["sum"];

				$sum_pc_cost += $pcCost;
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
			    
			    
			    if(!empty($pc->pc_name_request))
				{    	
				    $check = true;
				    if($i==0)  
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"แจ้งจัดสรรงบ กปง./กซข./กฟจ. : ".$pc->pc_name_request);
					else
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"                                          : ".$pc->pc_name_request);
				}
				else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"แจ้งจัดสรรงบ กปง./กซข./กฟจ. : ");
					
				}	
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
			    
			    if(!empty($pc->pc_code_request))
				{ 
				    $check = true;
				    if($i==0)  
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"เลขที่ส่ง / ลว. : ".$pc->pc_code_request);
					else
					  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"                            : ".$pc->pc_code_request);
				}
				else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"เลขที่ส่ง / ลว. : ");
					
				}	
				$i++;

				 $row++;	
			}
			

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_code,"วงเงิน : ".number_format($sum_pc_cost,2));
				
			$row = $objPHPExcel->getActiveSheet()->getHighestRow();
			if(!$check)
				$row--;
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail, "A".$row_detail.":J".($row));


			//table header
 // header('Content-type: text/plain');
 //                           		count($pcs);                    
 //                           	    exit;
			//$row = 10;
			$row++;
			$row_detail = $row;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.($row+1));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ที่");
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':E'.($row));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ด้านการดำเนินการโครงการ");			
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':J'.($row));			    
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ด้านการเงิน");
			$row++;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"รายละเอียด");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"อนุมัติโดย/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,"วงเงิน/เป็นเงินเพิ่ม");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,"ระยะเวลาแล้วเสร็จ/ระยะเวลาขอขยาย");
			
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ชำระเงินงวดที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"ใบแจ้งหนี้/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,"ใบเสร็จเลขที่/ลงวันที่");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน");
			$row++;
			
			$row_ap = $row;
			$row_pa = $row;
			$index = 1;
			$sum_pay = 0;
			foreach ($pcs as $key => $pc) {
				$approve = Yii::app()->db->createCommand()
	                            ->select('detail,approveBy,dateApprove,cost,timeSpend')
	                            ->from('contract_approve_history')
	                            ->where("contract_id='$pc->pc_id' AND type=1")
	                            ->queryAll();
	            foreach ($approve as $key => $value) {
			    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_ap,$index);
			    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_ap,$value["detail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_ap,$value["approveBy"]."\r".$this->renderDate2($value["dateApprove"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_ap,number_format($value["cost"],2));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_ap,$value["timeSpend"]);
					$index++;
			    	$row_ap++;
	            }
	            
	            $payment = Yii::app()->db->createCommand()
	                            ->select('*')
	                            ->from('payment_project_contract')
	                            ->where("proj_id='$pc->pc_id'")
	                            ->queryAll();                
	           
	            foreach ($payment as $key => $value) {
	            	
	        		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,$value["detail"]);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_pa,$value["invoice_no"]."\r".$this->renderDate2($value["invoice_date"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_pa,$value["bill_no"]."\r".$this->renderDate2($value["bill_date"]));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($value["money"],2));
					$row_pa++;

					if($value["bill_no"]!=""){
               			$sum_pay += $value["money"];
               		}
	            }
			}
			$remain = $sum_pc_cost - $sum_pay;
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row_pa.':I'.($row_pa));	
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,"              คงเหลือ");
		    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($remain,2));
					

			$row_tb = $row;
			$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;	
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "A".$row_detail.":E".($row-1));
			$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "G".$row_detail.":J".($row-1));
			$objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		    $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":J".($row-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $objPHPExcel->getActiveSheet()->getStyle("D".$row_tb.":D".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle("J".$row_tb.":J".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":A".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("C".$row_tb.":C".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("H".$row_tb.":I".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            

            $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row-1))->getAlignment()->setWrapText(true);		   
		
            

            //----------------outsource-------------------------//
            $Criteria = new CDbCriteria();
			$Criteria->condition = "oc_proj_id='$pj->pj_id'";
			$ocs = OutsourceContract::model()->findAll($Criteria);


			$index = 0;

			foreach ($ocs as $key => $oc) {
			        $index++;
			        $row++;
			        $vendor = Vendor::model()->findByPk($oc->oc_vendor_id);	
					
			        $sum_oc_cost = 0;
					$pp = Yii::app()->db->createCommand()
				                                            ->select('SUM(cost) as sum')
				                                            ->from('contract_change_history')
				                                            ->where("contract_id='$oc->oc_id' AND type=2")
				                                            ->queryAll();
						                				///print_r($changeHists);
				    $oc->oc_cost = str_replace(",", "", $oc->oc_cost);    

					$sum_oc_cost =$oc->oc_cost + $pp[0]["sum"];

					
		            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':J'.$row);
				   	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ส่วนผู้รับจ้าง รายที่ ".$index." : ".$vendor->v_name);
				   	$objPHPExcel->getActiveSheet()->setSharedStyle($header2, "A".$row.":J".$row);
				   	$objPHPExcel->getActiveSheet()->getStyle("A".$row.":J".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				    $row++;
				    $row_oc = $row;
				    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"สัญญาจ้างเลขที่ : ".$oc->oc_code);
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':E'.$row);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"วันที่เริ่มในสัญญา : ".$this->renderDate($oc->oc_sign_date));

					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':I'.$row);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"วันที่สิ้นสุดในสัญญา : ".$this->renderDate($oc->oc_end_date));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน : ".number_format($sum_oc_cost,2));
				
					$row++;
					//po
					$Criteria = new CDbCriteria();
					$Criteria->condition = "contract_id='$oc->oc_id'";
					$pos = WorkCodeOutsource::model()->findAll($Criteria);
					
					//print_r($pos);
					
					$index2 = 1;
					foreach ($pos as $key => $po) {
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,$index2);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"PO เลขที่ : ".$po->PO);
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$row.':G'.$row);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"เลขที่ส่งแจ้งรับรองงบ กปง. : ".$po->letter);
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.$row.':I'.$row);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"เป็นเงิน : ".number_format($po->money,2));
					    $index2++;
					    $row++;
					}
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail, "A".$row_oc.":J".($row-1));

					$row_detail = $row;
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':A'.($row+1));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row,"ที่");
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$row.':E'.($row));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"ด้านการดำเนินการโครงการ");			
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row.':J'.($row));			    
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ด้านการเงิน");
					$row++;
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row,"รายละเอียด");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row,"อนุมัติโดย/ลงวันที่");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row,"วงเงิน/เป็นเงินเพิ่ม");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row,"ระยะเวลาแล้วเสร็จ/ระยะเวลาขอขยาย");
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row,"ชำระเงินงวดที่");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row,"อนุมัติโดย");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row,"วัน/เดือน/ปี");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row,"วงเงิน");
					$row++;

					$approve = Yii::app()->db->createCommand()
		                            ->select('detail,approveBy,dateApprove,cost,timeSpend')
		                            ->from('contract_approve_history')
		                            ->where("contract_id='$oc->oc_id' AND type=2")
		                            ->queryAll();
		            $row_ap = $row;
		            $index3 = 1;                
		            foreach ($approve as $key => $value) {
				    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_ap,$index3);
				    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row_ap,$value["detail"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_ap,$value["approveBy"]."\r".$this->renderDate2($value["dateApprove"]));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_ap,number_format($value["cost"],2));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_ap,$value["timeSpend"]);
						$index3++;
				    	$row_ap++;
		            }
		                            
		        
			        $payment = Yii::app()->db->createCommand()
			                            ->select('*')
			                            ->from('payment_outsource_contract')
			                            ->where("contract_id='$oc->oc_id'")
		            	                ->queryAll();                
			        $sum_pay = 0;
			        $row_pa = $row;
			        foreach ($payment as $key => $value) {
			        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,$value["detail"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$row_pa,$value["approve_by"]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row_pa,$this->renderDate2($value["approve_date"]));
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($value["money"],2));
						$row_pa++;

						if($value["approve_date"]!=""){
	               			$sum_pay += $value["money"];
	               		}
	               	}

	               	$remain = $sum_oc_cost - $sum_pay;
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$row_pa.':I'.($row_pa));	
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row_pa,"              คงเหลือ");
		    		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row_pa,number_format($remain,2));
						
		    		$row_tb = $row;
					$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;	
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "A".$row_detail.":E".($row-1));
					$objPHPExcel->getActiveSheet()->setSharedStyle($detail_tb, "G".$row_detail.":J".($row-1));
					$objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				    $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row_tb-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		            
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":J".($row-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		            $objPHPExcel->getActiveSheet()->getStyle("D".$row_tb.":D".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("J".$row_tb.":J".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_tb.":A".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("C".$row_tb.":C".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            $objPHPExcel->getActiveSheet()->getStyle("H".$row_tb.":I".($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		            

		            $objPHPExcel->getActiveSheet()->getStyle("A".$row_detail.":J".($row-1))->getAlignment()->setWrapText(true);		   
				
				    //$row++;
			}	   	

		    $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		    ob_end_clean();
			ob_start();

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="01simple.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');  //
			 Yii::app()->end(); 

    }	

    public function actionGenProgressExcel()
    {
			

    	   if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	   		$model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
	       else
    	  	    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	

	
		   Yii::import('ext.phpexcel.XPHPExcel');    
		   $objPHPExcel= XPHPExcel::createPHPExcel();
		   $objReader = PHPExcel_IOFactory::createReader('Excel5');
           $objPHPExcel = $objReader->load("report/templateProgress.xls");


           		//fiscalyear
                $fiscalyear = array();

                foreach ($model as $key => $value) {
                	
                	//print_r($value);
                	if(!in_array($value->pj_fiscalyear."/".$value->pj_work_cat, $fiscalyear))
                	   $fiscalyear[] = $value->pj_fiscalyear."/".$value->pj_work_cat;
                

                }

                //print_r($model);
                $row = 3;

                $filapar = new PHPExcel_Style();
			    $filapar->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'FA9D8E')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

				$sum = new PHPExcel_Style();
			    $sum->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' =>'E070F4')
			        ),
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $normal = new PHPExcel_Style();
			    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

			    $end_project = new PHPExcel_Style();
			    $end_project->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 15,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			           
			            'borders' => array(
				            'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));



			    $cell_underline = array();
			    $cell_pc_end = array();
			    $cell_oc_end = array();

                asort($fiscalyear);
                foreach ($fiscalyear as $key => $value) {
                	$data = explode("/", $value);
                	$year = $data[0];
                	$cat = $data[1];

                	$mWorkCat = WorkCategory::model()->findByPk($cat);

		   			// Rename sheet
		   			$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row.':AD'.$row);
		      		$objPHPExcel->getActiveSheet()->setTitle('ปี '.$year);
		      		 $objPHPExcel->setActiveSheetIndex(0)
		             			->setCellValue('A'.$row, "ปี ".$year." ".$mWorkCat->wc_name);
                	// $objPHPExcel->setActiveSheetIndex(0)
		            			// ->setCellValue('A4', "1");
                	
                	$objPHPExcel->getActiveSheet()->setSharedStyle($filapar, "A".$row.":AD".$row);
                	//$objPHPExcel->getActiveSheet()->setSharedStyle($normal, "A4:AD4");

                	$maxPayment = 5;
                	$index = 1;

                	 //summary
                         $sum_pc_cost = 0;
                         $sum_pc_receive = 0;
                         $sum_pc_T = 0;
                         $sum_pc_A = 0;

                         $sum_oc_cost = 0;
                         $sum_oc_receive = 0;
                         $sum_oc_T = 0;
                         $sum_oc_A = 0;

                         $sum_m_real = 0;
                         $sum_m_type1 = 0;
                         $sum_m_expect = 0;
                         $sum_profit = 0;

                    $row++;     
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

                        //find tax
                        $Criteria = new CDbCriteria();
                        $Criteria->condition = "mc_proj_id='$pj->pj_id' AND mc_type=2 AND mc_detail LIKE '%อากร%'";
                        $m_tax = ManagementCost::model()->findAll($Criteria);

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
                        $m_profit = $income - $outcome - $m_type1_sum - $m_real_sum;

                        $sum_profit += $m_profit;

                         //end
                         $pcCost = 0;
                         $ocCost = 0;
                         	
                                	
                            	$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('A'.$row, $index);
		            			$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row, $pj->pj_name);	
		            			//workcode
		                			$Criteria = new CDbCriteria();
		                            $Criteria->condition = "pj_id='$pj->pj_id'";
		                			$workcodes = WorkCode::model()->findAll($Criteria);
		                			$row_i = $row;
		                			foreach ($workcodes as $key => $wc) {
		                				$row_i++;
		                				$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row_i, $wc->code);	
		            			
		                			}

		                			//อากร
		                			foreach ($m_tax as $key => $t) {
		                				$row_i++;
		                				$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row_i, $t->mc_detail." ".number_format($t->mc_cost,2)." บาท");	
		            			
		                			}

		                			if(!empty($pj->pj_CA))
		                			{
		                				$row_i++;
		                				$objPHPExcel->setActiveSheetIndex(0)
		            						->setCellValue('B'.$row_i, $pj->pj_CA);	
		            					
		                			}
		            			
		            			//draw PC
		                			
		                		$k = 0;
		                		$row_max = $row;
                            	foreach ($pcs as $key => $pc) {
                            			if($k==0)
                            				$row_pc = $row;
                            			else
                            				$row_pc = $row_max;				
                            			$k++;
                            				
	                            		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, $pc->pc_details);
		                                if(!empty($pc->pc_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-หนังสือค้ำประกัน ".$pc->pc_guarantee);
		                                if(!empty($pc->pc_garantee_end))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-เลขที่บันทึกส่งกองการเงิน ".$pc->pc_guarantee_end);
		                                
		                                if(!empty($pc->pc_PO))
		                                {
		                                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row_pc++, "-".$pc->pc_PO);
		                               
		                                }	
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row_max, $pc->pc_code);
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row_max, $this->renderDate($pc->pc_sign_date));
										

										
		                               	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($row_max+2), "ครบกำหนด");
		                               	$cell_underline[] = 'E'.($row_max+2);
		                               	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.($row_max+3), $this->renderDate($pc->pc_end_date));

		                               	$pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$pc->pc_id' AND type=1")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    

		                                $pcCost =$pc->pc_cost + $pp[0]["sum"];

		                                $sum_pc_cost += $pcCost;
		                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($row_max), number_format($pcCost,2));

		                                //draw Payment PC
			                            	$Criteria = new CDbCriteria();
			                                $Criteria->condition = "proj_id='$pc->pc_id'";
			                                $paymentProjs = PaymentProjectContract::model()->findAll($Criteria);
			                                $row_pay_pc = $row_max;
			                                foreach ($paymentProjs as $key =>$pay)
			                                {
			                                		
			                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.($row_pay_pc), $pay->detail);
			                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($row_pay_pc), $pay->money);

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
			                                        $sum_pc_receive += $pay->money;

			                                        $pc_remain = $pcCost - $pay->money - $pp[0]["sum"];
			                                        if($pc_remain!=0)
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_pay_pc), number_format($pc_remain,2));
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_pay_pc), "-");

			                                        if(!empty($pay->invoice_date))
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->invoice_no.'('.$this->renderDate($pay->invoice_date).")");
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->invoice_no);
			                                        if(!empty($pay->bill_date))
			                                           $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.($row_pay_pc), $pay->bill_no.'('.$this->renderDate($pay->bill_date).")");
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.($row_pay_pc), $pay->bill_no);
			                                        
			                                       
			                                        
			                                        $row_pay_pc++; 
			                                }

			                                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.($row_max), $pc->pc_T_percent);
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.($row_max), $pc->pc_A_percent);
			                                        	$sum_pc_T += $pc->pc_T_percent;
			                                            $sum_pc_A += $pc->pc_A_percent;
			                            
		                               	$row_max = $objPHPExcel->getActiveSheet()->getHighestRow() + 2;	
		                               	if(count($pcs)>1) 
		                               	  $cell_pc_end[] = $row_max - 1;                              
		                            }    


                            	                               
                                	//draw OC
                                    $k = 0;
		                			$row_max = $row;
                            		foreach ($ocs as $key => $oc) {
                            			if($k==0)
                            				$row_oc = $row;
                            			else
                            				$row_oc = $row_max;				
                            			$k++;
                            				
                            			$vendor = vendor::model()->findByPk($oc->oc_vendor_id);
	                            		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.($row_max), $vendor->v_name);
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_max), $oc->oc_detail);
                                        
                                        $row_oc++;
		                                if(!empty($oc->oc_PO))
		                                {
		                                    $oc->oc_PO = str_replace("PO", "", $oc->oc_PO);
		                                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_PO);
                                        
		                                }
		                                if(!empty($oc->oc_letter))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_letter);
                                        
		                                	//echo "-หนังสือสั่งจ้าง ".$oc->oc_letter."<br>";
		                                if(!empty($oc->oc_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_guarantee);
                                        
		                                	//echo "-หนังสือค้ำประกัน ".$oc->oc_guarantee."<br>";
		                                if(!empty($oc->oc_guarantee_cf))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_guarantee_cf);
                                        
		                                	//echo "-หนังสือยืนยันค้ำประกัน ".$oc->oc_guarantee_cf."<br>";
		                                if(!empty($oc->oc_adv_guarantee))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_adv_guarantee);
                                        
		                                	//echo "-หนังสือค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee."<br>";
		                                if(!empty($oc->oc_adv_guarantee_cf))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_adv_guarantee_cf);
                                        
		                                	//echo "-หนังสือยืนยันค้ำประกันล่วงหน้า ".$oc->oc_adv_guarantee_cf."<br>";
		                                
		                                if(!empty($oc->oc_insurance))
		                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.($row_oc++), $oc->oc_insurance."(".$this->renderDate($oc->oc_insurance_start)."-".$this->renderDate($oc->oc_insurance_end).")");
                                        
		                                	//echo "-กรมธรรม์ประกันภัย ".$oc->oc_insurance."(".renderDate($oc->oc_insurance_start)."-".renderDate($oc->oc_insurance_end).")<br>";
		                                	
				                	  	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$row_max, $oc->oc_code);
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$row_max, $this->renderDate($oc->oc_sign_date));
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$row_max, $this->renderDate($oc->oc_end_date));
                                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$row_max, $this->renderDate($oc->oc_approve_date));
                                                                                

		                                $pp = Yii::app()->db->createCommand()
                                            ->select('SUM(cost) as sum')
                                            ->from('contract_change_history')
                                            ->where("contract_id='$oc->oc_id' AND type=2")
                                            ->queryAll();
		                				///print_r($changeHists);
                                        //echo $pp[0]["sum"];    
                                        $oc->oc_cost = str_replace(",", "", $oc->oc_cost);
		                                $ocCost =$oc->oc_cost + $pp[0]["sum"];

		                                $sum_oc_cost += $ocCost; 

		                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$row_max, number_format($ocCost,2));
                                         
		                                //echo "<td rowspan='".$maxPayment."' style='text-align:right'>".number_format($ocCost,2)."</td>";

		                                //draw Payment OC
		                            	$Criteria = new CDbCriteria();
		                                $Criteria->condition = "contract_id='$oc->oc_id'";
		                                $paymentProjs = PaymentOutsourceContract::model()->findAll($Criteria);
		                                $row_pay_oc = $row_max;
		                                foreach ($paymentProjs as $key => $pay)
		                                {
		                                		
		                                		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.($row_pay_oc), $pay->detail);
			                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($row_pay_oc), $pay->money);
			                                	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.($row_pay_oc), $this->renderDate($pay->approve_date));

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
		                                        $sum_oc_receive += $pay->money;
		                                        $oc_remain = $ocCost - $pay->money - $pp[0]["sum"];

		                                        if($oc_remain!=0)
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_pay_oc), number_format($pc_remain,2));
			                                        else
			                                        	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_pay_oc), "-");

		                                } 
		                                 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.($row_max), $oc->oc_T_percent);
			                             $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.($row_max), $oc->oc_A_percent);
			                             $sum_oc_T += $oc->oc_T_percent;
			                             $sum_oc_A += $oc->oc_A_percent;       

		                                $row_max = $objPHPExcel->getActiveSheet()->getHighestRow() + 2;	 
		                               	if(count($ocs)>1)
		                               	$cell_oc_end[] = $row_max - 1;

				                	}
                            	
                            	//management cost
                                $row_ma = $row;
                                foreach ($m_plan as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }

                                $row_ma = $row;
                                foreach ($m_type1 as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }
                                $row_ma = $row;
                                foreach ($m_real as $key => $m) {
                                   $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($row_ma++), number_format($m->mc_cost,2));
			                
                                }	
                                 
                                if($m_profit!=0)
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($row), number_format($m_profit,2));
			                	

                                $row_i = $objPHPExcel->getActiveSheet()->getHighestRow()+2;
                                //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row_i, "end");
                                
		            			$objPHPExcel->getActiveSheet()->setSharedStyle($normal, "A".$row.":AD".$row_i);					
                				$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "A".($row_i-1).":AD".($row_i));

                				$objPHPExcel->getActiveSheet()->getStyle("D".$row.':E'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("J".$row.':M'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("P".$row.':S'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("W".$row.':W'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                				$objPHPExcel->getActiveSheet()->getStyle("Y".$row.':Z'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							    
                				//money format
                				
                				$objPHPExcel->getActiveSheet()->getStyle("F".$row.':F'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            	$objPHPExcel->getActiveSheet()->getStyle("H".$row.':I'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								$objPHPExcel->getActiveSheet()->getStyle("T".$row.':T'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								
								$objPHPExcel->getActiveSheet()->getStyle("V".$row.':V'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
								$objPHPExcel->getActiveSheet()->getStyle("X".$row.':X'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		
								$objPHPExcel->getActiveSheet()->getStyle("AA".$row.':AD'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
																

								foreach ($cell_pc_end as $key => $value) {
									$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "C".$value.":M".$value);
							   
								}
								foreach ($cell_oc_end as $key => $value) {
									$objPHPExcel->getActiveSheet()->setSharedStyle($end_project, "N".$value.":AD".$value);
							   
								}
							    $row = $row_i;   
								$index++;
                	  }
                	}  

                	//summary
                	 $row_i = $objPHPExcel->getActiveSheet()->getHighestRow();
                	 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$row_i.':B'.$row_i);
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.($row_i), "รวมเป็นจำนวนเงิน");
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.($row_i), number_format($sum_pc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.($row_i), number_format($sum_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.($row_i), number_format($sum_pc_cost - $sum_pc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.($row_i), number_format($sum_oc_cost,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.($row_i), number_format($sum_oc_receive,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.($row_i), number_format($sum_oc_cost - $sum_oc_receive,2));
 
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.($row_i), number_format($sum_m_expect,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.($row_i), number_format($sum_m_type1,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.($row_i), number_format($sum_m_real,2));
                	 $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.($row_i), number_format($sum_profit,2));
                	 $objPHPExcel->getActiveSheet()->setSharedStyle($sum, "A".($row_i).":AD".($row_i));
					 $objPHPExcel->getActiveSheet()->getStyle("A".$row_i.':B'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					 $objPHPExcel->getActiveSheet()->getStyle("C".$row_i.':AD'.$row_i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			 		 $row++;	
			                	
		      	}	
		   
		      	$styleArray = array(
										  'font' => array(
										    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
										  )
							);
		      	foreach ($cell_underline as $key => $value) {
		      		$objPHPExcel->getActiveSheet()->getStyle($value)->applyFromArray($styleArray);
		          
		      	}
		      	                      	
		      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
		    $objPHPExcel->setActiveSheetIndex(0);
		  	 
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);


		  //?????important clear cabage
		ob_end_clean();
		ob_start();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  //
		 Yii::app()->end(); 
        
    }

    


    public function actionGenSummary()
    {
        
    	
    	// if(isset($_GET["project"]) && !empty($_GET["project"])) 
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'pj_id='.$_GET["project"], 'params'=>array()));	
    	// else
    	//    $model = Project::model()->findAll(array('order'=>'CONCAT(pj_fiscalyear,pj_work_cat)', 'condition'=>'', 'params'=>array()));	
    	$model = Project::model()->findByPk($_GET["project"]);
        $this->renderPartial('_formSummary', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }
}