<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>

        <form action="new_text.php" method="post">
            <p>Headline:
                <input type="text" name=headline" value=""  >
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $text_number = find_text_by_writer_id($text["id"]);
                    $text_count = mysqli_num_rows($text_number);
                    for($count = 1; $count <= ($text_count + 1); $count++){
                      echo  "<option value=\"{$count}\">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="1"  />Yes
                <input type="radio" name="visible" value="0"  />No
            </p>
            <p>Content:
            <textarea name="textarea" rows="20" cols="85">Write something here</textarea>
            </p>
            <input type="submit" name="submit" value="create text" />
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
