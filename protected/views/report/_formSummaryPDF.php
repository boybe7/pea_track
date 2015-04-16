
<?php
include("/../MPDF56/mpdf.php");
//include("/../mpdf60/mpdf.php");
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


    $renderDate = $d." ".$th_month[$mi]." ".$yi;
    if($renderDate==0)
        $renderDate = "";   

    return $renderDate;             
}


$mpdf = new mPDF('', 'A4', '0');
//$mpdf->SetAutoFont();

$stylesheet = "<style>
	

   	html, body{
	    text-align:center;
		font-size:10px;
		font-family: 'THSarabun';
	}
  
    .header{
        //font-family: 'TH SarabunPSK';
        font-family: 'THSarabun';
        font-size:13px;
    }
    #sty1{
        font-size:13px;
        margin-left: 0px;
    }
    #sty2{
        font-size:13px; 
        margin-left:61px;
    }
    #sty3{
        text-align: center;
        font-size:14px;
        font-weight:bold;
    }
    table
    {
        border-collapse:collapse;
        font-size:11px;
        width: 900px;
    } 
    
    td {
        height:25px;
    }

    #border3{
        border-bottom:thin solid #ccc;
        border-left:thin solid #ccc; 
        border-right: thin solid #ccc;
        
    }
    #border1 {
        border:thin solid #ccc; 
      
    }
    #border2 {
        border-top:thin solid #ccc; 
        border-left:thin solid #ccc; 
        border-right: thin solid #ccc; 
    
    }
    #border4 {
        border-right: thin solid #ccc; 
    }
    #border5 {
        border-left:thin solid #ccc; 
        border-right: thin solid #ccc; 
    }
    .hl1{
        background-color: white;
    }
    th{
        background-color: whitesmoke;
        height:30px;
    }
</style>";
$mpdf->WriteHTML($stylesheet);

$nPj = count($model);
$i = 0;
foreach ($model as $key => $pj) {

	//project contract
	$Criteria = new CDbCriteria();
	$Criteria->condition = "pc_proj_id='$pj->pj_id'";
	$pcs = ProjectContract::model()->findAll($Criteria);
    $nPC = count($pcs);

	$html = "<center><div class='header'><b>โครงการ".$pcs[0]->pc_details."<br>ให้ ".$pj->pj_name."</b></div></center>";
	$html .= "<br><table border='0'>";
	$html .=   "<tr><td colspan='3' style='background-color:#eeeeee;text-align:center'>ส่วนผู้ว่าจ้าง : ".$pj->pj_name."</td></tr>";
	$html .=   "<tr><td width='35%'>ใบสั่งจ้างเลขที่ : ".$pcs[0]->pc_code."</td><td width='25%'>วันที่เริ่มในสัญญา : ".renderDate($pcs[0]->pc_sign_date)."</td><td width='40%'></td></tr>";
	$html .= "</table>";
	
	$mpdf->WriteHTML($html);
	if($i!=$nPj-1)
	   $mpdf->addPage();
	$i++;
}


//$mpdf->Output('summaryReport.pdf','F');



// Include the main TCPDF library (search for installation path).
require_once('/../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('thsarabun', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'summaryReport.pdf','F');
ob_end_clean() ;

exit;
?>