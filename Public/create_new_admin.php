<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php
if (isset($_POST['submit'])) {

    $required_fields = array("username","password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(!empty($errors)){
        $_SESSION["errors"] = $errors;
        redirect_to("new_admin.php");
    }

	$username = mysql_prep($_POST["username"]);
    $hashed_password = mysql_prep($_POST["password"]);

	$query  = "INSERT INTO admins (";
	$query .= "  username, hashed_password";
	$query .= ") VALUES (";
	$query .= "  '{$username}', '{$hashed_password}'";
	$query .= ")";
	$result = mysqli_query($dbconn, $query);

	if ($result) {
        $_SESSION["message"] = "Admin created";
		redirect_to("menage_admin.php");
	} else {
		 $_SESSION["message"] = "Admin creation failed";
		redirect_to("new_admin.php");
	}
    } else {
    redirect_to("menage_admin.php");
    }
?>


<?php if(isset($dbconn)){mysqli_close($dbconn);} ?>
