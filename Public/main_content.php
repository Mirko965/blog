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
        <?php
         echo navigation($selected_writer_id,$selected_text_id);
        ?>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
