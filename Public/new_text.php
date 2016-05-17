<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>
<?php find_selected_text(); ?>

<?php
//AKO NEMA OZNACENOG PISCA
if(!$current_writer){
    redirect_to("main_page.php");
}
?>
<?php
if (isset($_POST['submit'])) {
  // Process the form

  // validations
  $required_fields = array("headline", "position","visible", "content");
  validate_presences($required_fields);

  $fields_with_max_lengths = array("headline" => 30);
  validate_max_lengths($fields_with_max_lengths);

//CREATE
if(empty($errors)){
    $writer_id = $current_writer["id"];
    $headline = mysql_prep($_POST["headline"]);
    $position = $_POST["position"];
    $visible = $_POST["visible"];
    $content = mysql_prep($_POST["content"]);

    $query  = "INSERT INTO text(writer_id,headline,position,visible,content) Values ({$writer_id},'{$headline}',{$position},{$visible},'{$content}')";
    $result = mysqli_query($dbconn,$query);

if($result){
    $_SESSION["message"] = "Text created";
}else{
    $_SESSION["message"] = "Text creation failed";
    redirect_to("main_page.php?writer=" . $current_writer["id"]);
}
}
}else{

}

?>

<?php include("../include/layout/header.php"); ?>
    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
            <h2>Create text</h2>
        <form action="new_text.php?writer=<?php echo urlencode($current_writer["id"]); ?>" method="post">
         <p>Headline:
          <input type="text" name="headline" value="" />
         </p>
          <p>Position:
        <select name="position">
        <?php
          $text_set = find_text_by_writer_id($current_writer["id"]);
          $text_count = mysqli_num_rows($text_set);
          for($count=1; $count <= ($text_count + 1); $count++) {
            echo "<option value=\"{$count}\">{$count}</option>";
          }
        ?>
        </select>
      </p>
      <p>Visible:
        <input type="radio" name="visible" value="0" /> No
        &nbsp;
        <input type="radio" name="visible" value="1" checked /> Yes
      </p>
      <p>Content:<br />
        <textarea name="content" rows="20" cols="80"></textarea>
      </p>
      <input type="submit" name="submit" value="Create text" />
    </form>
            <br>
            <p><a href="main_page.php">Cancel</a></p>

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
