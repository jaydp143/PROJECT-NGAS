<?php

// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php');
require("../pages/database.php");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        $this->SetFont('times', 'B', 12);
        $this->Cell(180, 3, 'APPROPRIATION REPORT', 0, 1, 'C');
        $this->SetFont('', 'B', 12);
        $this->Cell(180, 3, 'BUDGET YEAR '.$_POST['budget_year'], 0, 1, 'C');
        $this->SetFont('', 'B', 12);
        $this->Cell(180, 3, $_POST['function'], 0, 1, 'C');
       
    }

    // Page footer
    public function Footer()
    {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(7);



        $this->SetFont('times', '', 9);
        $this->Cell(0, 5, 'Page ' . $this->getAliasNumPage() . ' of  ' . $this->getAliasNbPages(), 0, 0, 'C', 1);
    }
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('P', 'mm', array(210,297), true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JAY-R');
$pdf->SetTitle('APPROPRIATION REPORT');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins

$pdf->SetHeaderMargin(15);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetMargins(15, 40, 15);
$pdf->SetFont('times', 'N', 8, true);

// add a page
$pdf->AddPage();

// table header for report
$tbl = ''; //variable that holds the content of the table and will display after
//header of the report, initialize content to tbl
$tbl .= '
  <table  border="1" width ="100%" style="margin-right: 3px" >  
    <thead>     
      <tr align="center">
        <th width ="50%"><b><br><br>Object of Expenditure<br></b></th>
        <th width ="25%"><b><br><br>Account Code<br></b></th>
        
        <th width ="25%"><b>Budget Year<br></b>'.$_POST['budget_year'].'<br><b>Expenditures</b><br>(Proposed)</th>
      </tr>
    </thead>';
    $totalAppropriation_category=0;
    $grandtotal=0;
    $queryCategory="SELECT category FROM tbl_acc_category";
    $sqlCategory=mysqli_query($connection,$queryCategory);
    while($val=mysqli_fetch_array($sqlCategory))
    {
      
$tbl.='
    <tbody>
      <tr> 
        <td colspan="3"><h3> &nbsp;&nbsp;'.$val["category"].'</h3></td>
      </tr>';

    $sqlAccounts=mysqli_query($connection,"SELECT app.appropriation_id, app.amount_appropriation, acc.acc_category, acc.account_description, app.account_code FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON acc.account_code=app.account_code WHERE app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function_code']."' AND acc.acc_category='".$val['category']."'");
        while($valAccounts=mysqli_fetch_array($sqlAccounts))
        {
          $totalAppropriation_category+=$valAccounts['amount_appropriation'];
          $grandtotal+=$valAccounts['amount_appropriation'];
$tbl.='
      <tr> 
        <td width ="50%" >&nbsp; &nbsp;&nbsp;'.$valAccounts['account_description'].'</td>
        <td width ="25%" align="center">'.$valAccounts['account_code'].'</td>
        
        <td width ="25%" align="right">'.number_format($valAccounts['amount_appropriation'],2).'</td>
      </tr>';
        }
$tbl.='
      <tr> 
        <td  width ="75%" colspan="2" align="right"  ><b>&nbsp;TOTAL '.$val["category"].'</b></td>
       
        <td  width ="25%" align="right"><b>'.number_format($totalAppropriation_category,2).'</b></td>
      </tr>'; 
$totalAppropriation_category=0;
    }     
      
  
$tbl.='
      <tr> 
        <td colspan="2" align="right"  ><h3>TOTAL APPROPRIATION</h3></td>
        
        <td align="right"><h4>'.number_format($grandtotal,2).'</h4></td>
      </tr>
    </tbody>
  </table>'; 
           

$pdf->lastPage();
$pdf->Ln(-3.95);

$pdf->writeHTML($tbl, true, false, false, false, '');



$savename = "Appropriation Report.pdf";
$pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+