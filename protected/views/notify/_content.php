<style type="text/css">
	hr {

		margin: 0px 0px; 
	}

	.header {
		font-weight: bold;
		font-size: 20px;
	}

</style>
<div class="alert alert-danger" role="alert"><h4>รายการแจ้งเตือน</h4></div>


<?php


$current_date = (date("Y")+543).date("-m-d");

//print_r("SELECT * FROM payment_project_contract WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
//DAY ),'".$current_date."')<7  AND (bill_date='' OR bill_date='0000-00-00')");
$projectContractData=Yii::app()->db->createCommand("SELECT pj_id, pj_name as project,pc_code as contract,'แจ้งเตือนครบกำหนดค้ำประกันสัญญา' as alarm_detail,pc_garantee_date as date_end, CONCAT('project/update/',pj_id) as url,'1' as type, pc_id as update_id FROM project_contract pc LEFT JOIN project p ON pc.pc_proj_id=p.pj_id WHERE DATEDIFF(pc_garantee_date,'".$current_date."')<=7  AND (pc_garantee_end='')")->queryAll(); 


$paymentProjectData=Yii::app()->db->createCommand("SELECT pj_id,pj_name as project,pc_code as contract, 'แจ้งเตือนครบกำหนดชำระเงินของ vendor' as alarm_detail,DATE_ADD( invoice_date, INTERVAL invoice_alarm
DAY ) as date_end, CONCAT('paymentProjectContract/update/',id) as url,'2' as type, id as update_id FROM payment_project_contract pay_p LEFT JOIN project_contract ON pay_p.proj_id=pc_id LEFT JOIN project ON pc_proj_id=pj_id  WHERE DATEDIFF(DATE_ADD( invoice_date, INTERVAL invoice_alarm
DAY ),'".$current_date."')<=7  AND (bill_date='' OR bill_date='0000-00-00')")->queryAll(); 

$paymentOutsourceData=Yii::app()->db->createCommand("SELECT pj_id,pj_name as project,oc_code as contract, 'แจ้งเตือนครบกำหนดจ่ายเงินให้ supplier' as alarm_detail,DATE_ADD( invoice_receive_date, INTERVAL 10
DAY ) as date_end, CONCAT('paymentOutsourceContract/update',id) as url,'3' as type, id as update_id FROM payment_outsource_contract pay_p LEFT JOIN outsource_contract ON pay_p.contract_id=oc_id LEFT JOIN project ON oc_proj_id=pj_id WHERE DATEDIFF(invoice_receive_date,'".$current_date."')<10  AND (approve_date='' OR approve_date='0000-00-00')")->queryAll(); 

$records=array_merge($projectContractData , $paymentProjectData, $paymentOutsourceData);
$projData = array();
foreach ($records as $key => $value) {

     $index = $value["project"];//array_search($value["pj_id"],$projData, true); 
     $projData[$index][] = $value;

}

// print_r($projData);

foreach ($projData as $key => $value) {
	echo "<div class='header'>โครงการ :".$key ."</div><hr>";
	foreach ($value as $key => $value2) {
		echo "สัญญา ".$value2["contract"]." : <font color='red'>".$value2["alarm_detail"]."</font><br>";
	}
	echo "<br>";
}



//echo count($records);
$provAll = new CArrayDataProvider($records,
    array(
    	'keyField'=>false,  //don't have 'id' column
        'sort' => array( //optional and sortring
            'attributes' => array(
                'project', 
                'contract',
                'date_end',
                'alarm_detail',
            ),
        ),
        'pagination' => array('pageSize' => 10) //optional add a pagination
    )
);


  ?>
