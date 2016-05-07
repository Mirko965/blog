<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php find_selected_text(); ?>
<?php include("../include/layout/header.php"); ?>
<?php
if(!$current_writer){
    redirect_to("main_page.php");
}
?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>

        <h2>Edit writer:<?php echo $current_writer["writer_name"];?></h2>
        <form action="create_new_writer.php" method="post">
            <p>Writer name:
                <input type="text" name="writer_name" value="<?php echo $current_writer["writer_name"]?>">
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $writer_number = find_all_writer();
                    $writer_count = mysqli_num_rows($writer_number);
                    for($count = 1; $count <= $writer_count; $count++){
                      echo  "<option value=\"{$count}\"";
                        if($current_writer["position"] == $count){
                           echo  "selected";
                        }
                      echo  ">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="1" <?php if($current_writer["visible"] == 1){ echo "checked";} ?>  />Yes
                <input type="radio" name="visible" value="0" <?php if($current_writer["visible"] == 0){ echo "checked";} ?> />No
            </p>
            <input type="submit" name="submit" value="edit writer" />
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
