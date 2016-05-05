<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php
if (isset($_POST['submit'])) {
   	$writer_name = $_POST['writer_name'];
	$position =  $_POST['position'];
	$visible =  $_POST['visible'];

	$writer_name = mysqli_real_escape_string($db_connection, $writer_name);

	$query  = "INSERT INTO writer (";
	$query .= "  writer_name, position, visible";
	$query .= ") VALUES (";
	$query .= "  '{$writer_name}', {$position}, {$visible}";
	$query .= ")";

	$result = mysqli_query($db_connection, $query);

	if ($result) {
		redirect_to("main_page.php");
        $message = "Writer created";
	} else {
		 $message = "Writer creation failed";
		die("Database query failed. " . mysqli_error($db_connection));
	}
} else {
    redirect_to("new_writer.php");
    }
?>


<?php if(isset($dbconn)){mysqli_close($dbconn);} ?>
