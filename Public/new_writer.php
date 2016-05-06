<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <form action="create_new_writer.php" method="post">
            <p>Writer name:
                <input type="text" name="writer_name" value="" required >
            </p>
            <p>Position:
                <select name="position" required>
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
                <input type="radio" name="visible" value="1" required />Yes
                <input type="radio" name="visible" value="0" required />No
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
