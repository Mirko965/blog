<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php
if (isset($_POST['submit'])) {

    $required_fields = array("writer_name","position","visible");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("writer_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(!empty($errors)){
        $_SESSION["errors"] = $errors;
        redirect_to("new_writer.php");
    }

	$writer_name = mysql_prep($_POST["writer_name"]);
	$position = (int) $_POST["position"];
	$visible = (int) $_POST["visible"];

	$query  = "INSERT INTO writer (";
	$query .= "  writer_name, position, visible";
	$query .= ") VALUES (";
	$query .= "  '{$writer_name}', {$position}, {$visible}";
	$query .= ")";
	$result = mysqli_query($dbconn, $query);

	if ($result) {
        $_SESSION["message"] = "Writer created";
		redirect_to("main_page.php");
	} else {
		 $_SESSION["message"] = "Writer creation failed";
		redirect_to("new_writer.php");
	}
    } else {
    redirect_to("new_writer.php");
    }
?>


<?php if(isset($dbconn)){mysqli_close($dbconn);} ?>
