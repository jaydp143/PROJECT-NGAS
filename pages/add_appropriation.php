    <?php  
require('./database.php');
require('./session.php');



 $number = count($_POST["expense_code"]);  
 if($number > 0)  
 {  
     $function=mysqli_real_escape_string($connection, $_POST["function"]);
     $budget_year=$_POST['budget_year'];
     $user=mysqli_real_escape_string($connection, $_SESSION['username']);
     
     //$trans_date=date_create($dateNow); 
      for($i=0; $i<$number; $i++)  
      {  
         $queryAccId="SELECT account_id FROM tbl_accounts WHERE account_code='".$_POST["expense_code"][$i]."'";
         $sqlAccId=mysqli_query($connection,$queryAccId);
         $row=mysqli_fetch_assoc($sqlAccId);
         $account_id=$row['account_id'];
         
         $expense_code=mysqli_real_escape_string($connection, $_POST["expense_code"][$i]);
         $amount=$_POST["amount"][$i];
         $sqlApp = "INSERT INTO `tbl_appropriation` ( `account_code`, `function_code`, `amount_appropriation`, `budget_year`, `user_name`) VALUES('$expense_code','$function', '$amount', '$budget_year', '$user')";  
         mysqli_query($connection, $sqlApp);  

         $queryAppId="SELECT MAX(appropriation_id) AS approp_id FROM tbl_appropriation";
         $sqlAppId=mysqli_query($connection,$queryAppId);
         $row=mysqli_fetch_assoc($sqlAppId);
         $approp_id=$row['approp_id'];

         $sqlApp = "INSERT INTO `tbl_allotment` ( `appropriation_id`, `account_code`, `function_code`, `budget_year`, `first_qtr`, `second_qtr`, `third_qtr`, `fourth_qtr`,`user_name`) VALUES('$approp_id','$expense_code','$function','$budget_year','0','0','0','0', '$user')";  
         mysqli_query($connection, $sqlApp); 
      }  
       echo "SUCCESSFULLY SAVED";
}
    else  
 {  
    echo "Please Enter Name";  
 }  
 ?> 