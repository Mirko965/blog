<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php find_selected_text(); ?>

<?php
if(!$current_text){
    redirect_to("main_page.php");
}
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form

  $id = $current_text["id"];
  $headline = mysql_prep($_POST["headline"]);
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];
  $content = mysql_prep($_POST["content"]);

  // validations
  $required_fields = array("headline", "position", "visible", "content");
  validate_presences($required_fields);

  $fields_with_max_lengths = array("headline" => 30);
  validate_max_lengths($fields_with_max_lengths);

  if (empty($errors)) {

    $query  = "UPDATE text SET ";
    $query .= "headline = '{$headline}', ";
    $query .= "position = {$position}, ";
    $query .= "visible = {$visible}, ";
    $query .= "content = '{$content}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($dbconn, $query);

    if ($result && mysqli_affected_rows($dbconn) == 1) {
      // Success
      $_SESSION["message"] = "Page updated.";
      redirect_to("main_page.php?text={$id}");
    } else {
      // Failure
      $_SESSION["message"] = "Page update failed.";
    }

  }
} else {
  // This is probably a GET request

} // end: if (isset($_POST['submit']))

?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php echo form_errors($errors) ; ?>

        <h2>Edit Text:<?php echo $current_text["headline"]; ?></h2>
        <form action="edit_text.php?text=<?php echo urldecode($current_text["id"]); ?>" method="post">
            <p>Headline:
                <input type="text" name="headline" value="<?php echo $current_text["headline"]; ?>"  >
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $text_number = find_text_by_writer_id($current_text["writer_id"]);
                    $text_count = mysqli_num_rows($text_number);
                    for($count = 1; $count <= $text_count ; $count++){
                      echo  "<option value=\"{$count}\"";
                        if($current_text["position"] = $count ){
                            echo "selected";
                        }
                      echo ">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
            <input type="radio" name="visible" value="1" <?php if ($current_text["visible"] == 1){ echo "checked"; }?> />Yes
            <input type="radio" name="visible" value="0" <?php if ($current_text["visible"] == 0){ echo "checked"; }?> />No
            </p>
            <p>Content:<br />
            <textarea name="content" rows="20" cols="80"><?php echo $current_text["content"]; ?></textarea>
            </p>
            <input type="submit" name="submit" value=" edit text" />
        </form>
            <br>
            <p><a href="main_page.php?text=<?php echo urldecode($current_text["id"])?>">Cancel</a>
            <a href="delete_text.php?text=<?php echo $current_text["id"]; ?>">Delete text</a></p>
        </section>
          <aside role="navigation" id="navigation">
            <nav>
            <?php
                echo navigation($current_writer,$current_text)
             ?>
            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
