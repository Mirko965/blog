<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
if(isset($_GET["writer"])){
  $selected_writer_id = $_GET["writer"];
  $selected_text_id = null;
} elseif(isset($_GET["text"])) {
  $selected_text_id = $_GET["text"];
  $selected_writer_id = null;
} else {
  $selected_text_id = null;
  $selected_writer_id = null;
}
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
        <h2>Menage Content</h2>
        <div class="writer_headline"><?php echo $selected_writer_id; ?></div>
        <div class="text_headline"><?php echo $selected_text_id; ?></div>
      </section>
      <aside>
        <nav>
          <ul class="writer">
            <?php
              $result = find_all_writer();
             ?>
              <?php
              while($writer = mysqli_fetch_assoc($result)){
              ?>
              <?php
                echo "<li";
                if($writer["id"] == $selected_writer_id){
                echo " class=\"selected\"";
                }
                echo ">";
              ?>
              <a href="main_content.php?writer=<?php echo $writer["id"]; ?>">
              <?php echo $writer["writer_name"] ?></a>
                <ul class="text">
                  <?php
                   $result_text = find_text_for_writer($writer["id"])
                  ?>
                  <?php
                  while($text = mysqli_fetch_assoc($result_text)){
                  ?>
                   <?php
                      echo "<li";
                      if($text["id"] == $selected_text_id){
                      echo " class=\"selected\"";
                      }
                      echo ">";
                   ?>
                    <a href="main_content.php?text=<?php echo $text["id"] ?>">
                    <?php echo $text["headline"] ?></a>
                   </li>
                   <?php
                    }
                   ?>
                   <?php
                   mysqli_free_result($result_text);
                   ?>
                </ul>
              </li>
            <?php
            }
            ?>
            <?php
            mysqli_free_result($result);
            ?>
          </ul>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
