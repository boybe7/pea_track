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



// Include the main TCPDF library (search for installation path).
require_once('/../tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
        // Set font
        //$this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
        $this->SetFont('thsarabun', '', 11);
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // Logo
        //$image_file = 'bank/image/mwa2.jpg';
        //$this->Image($image_file, 170, 270, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Cell(0, 5, date("d/m/Y"), 0, false, 'R', 0, '', 0, false, 'T', 'M');

        $this->writeHTMLCell(145, 550, 70, 200, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
    }
}

// create new PDF document
//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Boybe');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setPrintHeader(false);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
    $html = "";


    $pj = $model;
    //project contract
    // $Criteria = new CDbCriteria();
    // $Criteria->condition = "pc_proj_id='$pj->pj_id'";
    // $pcs = ProjectContract::model()->findAll($Criteria);

    $html .= '<table border="1" class="span12" style="margin-left:0px;">';
       
         $html .= '<thead>';
              $html .= '<tr> ';
                $html .= '<th rowspan="2" style="text-align:center;width:2%">ลำดับ</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:10%">โครงการ</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:10%">รายละเอียดงาน</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">เลขที่สัญญา</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">วันที่ลงนามสัญญา</th>';
                $html .= '<th colspan="8" style="text-align:center;width:30%">รายรับ</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">ชื่อบริษัทจ้างช่วง</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">รายละเอียดงาน</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">เลขที่สัญญา</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">วันที่ลงนามสัญญา</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">วันที่ครบกำหนด</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">วันที่รับรองงบ</th>';
                $html .= '<th colspan="7" style="text-align:center;width:25%">วงเงินช่วง</th>';
                $html .= '<th colspan="3" style="text-align:center;width:10%">ค่าบริหารโครงการ</th>';
                $html .= '<th rowspan="2" style="text-align:center;width:5%">วงเงินที่คาดว่าจะได้รับ</th>';
              $html .= '</tr>';
              $html .= '<tr>';
                $html .= '<th>วงเงินตามสัญญา</th>';
                $html .= '<th>รายการ</th>';
                $html .= '<th>ได้รับเงิน</th>';
                $html .= '<th>คงเหลือเรียกเก็บเงิน</th>';
                $html .= '<th>เลขที่ใบแจ้งหนี้</th>';
                $html .= '<th>เลขที่ใบเสร็จรับเงิน</th>';
                $html .= '<th>T%</th>';
                $html .= '<th>A%</th>';

                $html .= '<th>ตามสัญญา</th>';
                $html .= '<th>รายการ</th>';
                $html .= '<th>จ่ายเงิน</th>';
                $html .= '<th>อนุมัติจ่าย</th>';
                $html .= '<th>คงเหลือจ่ายเงิน</th>';
                $html .= '<th>T%</th>';
                $html .= '<th>B%</th>';

                $html .= '<th>ประมาณการ</th>';
                $html .= '<th>ค่ารับรอง</th>';
                $html .= '<th>ใช้จริง</th>';

              $html .= '</tr>';  
            $html .= '</thead>';

    $html .= '</table>';     
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Print text using writeHTMLCell()

//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'summaryReport.pdf','F');

// ---------------------------------------------------------

// Close and output PDF document
// // This method has several options, check the source code documentation for more information.
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'tempReport.pdf'))
{    
    if(unlink($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'tempReport.pdf'))
        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'tempReport.pdf','F');
}else{
   $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/pea_track/'.'tempReport.pdf','F');
}
ob_end_clean() ;

exit;
?>