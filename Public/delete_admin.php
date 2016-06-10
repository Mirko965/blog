<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php
$current_admin = find_admin_by_id($_GET["id"]);
if(!$current_admin){
    redirect_to("menage_admin.php");
}

$id = $current_admin["id"];
$query = "DELETE FROM admins WHERE id = {$id} ";
$result = mysqli_query($dbconn,$query);

if($result && mysqli_affected_rows($dbconn)){
    $_SESSION["message"] = "Admin deleted";
     redirect_to("menage_admin.php");
} else {
    $_SESSION["message"] = "Admin deletion failed";
    redirect_to("menage_admin.php");
}
?>
