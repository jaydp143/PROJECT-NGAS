    <?php  
require('./database.php');
require('./session.php');

$queryCheckObrNumber="SELECT obr_number FROM tbl_obligation WHERE obr_number='".$_POST["obr_number"]."'";
$sqlCheckObrNumber=mysqli_query($connection,$queryCheckObrNumber);
$row=mysqli_fetch_assoc($sqlCheckObrNumber);
 $number = count($_POST["expense_code"]);  
 if(mysqli_num_rows($sqlCheckObrNumber)!=0)  
 {  
    echo "OBLIGATION NUMBER ALREADY EXISTS. NOT SAVED"; 
 }  
if(mysqli_num_rows($sqlCheckObrNumber)==0) {  
       
    $obr_number=$_POST["obr_number"];
     $trans_date=$_POST['trans_date']; 
     $pr_date=$_POST['pr_date']; 
     $pr_number=$_POST["pr_number"];
     $payee=mysqli_real_escape_string($connection, $_POST["payee"]);
     $office="xxx";
     $request=mysqli_real_escape_string($connection, $_POST["request"]);
     $function=mysqli_real_escape_string($connection, $_POST["function"]);
     $allotment_class=mysqli_real_escape_string($connection, $_POST["allotment_class"]);
     $total_amount=0;
     $requesting_officer="XXX";
     $requesting_position="XXX";
     $budget_officer="HILARIA J. CLAVERIA";
     $budget_position="PROVINCIAL BUDGET OFFICER";
     $reference_number="";
     $user=$_SESSION['username'];
     for($i=0; $i<$number; $i++)  
     { 
       $total_amount+=$_POST["amount"][$i];   
     }
     mysqli_query($connection, "INSERT INTO tbl_obligation( obr_number, pr_number, pr_date,  payee, office, request, function, allotment_class, total, requesting_officer, requesting_position, budget_officer, budget_position, trans_date, reference_number, user) VALUES('$obr_number', '$pr_number', '$pr_date', '$payee', '$office', '$request','$function', '$allotment_class', '$total_amount','$requesting_officer', '$requesting_position', '$budget_officer', '$budget_position', '$trans_date','$reference_number', '$user')"); 

     $queryCategory="SELECT MAX(obligation_id) AS ob_id FROM tbl_obligation";
     $sqlCategory=mysqli_query($connection,$queryCategory);
     $row=mysqli_fetch_assoc($sqlCategory);
     $ob_id=$row['ob_id'];
     $trans_date=$_POST['trans_date']; 
      for($i=0; $i<$number; $i++)  
      {  
          $queryAccId="SELECT account_id FROM tbl_accounts WHERE account_code='".$_POST["expense_code"][$i]."'";
          $sqlAccId=mysqli_query($connection,$queryAccId);
          $row=mysqli_fetch_assoc($sqlAccId);
          $account_id=$row['account_id'];
             
          $expense_code=mysqli_real_escape_string($connection, $_POST["expense_code"][$i]);
          $amount=$_POST["amount"][$i];
          $sql = "INSERT INTO tbl_expenses (obligation_id, function, allotment_class, expense_code, amount, trans_date) VALUES('$ob_id','$function', '$allotment_class', '$expense_code', '$amount', '$trans_date')";  
          mysqli_query($connection, $sql);  
           
      }  
       echo "SUCCESSFULLY SAVED";
 }  
 ?> 