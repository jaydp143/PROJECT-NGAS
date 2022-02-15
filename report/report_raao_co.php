<?php

// Include the main TCPDF library (search for installation path).
require('../tcpdf/tcpdf.php');
require("../pages/database.php");
require("../pages/season.php");
 
// Extend the TCPDF class to create custom Header and Footer

$queryaccounts="SELECT app.amount_appropriation, acc.account_code, acc.account_description FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
$sqlaccounts=mysqli_query($connection,$queryaccounts);
$total_accounts=mysqli_num_rows($sqlaccounts);
$size_add_l=$total_accounts*30;
$size_add_w=$total_accounts*8;

class MYPDF extends TCPDF
{
    //Page header
    public function Header()
    {
        require("../pages/season.php"); 
        require("../pages/database.php");
        $l=330;
        $w=216;
        $queryaccounts="SELECT app.amount_appropriation, acc.account_code, acc.account_description FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
        $sqlaccounts=mysqli_query($connection,$queryaccounts);
        $total_accounts=mysqli_num_rows($sqlaccounts);
        $length=($total_accounts*26)+$l;
        $width=($total_accounts*17)+$w;
        switch($_POST['month']){
        case 1:
            $month="JANUARY";
            break;
        case 2:
            $month="FEBRUARY";
            break;
        case 3:
            $month="MARCH";
            break;
        case 4:
            $month="APRIL";
            break;
        case 5:
            $month="MAY";
            break;
        case 6:
            $month="JUNE";
            break;
        case 7:
            $month="JULY";
            break;
        case 8:
            $month="AUGUST";
            break;
        case 9:
            $month="SEPTEMBER";
            break;
        case 10:
            $month="OCTOBER";
            break;
        case 11:
            $month="NOVEMBER";
            break;
        case 12:
            $month="DECEMBER";
            break;
        default:
          $month="";
        }

        $this->SetFont('times', 'I', 8);
        $this->Cell(($length-30), 5, 'Appendix 21', 0, 1, 'R');

        $this->SetFont('times', 'B', 12);
        $this->Cell($length, 1, 'REGISTRY OF APPROPRIATIONS ALLOTMENT AND', 0, 1, 'C');
        $this->SetFont('times', 'B', 12);
        $this->Cell($length, 1, ' OBLIGATIONS-CAPITAL OUTLAY(CO)', 0, 1, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell($length, 1, 'Province of Pangasinan', 0, 1, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell($length, 3, 'For the Month of '.$month.' '.$_POST['budget_year'], 0, 1, 'C');
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
$l=330;
$w=216;
$queryaccounts="SELECT app.amount_appropriation, acc.account_code, acc.account_description FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
$sqlaccounts=mysqli_query($connection,$queryaccounts);
$total_accounts=mysqli_num_rows($sqlaccounts);
$length=($total_accounts*26)+$l;
$width=($total_accounts*17)+$w;

$pdf = new MYPDF('L', 'mm', array($width,$length), true, 'UTF-8', false);
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


$pdf->SetHeaderMargin(10);
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
$pdf->SetMargins(15,50,15);
$pdf->SetFont('times', 'N', 9, true);

// add a page
$pdf->AddPage();

$tbl ='';//variable that holds the content of the table and will display after
//===============================================================


$querytotal_appropriation="SELECT SUM(app.amount_appropriation) AS amount FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
$sqltotal_appropriation=mysqli_query($connection,$querytotal_appropriation);
$row=mysqli_fetch_assoc($sqltotal_appropriation);
$total_appropriation=$row['amount'];


$querytotal_allotment="SELECT SUM(app.total_allotment) AS amount FROM tbl_allotment as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
$sqltotal_allotment=mysqli_query($connection,$querytotal_allotment);
$row=mysqli_fetch_assoc($sqltotal_allotment);
$total_allotment=$row['amount'];

$queryfunction="SELECT *FROM tbl_function as f WHERE f.function_code='".$_POST['function']."'";
$sqlfunction=mysqli_query($connection,$queryfunction);
$row=mysqli_fetch_assoc($sqlfunction);
$function_description=$row['description'];

$tbl.='
  <table style="margin-right: 5px;"> 
  <tr>
    <td style="text-align:left;">FUND:_______________________</td>
  </tr>

  <tr>
    <td style="text-align:left;">FUNCTION/PROGRAM/PROJECT: <b>'.$_POST['function'].'-'.$function_description.'</b></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  </table>
';

$tbl.='
  <table  border="1" style="margin-right: 3px;" > 
    <thead>
      <tr align="center">
        <th  style="text-align:center; width:150px">AMOUNT OF<br>APPROPRIATION</th>
       <th  style="text-align:center; width:150px">AMOUNT OF<br>ALLOTMENT</th>
        <th  style="text-align:center; width:100px">DATE</th>
        <th  style="text-align:center; width:100px">REFERENCE/<br>CAFOA No. </th>
        <th  style="text-align:center; width:450px">PARTICULARS</th>
        <th  style="text-align:center; width:100px">TOTAL AMOUNT <br> OF ALLOTMENT/<br>OBLIGATION</th>';
        while($rowAccounts = mysqli_fetch_array($sqlaccounts)){ 
          $tbl.='<th  style="text-align:center; width:100px">'.$rowAccounts['account_code'].'<br>'.$rowAccounts['account_description'].'</th>';
        }

        // $query = mysqli_query($connection,"SELECT account_code,(SELECT account_description FROM tbl_accounts as acc WHERE acc.account_code=app.account_code) as account_description FROM tbl_appropriation as app WHERE app.function_code='".$_POST['function']."' ORDER BY app.account_code  ASC ;");
        // while($row = mysqli_fetch_array($query)){       
        //     $tbl.='<th>'.$row['account_code'].'-'.$row['account_description'].'</th>';
        // }
$tbl.='      
      </tr>';
//================================================================
$tbl.=' 
    </thead>
    <tbody>

      <tr>
        <td style="text-align:left; width:'.(1050+($total_accounts*100)).'px">A. Budget</td>
      </tr>

      <tr>
        <td  style="text-align:center; width:150px"><b>'.number_format($total_appropriation,2).'</b></td>
        <td  style="text-align:center; width:150px"><i>Appropriation Balance>></i></td>
        <td  style="text-align:center; width:100px">'.number_format($total_appropriation-$total_allotment,2).'</td>
        <td  style="text-align:center; width:100px"></td>
        <td  style="text-align:center; width:450px"></td>
        <td  style="text-align:center; width:100px"></td>';
        $sqlaccounts1=mysqli_query($connection,$queryaccounts);
        while($rowAccounts1 = mysqli_fetch_array($sqlaccounts1)){ 
          $tbl.='<td  style="text-align:right; width:100px">'.number_format($rowAccounts1['amount_appropriation'],2).'</td>';
        }
      $tbl.='</tr>';

      $tbl.='<tr>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:right; width:150px"><b>'.number_format($total_allotment,2).'</b></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:450px"></td>
        <td style="text-align:center; width:100px"></td>'; 
        $queryallotment="SELECT app.total_allotment, acc.account_code, acc.account_description FROM tbl_allotment as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'";
        $sqlallotment=mysqli_query($connection,$queryallotment);
        while($rowallotment = mysqli_fetch_array($sqlallotment)){ 
          $tbl.='<td  style="text-align:right; width:100px">'.number_format($rowallotment['total_allotment'],2).'</td>';
        }
      $tbl.='</tr>';
      

       $tbl.='<tr>
        <td style="text-align:left; width:'.(1050+($total_accounts*100)).'px">B. Actual</td>
      </tr>';


$query = mysqli_query($connection,"SELECT * FROM tbl_obligation WHERE function='".$_POST['function']."' AND MONTH(trans_date)='".$_POST['month']."' AND YEAR(trans_date)='".$_POST['budget_year']."' AND allotment_class='CO'");
while($row = mysqli_fetch_array($query)){      
                                    
$tbl.=' 
      <tr>
        <td style="text-align:center; width:150px" ></td>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:100px" >'.$row['trans_date'].'</td>
        <td style="text-align:center; width:100px">'.$row['obr_number'].'</td>
        <td style="text-align:left; width:450px">'.$row['payee']."-".$row['request'].'-'.$row['pr_number'].'</td>
        <td style="text-align:right; width:100px">'.number_format($row['total'],2).'</td>';
        $query1 = mysqli_query($connection,"SELECT (SELECT COALESCE(SUM(exp.amount), 0) AS amount1 FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND exp.obligation_id='".$row['obligation_id']."' AND MONTH(exp.trans_date)='".$_POST['month']."'AND YEAR(exp.trans_date)='".$_POST['budget_year']."') as amount FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'");
        while($row1 = mysqli_fetch_array($query1)){    
          $amount="";
          if($row1['amount']!=null)  {
            $amount=number_format($row1['amount'],2);
          } 
          $tbl.='<td style="text-align:right; width:100px">'.$amount.'</td>'; 
        }
                                        

$tbl.=' </tr>';
}     
$tbl.=' 
      <tr>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:right; width:450px"><b>Total This Month:</b></td>';
        $query_this_month = "SELECT COALESCE(SUM(total), 0) AS amount FROM tbl_obligation WHERE function='".$_POST['function']."' AND MONTH(trans_date)='".$_POST['month']."' AND YEAR(trans_date)='".$_POST['budget_year']."' AND allotment_class='CO'";
        $sql_this_month=mysqli_query($connection,$query_this_month);
        $this_month = mysqli_fetch_array($sql_this_month);
          $tbl.='<td  style="text-align:right; width:100px"><b>'.number_format($this_month['amount'],2).'</b></td>';
        

        $query1 = mysqli_query($connection,"SELECT (SELECT COALESCE(SUM(exp.amount), 0) AS amount FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND MONTH(exp.trans_date)='".$_POST['month']."'AND YEAR(exp.trans_date)='".$_POST['budget_year']."'AND exp.function='".$_POST['function']."' ) as amount FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'");
        while($row1 = mysqli_fetch_array($query1)){       
          $tbl.='<td style="text-align:right; width:100px">'.number_format($row1['amount'],2).'</td>'; 
        }
$tbl.=' </tr>';

      $tbl.='<tr>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:right; width:450px"><b>Total Last Month:</b></td>';
         $query_last_month = "SELECT COALESCE(SUM(total), 0) AS amount FROM tbl_obligation WHERE function='".$_POST['function']."' AND MONTH(trans_date) BETWEEN '1' AND '".($_POST['month']-1)."' AND YEAR(trans_date)='".$_POST['budget_year']."' AND allotment_class='CO'";
        $sql_last_month=mysqli_query($connection,$query_last_month);
        $last_month = mysqli_fetch_array($sql_last_month);
          $tbl.='<td  style="text-align:right; width:100px"><b>'.number_format($last_month['amount'],2).'</b></td>';
        

        $query1 = mysqli_query($connection,"SELECT (SELECT COALESCE(SUM(exp.amount), 0) AS amount FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND MONTH(trans_date) BETWEEN '1' AND '".($_POST['month']-1)."' AND YEAR(exp.trans_date)='".$_POST['budget_year']."'AND exp.function='".$_POST['function']."' ) as amount FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'");
        while($row1 = mysqli_fetch_array($query1)){       
          $tbl.='<td style="text-align:right; width:100px">'.number_format($row1['amount'],2).'</td>'; 
        }
$tbl.=' </tr>

      <tr>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:right; width:450px"><b>Total To Date:</b></td>';
        $query_total_to_date = "SELECT COALESCE(SUM(total), 0) AS amount FROM tbl_obligation WHERE function='".$_POST['function']."' AND MONTH(trans_date) BETWEEN '1' AND '".$_POST['month']."' AND YEAR(trans_date)='".$_POST['budget_year']."' AND allotment_class='CO'";
        $sql_total_to_date=mysqli_query($connection,$query_total_to_date);
        $total_to_date = mysqli_fetch_array($sql_total_to_date);
          $tbl.='<td  style="text-align:right; width:100px"><b>'.number_format($total_to_date['amount'],2).'</b></td>';
        
        $query1 = mysqli_query($connection,"SELECT (SELECT COALESCE(SUM(exp.amount), 0) AS amount FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND MONTH(trans_date) BETWEEN '1' AND '".$_POST['month']."' AND YEAR(exp.trans_date)='".$_POST['budget_year']."'AND exp.function='".$_POST['function']."' ) as amount FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'");
        while($row1 = mysqli_fetch_array($query1)){       
          $tbl.='<td style="text-align:right; width:100px">'.number_format($row1['amount'],2).'</td>'; 
        }
$tbl.='</tr>

      <tr>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:150px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:center; width:100px"></td>
        <td style="text-align:right; width:450px"><b>Balance Total To Date:</b></td>';
        
          $tbl.='<td  style="text-align:right; width:100px"><b>'.number_format($total_appropriation-$total_to_date['amount'],2).'</b></td>';
        

        $query1 = mysqli_query($connection,"SELECT app.account_code,app.amount_appropriation,
(SELECT COALESCE(SUM(exp.amount), 0) AS amount FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND MONTH(trans_date) BETWEEN '1' AND '11' AND YEAR(exp.trans_date)='".$_POST['budget_year']."'AND exp.function='".$_POST['function']."' ) as amount,
(app.amount_appropriation-(SELECT COALESCE(SUM(exp.amount), 0) AS amount FROM tbl_expenses as exp WHERE exp.expense_code=app.account_code AND MONTH(trans_date) BETWEEN '1' AND '11' AND YEAR(exp.trans_date)='".$_POST['budget_year']."'AND exp.function='".$_POST['function']."' )) as balance FROM tbl_appropriation as app INNER JOIN tbl_accounts as acc ON app.account_code=acc.account_code WHERE acc.acc_category='CAPITAL OUTLAY'  AND app.budget_year='".$_POST['budget_year']."' AND app.function_code='".$_POST['function']."'");
        while($row1 = mysqli_fetch_array($query1)){       
          $tbl.='<td style="text-align:right; width:100px">'.number_format($row1['balance'],2).'</td>'; 
        }
  $tbl.='</tr>

    </tbody>

  </table> ';




$pdf->lastPage();
$pdf->Ln(-3.95);

$pdf->writeHTML($tbl, true, false, false, false, '');

//header of the report, initialize content to tbl

$savename = "RAAO_CO.pdf";
$pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+