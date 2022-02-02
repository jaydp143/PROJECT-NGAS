    <?php  
require('./database.php');
require('./session.php');



 $number = count($_POST["expense_code"]);  
 if($number > 0)  
 {  
     $id=$_POST["id"];
     $obr_number=$_POST["obr_number"];
     $trans_date=$_POST['trans_date']; 
     $pr_number=$_POST["pr_number"];
     $pr_date=$_POST["pr_date"];
     $payee=mysqli_real_escape_string($connection, $_POST["payee"]);
    // $office=mysqli_real_escape_string($connection, $_POST["office"]);
     $request=mysqli_real_escape_string($connection, $_POST["request"]);
     $function=mysqli_real_escape_string($connection, $_POST["function"]);
     $allotment_class=mysqli_real_escape_string($connection, $_POST["allotment_class"]);
     $total_amount=0;
     $requesting_officer="XXX";
     $requesting_position="XXX";
     $budget_officer="HILARIA J. CLAVERIA";
     $budget_position="PROVINCIAL BUDGET OFFICER";
     $reference_number=mysqli_real_escape_string($connection, $_POST["reference_number"]);
     $user=$_SESSION['username'];


     
     for($i=0; $i<$number; $i++)  
     { 
       $total_amount+=$_POST["amount"][$i];   
     }



     mysqli_query($connection, "UPDATE tbl_obligation SET obr_number='$obr_number', pr_number='$pr_number', pr_date='$pr_date',  payee='$payee', request='$request', function='$function', allotment_class='$allotment_class', total='$total_amount', requesting_officer='$requesting_officer', requesting_position='$requesting_position', budget_officer='$budget_officer', budget_position='$budget_position', trans_date='$trans_date', reference_number='$reference_number', user='$user' WHERE obligation_id='$id'"); 

     mysqli_query($connection,"DELETE from tbl_expenses WHERE obligation_id='$id'");            

          for($i=0; $i<$number; $i++)  
          {  
               //if(trim($_POST["name"][$i] != ''))  
           //{  
             
                $expense_code=mysqli_real_escape_string($connection, $_POST["expense_code"][$i]);
                $amount=$_POST["amount"][$i];
                $sql = "INSERT INTO tbl_expenses (obligation_id, function, allotment_class, expense_code, amount, trans_date) VALUES('$id','$function', '$allotment_class', '$expense_code', '$amount', '$trans_date')";  
                mysqli_query($connection, $sql);   
           //}  
      }  
       echo "CAFOA SUCCESSFULLY UPDATED";
 }  
     else  
 {  
      echo "Please Enter Name";  
 }  
 ?> 