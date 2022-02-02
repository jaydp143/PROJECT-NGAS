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
        $this->Cell(305, 3, 'Republic of the Philippines', 0, 1, 'C');
        $this->SetFont('', 'B', 12);
        $this->Cell(305, 3, 'PROVINCE OF PANGASINAN', 0, 1, 'C');
        $this->SetFont('', 'B', 9);
        $this->Cell(305, 3, 'Lingayen', 0, 1, 'C');
        $this->SetFont('times', 'B', 12);
        $this->Cell(305, 3, 'PROVINCIAL BUDGET OFFICE', 0, 1, 'C');

        $this->SetFont('times', 'B', 14);
        $this->Cell(305, 15, 'CERTIFICATION ON APPROPRIATIONS, FUND AND OBLIGATION OF ALLOTMENT', 0, 1, 'C');
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
$pdf = new MYPDF('L', 'mm', array(216, 356), true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Monthly Obligation Report');
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

$pdf->SetMargins(15, 50, 15);
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
$pdf->SetMargins(37, 50, 20);
$pdf->SetFont('times', 'N', 9, true);

// add a page
$pdf->AddPage();


switch ($_GET['mn']) {

    case 1:
        $month = "JANUARY";
        break;
    case 2:
        $month = "FEBRUARY";
        break;
    case 3:
        $month = "MARCH";
        break;
    case 4:
        $month = "APRIL";
        break;
    case 5:
        $month = "MAY";
        break;
    case 6:
        $month = "JUNE";
        break;
    case 7:
        $month = "JULY";
        break;
    case 8:
        $month = "AUGUST";
        break;
    case 9:
        $month = "SEPTEMBER";
        break;
    case 10:
        $month = "OCTOBER";
        break;
    case 11:
        $month = "NOVEMBER";
        break;
    case 12:
        $month = "DECEMBER";
        break;
    default:
        $month = "";
}
$functiondetail = "";
$queryFunction = "SELECT description from tbl_function WHERE function_code='" . $_GET['fc'] . "'";
$sqlViewFunction = mysqli_query($connection, $queryFunction);
while ($rowFunction = mysqli_fetch_array($sqlViewFunction)) {
    $functiondetail = $rowFunction['description'];
}


//=======================================================================================================================
//all combo box set to ALL
if (($_GET['yr'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL") && ($_GET['fc'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation ORDER BY trans_date, obr_number ASC ";
    $title = "";
}
// selected in function combobox
else if (($_GET['yr'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = $functiondetail;
}
// selected in year combobox
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $_GET['yr'] . "";
}
// selected in month combobox
else if (($_GET['fc'] == "ALL") && ($_GET['yr'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $month . "";
}
// selected in day combobox
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['yr'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $_GET['dy'] . "";
}
//selected function && year
else if (($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "<br>" . $_GET['yr'];
}
//selected function && month
else if (($_GET['yr'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "<br>" . $month;
}
//selected function && day
else if (($_GET['yr'] == "ALL") && ($_GET['mn'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "-" . $_GET['dy'];
}
//selected year && month
else if (($_GET['fc'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $month . "-" . $_GET['yr'];
}
//selected year && day
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $_GET['yr'] . "-" . $_GET['dy'];
}
//selected  month && day
else if (($_GET['fc'] == "ALL") && ($_GET['yr'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $month . "-" . $_GET['dy'];
}
//selected function,year,month
else if ($_GET['dy'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "<br>" . $month . "-" . $_GET['yr'];
}

//selected function, year,day
else if ($_GET['mn'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "<br>" . $_GET['yr'] . "-" . $_GET['dy'];
}

//selected function,month,day 
else if ($_GET['yr'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $functiondetail . "<br>" . $month . "-" . $_GET['dy'];
}

//selected year, month, day
else if ($_GET['fc'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = " " . $month . " " . $_GET['dy'] . ", " . $_GET['yr'];
} else {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation  WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "'AND DAY(trans_date)='" . $_GET['dy'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "  " . $functiondetail . "<br> " . $month . " " . $_GET['dy'] . ", " . $_GET['yr'];
}




// table header for report
$tbl = ''; //variable that holds the content of the table and will display after
//header of the report, initialize content to tbl
$tbl .= '
    <table border="0" align="center" nobr="true" width="100%" style="margin-left: 3px;font-size:12 px; font-family: "Times New Roman", Times, serif;" >
    <tr>
    <td>' . $title . ' </td>
    </tr>
    </table>';
$tbl .= '
    <table border="1"  nobr="true" width="100%" style="margin-left: 3px; font-family: "Times New Roman", Times, serif; font-size: 10px" >
       <thead>
        <tr nobr="true"  align="center" style="padding-top: 20px">
            <th width="6%" rowspan="2"><b><br>DATE</b></th>
            <th width="5%" rowspan="2"><b><br>CAFOA NO.</b></th>
            <th width="6%" rowspan="2"><b><br>PPC</b></th>
            <th width="20%" rowspan="2"><b><br>PAYEE</b></th>
            <th width="5%" rowspan="2"><b><br>PR#/RIS#</b></th>
            <th width="6%" rowspan="2"><b><br>PR#/RIS# DATE</b></th>
            <th width="28%" rowspan="2"><b><br>PARTICULARS</b></th>
            <th width="22.1%" colspan="3"><b><br>ALLOTMENT CLASS<br></b></th>
            <th width="5%" rowspan="2"><b><br>REF NO.</b></th>
        </tr>
        <tr nobr="true"  align="center">
            <th ><b>PS</b></th>
            <th ><b>MOOE</b></th>
            <th ><b>CO</b></th>
        </tr>
        </thead>
        <tbody>
        ';

// $query="SELECT * from tbl_obligation  WHERE YEAR(trans_date)='".$_GET['yr']."' AND MONTH(trans_date)='".$_GET['mn']."'";
$sql = mysqli_query($connection, $query);
$total_amount_ps = 0;
$total_amount_mooe = 0;
$total_amount_co = 0;
$pr_date = '';
while ($row = mysqli_fetch_array($sql)) {
    $date = date_create($row['trans_date']);
    if ($row['allotment_class'] == 'PS') {
        $total_amount_ps = number_format($row['total'], 2);
    } else {
        $total_amount_ps = " ";
    }
    if ($row['allotment_class'] == 'MOOE') {
        $total_amount_mooe = number_format($row['total'], 2);
    } else {
        $total_amount_mooe = " ";
    }
    if ($row['allotment_class'] == 'CO') {
        $total_amount_co = number_format($row['total'], 2);
    } else {
        $total_amount_co = " ";
    }

    if ($row['pr_number'] == '') {
        $pr_date = "";
    } else {
        $pr_date = $row['pr_date'];
    }

    $tbl .= '
                <tr  nobr="true"> 
                <td  nobr="true" style="width:6%">' . date_format($date, 'm-d-y') . '</td>
                <td  nobr="true" style="width:5%">' . $row['obr_number'] . '</td>
                <td  nobr="true" style="width:6%">' . $row['function'] . '</td>
                <td  align="left" nobr="true" style="width:20%">' . $row['payee'] . '</td>
                <td  nobr="true" style="width:5%">' . $row['pr_number'] . '</td>
                <td  nobr="true" style="width:6%">' . $pr_date . '</td>
                <td  align="left" style="width:28%" nobr="true">' . $row['request'] . '</td>
                <td  nobr="true" style="width:79px">' . $total_amount_ps . '</td>
                <td  nobr="true" style="width:77px">' . $total_amount_mooe . '</td>
                <td  nobr="true" style="width:78px">' . $total_amount_co . '</td>
                <td  nobr="true" style="width:5%">' . $row['reference_number'] . '</td>
            </tr>';
}

$tbl .= '
    </tbody>
</table> ';


$pdf->lastPage();
$pdf->Ln(-3.95);

$pdf->writeHTML($tbl, true, false, false, false, '');










//header of the report, initialize content to tbl


$savename = "MonthlyCAFOAReport.pdf";
$pdf->Output($savename, 'I');
//============================================================+
// END OF FILE
//============================================================+