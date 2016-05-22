<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>

        <form action="create_new_writer.php" method="post">
            <p>Writer name:
                <input type="text" name="writer_name" value=""  >
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $writer_number = find_all_writer();
                    $writer_count = mysqli_num_rows($writer_number);
                    for($count = 1; $count <= ($writer_count + 1); $count++){
                      echo  "<option value=\"{$count}\">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="1"  />Yes
                <input type="radio" name="visible" value="0"  />No
            </p>
            <input type="submit" name="submit" value="create new writer" />
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
