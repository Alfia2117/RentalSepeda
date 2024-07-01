<?php 
require_once("includes/config.php");
// code user email availablity
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	$emailParts = explode('@', $email);
	$domain = end($emailParts);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false || $domain !== 'student.cuet.ac.bd') {

		echo "ERROR: Enter a Valid Email with domain cuet.ac.bd.";
		
	}
	else {
		$sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<span style='color:red'> Email Already Exists.</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email Available For Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}


?>
