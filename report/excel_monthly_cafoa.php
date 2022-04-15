<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

   require("../pages/database.php");

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
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>00/00/0000</u></td>";
}
// selected in function combobox
else if (($_GET['yr'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>".$functiondetail."</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/dd/yyyy</u></td>";
}
// selected in year combobox
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/dd/".$_GET['yr']."</u></td>";
}
// selected in month combobox
else if (($_GET['fc'] == "ALL") && ($_GET['yr'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>".$month."/dd/yyyy</u></td>";
}
// selected in day combobox
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL") && ($_GET['yr'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/".$_GET['dy']."/yyyy</u></td>";
}
//selected function && year
else if (($_GET['mn'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>" . $functiondetail . "</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/dd/".$_GET['yr']."</u></td>";
    
}
//selected function && month
else if (($_GET['yr'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>" . $functiondetail . "</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>".$month."/dd/yyyy</u></td>";
}
//selected function && day
else if (($_GET['yr'] == "ALL") && ($_GET['mn'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>" . $functiondetail . "</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/".$_GET['dy']."/yyyy</u></td>";
}
//selected year && month
else if (($_GET['fc'] == "ALL") && ($_GET['dy'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . " ".$_GET['yr']."</u></td>";
}
//selected year && day
else if (($_GET['fc'] == "ALL") && ($_GET['mn'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>dd/" . $_GET['dy'] . "/".$_GET['yr']."</u></td>";
}
//selected  month && day
else if (($_GET['fc'] == "ALL") && ($_GET['yr'] == "ALL")) {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND DAY(trans_date)='" . $_GET['dy'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . "/".$_GET['dy']."/yyyy</u></td>";
}
//selected function,year,month
else if ($_GET['dy'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE MONTH(trans_date)='" . $_GET['mn'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>".$functiondetail."</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . " ".$_GET['yr']."</u></td>";
}

//selected function, year,day
else if ($_GET['mn'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>".$functiondetail."</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>mm/" . $_GET['dy'] . "/".$_GET['yr']."</u></td>";
}

//selected function,month,day 
else if ($_GET['yr'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>".$functiondetail."</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . "/".$_GET['dy']."/yyyy</u></td>";
}

//selected year, month, day
else if ($_GET['fc'] == "ALL") {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation WHERE DAY(trans_date)='" . $_GET['dy'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "' AND YEAR(trans_date)='" . $_GET['yr'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>ALL</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . "/".$_GET['dy']."/".$_GET['yr']."</u></td>";
} else {
    $query = "SELECT obligation_id, total, trans_date, obr_number, allotment_class, function, payee, pr_number, pr_date, request, reference_number from tbl_obligation  WHERE YEAR(trans_date)='" . $_GET['yr'] . "' AND MONTH(trans_date)='" . $_GET['mn'] . "'AND DAY(trans_date)='" . $_GET['dy'] . "' AND function='" . $_GET['fc'] . "' ORDER BY trans_date, obr_number ASC ";
    $title = "<td colspan='6' align='left'><b>OFFICES/HOSPITALS:</b><u>".$functiondetail."</u></td>
    <td colspan='5' align='right'><b>PERIOD:</b><u>" . $month . "/".$_GET['dy']."/".$_GET['yr']."</u></td>";
}
	
	$output = "";
	
	
	// $query = $conn->query("SELECT * FROM `student`") or die(mysqli_errno());
	// while($fetch = $query->fetch_array()){
		
	$output .= '
	<table border="0"  width="100%" style="margin-left: 3px;font-size:12 px; font-family: "Times New Roman", Times, serif;" >
    <tr><td colspan="11" align="center"><h4>REPUBLIC OF THE PHILIPPINES</h4></td></tr>
    <tr><td colspan="11" align="center">PROVINCE OF PANGASINAN</td></tr>
    <tr><td colspan="11" align="center">Lingayen</td></tr>
    <tr><td colspan="11" align="center"><h4>PROVINCIAL BUDGET OFFICE</h4></td></tr>
    <tr><td colspan="11" align="center"></td></tr>
    <tr>
    '.$title.'
    </tr>
    </table>
	';
	// }
	
	$output .= '
    <table border="1" width="100%" style="margin-left: 3px; font-family: "Times New Roman", Times, serif; font-size: 10px" >
       <thead>
        <tr   align="center" >
            <th  rowspan="2"><b><br>DATE</b></th>
            <th rowspan="2"><b><br>CAFOA NO.</b></th>
            <th  rowspan="2"><b><br>PPC</b></th>
            <th  rowspan="2"><b><br>PAYEE</b></th>
            <th rowspan="2"><b><br>PR#/RIS#</b></th>
            <th  rowspan="2"><b><br>PR#/RIS# DATE</b></th>
            <th  rowspan="2"><b><br>PARTICULARS</b></th>
            <th  colspan="3"><b><br>ALLOTMENT CLASS<br></b></th>
            <th rowspan="2"><b><br>REF NO.</b></th>
        </tr>
        <tr   align="center">
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

   $output .= '
                <tr  > 
                <td   >' . date_format($date, 'm-d-y') . '</td>
                <td   >' . $row['obr_number'] . '</td>
                <td   >' . $row['function'] . '</td>
                <td  align="left"  >' . $row['payee'] . '</td>
                <td   >' . $row['pr_number'] . '</td>
                <td   >' . $pr_date . '</td>
                <td  align="left" >' . $row['request'] . '</td>
                <td   >' . $total_amount_ps . '</td>
                <td   >' . $total_amount_mooe . '</td>
                <td   >' . $total_amount_co . '</td>
                <td   >' . $row['reference_number'] . '</td>
            </tr>';
}

$output .= '
    </tbody>
</table> ';
	
	echo $output;
	
	
?>