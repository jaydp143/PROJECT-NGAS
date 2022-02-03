<?php

// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php');
require("../pages/database.php");
require("../pages/season.php");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        
        $this->SetFont('times', 'B', 12);
        $this->Cell(300, 10, 'ADVICE OF ALLOTMENT', 0, 1, 'C');
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
$pdf = new MYPDF('L', 'mm', array(216,330), true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JAY-R');
$pdf->SetTitle('Advice Allotment');
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
$pdf->SetAutoPageBreak(TRUE,15);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetMargins(15,30, 15);
$pdf->SetFont('times', 'N', 9, true);

// add a page
$pdf->AddPage();

$quarter_description="";
$quarter_ending="";

if($curQuarter==1){
  $quarter_description="FIRST";
  $quarter_ending="March 31, ".$curYear;
}
if($curQuarter==2){
  $quarter_description="SECOND";
  $quarter_ending="June 30, ".$curYear;
}
if($curQuarter==3){
  $quarter_description="THIRD";
  $quarter_ending="September 30, ".$curYear;
}
if($curQuarter==4){
  $quarter_description="FOURTH";
  $quarter_ending="December 31, ".$curYear;
}

$tbl ='';//variable that holds the content of the table and will display after
   //header of the report, initialize content to tbl
   $tbl.='
    
    <table  width ="100%">
      <tr>
        <td width ="10%">Office/Department</td>
        <td width ="30%">: '.$_POST['function'].'</td>
        <td></td>
        <td align="right" width ="30%">For the Quarter Ending</td>
        <td width ="10%">:'.$quarter_ending.'</td>
      </tr>
      <tr>
        <td>Program</td>
        <td>: _____________________________________________</td>
        <td align="center"><b>'.$quarter_description.' QUARTER ALLOTMENT</b></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Fund</td>
        <td>: _____________________________________________</td>
        <td></td>
        <td align="right"><b><i>Advice No. </i></b></td>
        <td>:________</td>
      </tr>
    </table>
      
    <table>
      <tr><td></td></tr>
    </table>';

    ///-----------------------------
    $tbl.='
    <table  border="1" width ="100%" style="margin-right: 3px" > 
      <thead>
        <tr align="center">
          <th width ="10%"><b>Appropriated <br>Odinance No.</b></th>
          <th width ="30%"><b>EXPENSE CLASS</b></th>
          <th width ="10%"><b>APROPRIATION</b></th>
          <th width ="10%"><b>RESERVED</b></th>
          <th width ="10%"><b>PREVIOUS <br>ALLOTMENT</b></th>
          <th width ="10%"><b>CURRENT <br>ALLOTMENT</b></th>
          <th width ="10%"><b>TOTAL<br/>ALLOTMENT</b></th>
          <th width ="10%"><b>BALANCE OF<br>APPROPRIATION</b></th>
        </tr>
      </thead>
      
      <tbody>';

      $gt_appropriation=0;
      $gt_reserved_allotment=0;
      $gt_previous_allotment=0;
      $gt_current_allotment=0;
      $gt_total_allotment=0;
      $gt_balance_allotment=0;

if($_POST['type']=="OFFICE"){
    $sql2 = mysqli_query($connection, "SELECT * FROM tbl_acc_category");
}else if($_POST['type']=="HOSPITAL"){
    $sql2 = mysqli_query($connection, "SELECT * FROM tbl_acc_category WHERE cat_acronym!='CO' ");
}else{
    $sql2 = mysqli_query($connection, "SELECT * FROM tbl_acc_category");
}

while($rowCategory=mysqli_fetch_array($sql2))
{

  
  $tbl.='
     
        <tr style="margin-left: 3px;font-size:14 px; font-family: "Times New Roman", Times, serif;"> 
          
          <td width ="100%" align="left" colspan="8"><b>&nbsp;&nbsp; '.$rowCategory["category"].'</b></td>
          
        </tr>';
        $sql_allotment=mysqli_query($connection,"SELECT                                              al.allotment_id, al.total_allotment, al.first_qtr, al.second_qtr, al.third_qtr,al.fourth_qtr, acc.acc_category, acc.account_description, al.account_code,
                             (SELECT app.amount_appropriation FROM tbl_appropriation as app WHERE app.appropriation_id=al.appropriation_id)as appropriation 
                             FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON acc.account_code=al.account_code WHERE al.budget_year='".$_POST['budget_year']."' AND al.function_code='".$_POST['function_code']."' AND acc.acc_category='".$rowCategory['category']."';");
        $reserved_allotment=0;
        $previous_allotment=0;
        $current_allotment=0;
        $total_allotment=0;
        $balance_allotment=0;

        $t_appropriation=0;
        $t_reserved_allotment=0;
        $t_previous_allotment=0;
        $t_current_allotment=0;
        $t_total_allotment=0;
        $t_balance_allotment=0;
        while($rowAllotment=mysqli_fetch_array($sql_allotment))
        {
          if($rowAllotment['acc_category']=="MAINTENANCE AND OTHER OPERATING EXPENSES"){
            $reserved_allotment=$rowAllotment['appropriation']*0.15;
          }

          if($curQuarter==1){
            $previous_allotment=0;
            $current_allotment=$rowAllotment['first_qtr'];
            $total_allotment=$previous_allotment+$current_allotment;
            $balance_allotment=$rowAllotment['appropriation']-$total_allotment;

            
          }
          else if($curQuarter==2){
            $previous_allotment=$rowAllotment['first_qtr'];
            $current_allotment=$rowAllotment['second_qtr'];
            $total_allotment=$previous_allotment+$current_allotment;
            $balance_allotment=$rowAllotment['appropriation']-$total_allotment;
          }
          else if($curQuarter==3){
            $previous_allotment=$rowAllotment['first_qtr']+$rowAllotment['second_qtr'];
            $current_allotment=$rowAllotment['third_qtr'];
            $total_allotment=$previous_allotment+$current_allotment;
            $balance_allotment=$rowAllotment['appropriation']-$total_allotment;
          }
          else if($curQuarter==4){
            $previous_allotment=$rowAllotment['first_qtr']+$rowAllotment['second_qtr']+$rowAllotment['third_qtr'];
            $current_allotment=$rowAllotment['fourth_qtr'];
            $total_allotment=$previous_allotment+$current_allotment;
            $balance_allotment=$rowAllotment['appropriation']-$total_allotment;
          }

          $t_appropriation+=$rowAllotment['appropriation'];
          $t_reserved_allotment+=$reserved_allotment;
          $t_previous_allotment+=$previous_allotment;
          $t_current_allotment+=$current_allotment;
          $t_total_allotment+=$total_allotment;
          $t_balance_allotment+=$balance_allotment;

          $gt_appropriation+=$rowAllotment['appropriation'];
          $gt_reserved_allotment+=$reserved_allotment;
          $gt_previous_allotment+=$previous_allotment;
          $gt_current_allotment+=$current_allotment;
          $gt_total_allotment+=$total_allotment;
          $gt_balance_allotment+=$balance_allotment;


          $tbl.='
          <tr> 
            <td width ="10%" align="right">'.$rowAllotment['account_code'].'</td>
            <td width ="30%" align="left">&nbsp;&nbsp;&nbsp;&nbsp; '.$rowAllotment['account_description'].'</td>
            <td width ="10%" align="right">'.number_format($rowAllotment['appropriation'],2).'</td>
            <td width ="10%" align="right">'.number_format($reserved_allotment,2).'</td>
            <td width ="10%" align="right">'.number_format($previous_allotment,2).'</td>
            <td width ="10%" align="right">'.number_format($current_allotment,2).'</td>
            <td width ="10%" align="right">'.number_format($total_allotment,2).'</td>
            <td width ="10%" align="right">'.number_format($balance_allotment,2).'</td>
          </tr>';
        }
        $tbl.='
        <tr style="margin-left: 3px;font-size:12 px; font-family: "Times New Roman", Times, serif;"> 
          
          <td width ="40%" align="right" colspan="2"><b>&nbsp;&nbsp; TOTAL '.$rowCategory['category'].'</b></td>
          <td width ="10%" align="right">'.number_format($t_appropriation,2).'</td>
          <td width ="10%" align="right">'.number_format($t_reserved_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($t_previous_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($t_current_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($t_total_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($t_balance_allotment,2).'</td>
        </tr>';
         
      
}
$tbl.='
        <tr style="margin-left: 3px;font-size:12 px; font-family: "Times New Roman", Times, serif;"> 
          
          <td width ="40%" align="right" colspan="2"><b>&ensp; GRAND TOTAL: </b></td>
          <td width ="10%" align="right">'.number_format($gt_appropriation,2).'</td>
          <td width ="10%" align="right">'.number_format($gt_reserved_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($gt_previous_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($gt_current_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($gt_total_allotment,2).'</td>
          <td width ="10%" align="right">'.number_format($gt_balance_allotment,2).'</td>
        </tr>';
$tbl.='
</tbody>
    </table> 
    <table>
      <tr><td></td></tr>
    </table>';



$pdf->lastPage();
$pdf->Ln(-3.95);

$pdf->writeHTML($tbl, true, false, false, false, '');

//header of the report, initialize content to tbl

$savename = "ADVICE_ALLOTMENT.pdf";
$pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+