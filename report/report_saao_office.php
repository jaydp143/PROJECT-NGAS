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
        $this->SetFont('times', 'B', 10);
        $this->Cell(180, 3, 'Republic of the Philippines', 0, 1, 'C');
        $this->SetFont('', 'B', 10);
        $this->Cell(180, 3, 'PROVINCE OF PANGASINAN', 0, 1, 'C');
        $this->SetFont('', 'B', 9);
        $this->Cell(180, 3, 'Lingayen', 0, 1, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell(180, 3, 'PROVINCIAL BUDGET OFFICE', 0, 1, 'C');

        $this->SetFont('times', 'B', 12);
        $this->Cell(180, 7, 'STATUS OF APPROPRIATIONS, ALLOTMENT AND OBLIGATION', 0, 1, 'C');
        $this->SetFont('times', 'B', 12);
        $this->Cell(180, 3, 'OFFICES', 0, 1, 'C');
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
$pdf->SetTitle('SAAO Report');
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
$pdf->SetMargins(15, 60, 15);
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
$pdf->SetMargins(20, 50, 20);
$pdf->SetFont('times', 'N', 9, true);

// add a page
$pdf->AddPage();

// table header for report
$tbl = ''; //variable that holds the content of the table and will display after
//header of the report, initialize content to tbl

$tbl .= '
    <table nobr="true"  border="1" width="100%"   >       
        <thead>
        <tr style=" text-align: center; font-weight: bold; font-size: 10px; ">
            <th width="25%">FUNCTION/PROGRAM/<br>PROJECT/ACTIVITY</th>
            <th width="17%"><br>APPROPRIATIONS </th>
            <th width="13%"><br>ALLOTMENT</th>
            <th width="15%"><br>OBLIGATIONS</th>
            <th width="15%">BALANCE<br> ALLOTMENT</th>
            <th width="15%">BALANCE<br> APPROPRIATION</th>
        </tr>
        </thead>
        <tbody>';
        if($_POST['function_code']=="ALL"){
            $query="SELECT f.description, 
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='PERSONAL SERVICES')AS appropriation_ps, 
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS appropriation_mooe,
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='CAPITAL OUTLAY')AS appropriation_co, 
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='PERSONAL SERVICES')AS allotment_ps,
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS allotment_mooe,
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='CAPITAL OUTLAY')AS allotment_co,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='PS')AS obligation_ps,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='MOOE')AS obligation_mooe,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='CO')AS obligation_co
                FROM tbl_function as f WHERE f.type='OFFICE' ORDER BY f.function_code ASC"; 
        }else{
            $query="SELECT f.description, 
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='PERSONAL SERVICES')AS appropriation_ps, 
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS appropriation_mooe,
                (SELECT COALESCE(SUM(app.amount_appropriation), 0)  FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code = acc.account_code WHERE app.function_code=f.function_code AND app.budget_year='".$_POST['budget_year']."' AND acc.acc_category='CAPITAL OUTLAY')AS appropriation_co, 
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='PERSONAL SERVICES')AS allotment_ps,
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='MAINTENANCE AND OTHER OPERATING EXPENSES')AS allotment_mooe,
                (SELECT COALESCE(SUM(al.total_allotment), 0)  FROM tbl_allotment as al INNER JOIN tbl_accounts as acc ON al.account_code = acc.account_code WHERE al.function_code=f.function_code AND al.budget_year='".$_POST['budget_year']."' AND acc.acc_category='CAPITAL OUTLAY')AS allotment_co,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='PS')AS obligation_ps,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='MOOE')AS obligation_mooe,
                (SELECT COALESCE(SUM(ex.amount), 0)  FROM tbl_expenses as ex WHERE ex.function=f.function_code AND YEAR(ex.trans_date)='".$_POST['budget_year']."' AND ex.allotment_class='CO')AS obligation_co
                FROM tbl_function as f WHERE f.function_code='".$_POST['function_code']."'"; 
        }
                   
        $sql=mysqli_query($connection,$query);

        $gt_appropriation=0;
        $gt_allotment=0;
        $gt_obligation=0;
        $gt_bal_appropriation=0;
        $gt_bal_allotment=0;

        while($row=mysqli_fetch_array($sql))
        {
            $bal_appropriation_ps=$row['appropriation_ps']-$row['allotment_ps'];
            $bal_allotment_ps=$row['allotment_ps']-$row['obligation_ps'];
            $bal_appropriation_mooe=$row['appropriation_mooe']-$row['allotment_mooe'];
            $bal_allotment_mooe=$row['allotment_mooe']-$row['obligation_mooe'];
            $bal_appropriation_co=$row['appropriation_co']-$row['allotment_co'];
            $bal_allotment_co=$row['allotment_co']-$row['obligation_co'];

            $t_appropriation=$row['appropriation_ps']+$row['appropriation_mooe']+$row['appropriation_co'];
            $t_allotment=$row['allotment_ps']+$row['allotment_mooe']+$row['allotment_co'];
            $t_obligation=$row['obligation_ps']+$row['obligation_mooe']+$row['obligation_co'];
            $t_bal_appropriation=$bal_appropriation_ps+$bal_appropriation_mooe+$bal_appropriation_co;
            $t_bal_allotment=$bal_allotment_ps+$bal_allotment_mooe+$bal_allotment_co;

            $gt_appropriation+=$row['appropriation_ps']+$row['appropriation_mooe']+$row['appropriation_co'];
            $gt_allotment+=$row['allotment_ps']+$row['allotment_mooe']+$row['allotment_co'];
            $gt_obligation+=$row['obligation_ps']+$row['obligation_mooe']+$row['obligation_co'];
            $gt_bal_appropriation+=$bal_appropriation_ps+$bal_appropriation_mooe+$bal_appropriation_co;
            $gt_bal_allotment+=$bal_allotment_ps+$bal_allotment_mooe+$bal_allotment_co;
            
$tbl .= '
            <tr > 
                <td colspan="6" style="margin-left: 100px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;'.$row['description'].'</b></td>
            </tr>
          
            <tr style="font-size: 9px; text-align: center;"> 
                <td width="25%" >Personal Services</td>
                <td width="17%">'. number_format($row['appropriation_ps'],2).'</td>
                <td width="13%">'. number_format($row['allotment_ps'],2).'</td>
                <td width="15%">'. number_format($row['obligation_ps'],2).'</td>
                <td width="15%">'. number_format($bal_allotment_ps,2).'</td>
                <td width="15%">'. number_format($bal_appropriation_ps,2).'</td>
            </tr>
           
      
            <tr style="font-size: 9px; text-align: center;" > 
                <td width="25%">  Maint. & Other Operating Expenses</td>
                <td width="17%">'. number_format($row['appropriation_mooe'],2).'</td>
                <td width="13%">'. number_format($row['allotment_mooe'],2).'</td>
                <td width="15%">'. number_format($row['obligation_mooe'],2).'</td>
                <td width="15%">'. number_format($bal_allotment_mooe,2).'</td>
                <td width="15%">'. number_format($bal_appropriation_mooe,2).'</td>
            </tr>
      
            <tr style="font-size: 9px; text-align: center;" > 
                <td width="25%">Capital Outlay</td>
                <td width="17%">'. number_format($row['appropriation_co'],2).'</td>
                <td width="13%">'. number_format($row['allotment_co'],2).'</td>
                <td width="15%">'. number_format($row['obligation_co'],2).'</td>
                <td width="15%">'. number_format($bal_allotment_co,2).'</td>
                <td width="15%">'. number_format($bal_appropriation_co,2).'</td>
            </tr>
            
            <tr style="font-size: 9px; text-align: center;" > 
                <td width="25%"><b>TOTAL: </b></td>
                <td width="17%">'. number_format($t_appropriation,2).'</td>
                <td width="13%">'. number_format($t_allotment,2).'</td>
                <td width="15%">'. number_format($t_obligation,2).'</td>
                <td width="15%">'. number_format($t_bal_allotment,2).'</td>
                <td width="15%">'. number_format($t_bal_appropriation,2).'</td>
            </tr>
            
            ';

        } 
        if($_POST['function_code']=="ALL"){
        $tbl .= '  
            <tr style="font-size: 10px; text-align: center;" > 
                <td width="25%"><b>GRAND TOTAL: </b></td>
                <td width="17%">'. number_format($gt_appropriation,2).'</td>
                <td width="13%">'. number_format($gt_allotment,2).'</td>
                <td width="15%">'. number_format($gt_obligation,2).'</td>
                <td width="15%">'. number_format($gt_bal_allotment,2).'</td>
                <td width="15%">'. number_format($gt_bal_appropriation,2).'</td>
            </tr>';
        }

 $tbl .= ' 
        </tbody>
    </table>'; 

$pdf->lastPage();
$pdf->Ln(-3.95);

$pdf->writeHTML($tbl, true, false, false, false, '');










//header of the report, initialize content to tbl


$savename = "SAAOReportOffice.pdf";
$pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+