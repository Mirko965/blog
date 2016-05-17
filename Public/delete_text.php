<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php
  $current_text = find_text_by_id($_GET["text"]);
  if (!$current_text) {
    // page ID was missing or invalid or
    // page couldn't be found in database
    redirect_to("main_page.php");
  }

  $id = $current_text["id"];
  $query = "DELETE FROM text WHERE id = {$id} LIMIT 1";
  $result = mysqli_query($dbconn, $query);

  if ($result && mysqli_affected_rows($dbconn) == 1) {
    // Success
    $_SESSION["message"] = "Page deleted.";
    redirect_to("main_page.php");
  } else {
    // Failure
    $_SESSION["message"] = "Page deletion failed.";
    redirect_to("main_page.php?text={$id}");
  }

?>
