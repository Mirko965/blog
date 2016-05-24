<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php
$current_writer = find_writer_by_id($_GET["writer"],$public=false);
if(!$current_writer){
    redirect_to("main_page.php");
}

$text_set = find_text_by_writer_id($current_writer["id"]);
if(mysqli_num_rows($text_set) > 0){
    $_SESSION["message"] = "Can't delete writer with text!";
    redirect_to("main_page");
}

$id = $current_writer["id"];
$query = "DELETE FROM writer WHERE id = {$id} ";
$result = mysqli_query($dbconn,$query);

if($result && mysqli_affected_rows($dbconn) == 1){
    $_SESSION["message"] = "Writer deleted";
    redirect_to("main_page.php");
} else {
    $_SESSION["message"] = "Writer deletion failed!";
    redirect_to("edit_writer.php?writer={$id}");
}
?>
