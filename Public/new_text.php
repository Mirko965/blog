<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php find_selected_text(); ?>

<?php
if(!$current_writer){
    redirect_to("main_page.php");
}
?>

<?php

if(isset($_POST["submit"])){

    $required_fields = array("headline","position","visible","content");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("headline" => 200);
    validate_max_lengths($fields_with_max_lengths);

    if(empty($errors)){

    $writer_id = $current_writer["id"];
    $headline = mysql_prep($_POST["headline"]);
    $position = $_POST["position"];
    $visible = $_POST["visible"];
    $content = mysql_prep($_POST["content"]);

    $query  = "INSERT INTO text (";
    $query .= "  writer_id, headline, position, visible, content";
    $query .= ") VALUES (";
    $query .= "  {$writer_id}, '{$headline}', {$position}, {$visible}, '{$content}'";
    $query .= ")";
    $result = mysqli_query($dbconn,$query);

    if($result){
        $_SESSION["message"] = "Text created";
        redirect_to("main_page.php?writer=" . urldecode($current_writer["id"]));
    }else{
        $_SESSION["message"] = "Text creation failed";
    }
  }
}else{

}
?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php echo form_errors($errors) ; ?>

        <form action="new_text.php?writer=<?php echo urldecode($current_writer["id"]); ?>" method="post">
            <p>Headline:
                <input type="text" name="headline" value=""  >
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $text_number = find_text_by_writer_id($current_writer["id"]);
                    $text_count = mysqli_num_rows($text_number);
                    for($count = 1; $count <= ($text_count + 1); $count++){
                      echo  "<option value=\"{$count}\">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="1" checked  />Yes
                <input type="radio" name="visible" value="0"  />No
            </p>
            <p>Content:<br />
            <textarea name="content" rows="20" cols="80"></textarea>
            </p>
            <input type="submit" name="submit" value=" new text" />
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


