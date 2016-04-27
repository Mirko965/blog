<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php find_selected_writer_or_text(); ?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
          <form action="new_writer.php" method="post">
              <p>Writer Name:
                  <input type="text" name="writer_name" value="" />
              </p>
              <p>Position:
                  <select name="position">
                      <?php
                      $position_writer = find_all_writer();
                      $writer_count = mysqli_num_rows($position_writer);
                      for($position = 1; $position <= $writer_count; $position++){
                         echo "<option value=\"{$position}\">{$position}</option>";
                      }
                      ?>
                  </select>
              </p>
              <p>Visible:
                  <input type="radio" name="visible" value="0" />No
                  &nbsp;
                  <input type="radio" name="visible" value="1" />Yes
              </p>
              <input type="submit" name="new writer" />
          </form>
          <a href="main_content.php">Cancel</a>

      </section>
      <aside>
        <nav>
        <?php
         echo navigation($current_writer,$current_text);
        ?>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
