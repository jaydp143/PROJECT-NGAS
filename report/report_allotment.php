<?php

// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php'); 
require("../home/database.php");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
      
    }

    // Page footer
    public function Footer() {
      $footertext="xxx";
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, $footertext, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('P', 'mm', array(210,297), true, 'UTF-8', false);
// set document information

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 10, 10);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'N', 9);

// add a page
$pdf->AddPage();

// set some text to print
      //select office
      $queryOffice = "SELECT * FROM tbl_office_code WHERE office_code='".$_GET['o']."'";
      $sqlOffice = mysqli_query($connection, $queryOffice);
      $rowOffice = mysqli_fetch_array($sqlOffice);
          
          $office_des=$rowOffice["office_description"];
          $office_acronym=$rowOffice["office_acronym"];
          $office_head=$rowOffice["office_head"];
          $office_headpos=$rowOffice["head_position"];
          
     //end select office   

        if ($_GET['q']=="1"){
          $qrt="1st";   
        } 
        else if ($_GET['q']=="2") {
             $qrt="2nd"; 
        }
        else if ($_GET['q']=="3") {
             $qrt="3rd"; 
        } 
        else if ($_GET['q']=="4") {
             $qrt="4th"; 
        }

   $tbl ='
   <table class="header-table" border="1">
        <tr>
          <td colspan="2">
          <img src="">
          </td>
          <td colspan="4" align="center">REPUBLIC OF THE PHILIPPINES<br>
          PROVINCIAL GOVERNMENT OF PANGASINAN<br>
          LINGAYEN, PANGASINAN
          </td>
          <td colspan="2">
          <img src="">
          </td> 
        </tr>
        <tr>
            <td colspan="5">OBLIGATION REQUEST</td>
            <td colspan="3">No.</td>
        </tr>
        <tr>
            <td colspan="2">PAYEE</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="2">OFFICE</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="2">ADDRESS</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="2">Responsibility<br>Center</td>
            <td colspan="3">PARTICULARS</td>
            <td >F.P.P.</td>
            <td >Account<br>CODE</td>
            <td >AMOUNT</td>
        </tr>
      </table>';
    //header of the report, initialize content to tbl

    $pdf->writeHTML($tbl, true, false, false, false, '');
    $savename="AllotmentReport.pdf";
    $pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+