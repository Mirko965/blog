<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
if(isset($_GET["writer"])){
    $selected_writer = $_GET["writer"];
    $selected_text = null;
}elseif(isset($_GET["text"])){
    $selected_text = $_GET["text"];
    $selected_writer = null;
}else{
    $selected_writer = null;
    $selected_text = null;
}
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
          <h2>Menage content</h2>
      <?php
          echo $selected_writer;
      ?>
      <?php
          echo $selected_text;
      ?>
      </section>
      <aside>
        <nav>
        <ul class="writer_nav">
         <?php
         $result_writer = find_all_writer();
         ?>
            <?php  while($writer_raw = mysqli_fetch_assoc($result_writer)){ ?>
            <?php
            echo "<li";
              if($writer_raw["id"] == $selected_writer){
            echo "class=\"selected\"";
              }
            echo ">";
            ?>
               <a href="main_page.php?writer=<?php echo $writer_raw["id"]; ?>"><?php echo $writer_raw["writer_name"]; ?></a>
               <?php
                $result_text = find_text_for_writer($writer_raw["id"])
               ?>
                <ul class="text_nav">
                  <?php  while($raw_text = mysqli_fetch_assoc($result_text)){ ?>
                <li>
                    <a href="main_page.php?text=<?php echo $raw_text["id"]; ?>"><?php echo $raw_text["headline"]; ?></a>
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
            mysqli_free_result($result_writer);
            ?>
        </ul>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
