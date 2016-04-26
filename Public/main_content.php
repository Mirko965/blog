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
              <?php if($selected_writer_id){ ?>
        <h2>Menage Writer</h2>
              <?php $current_writer = find_writer_by_id($selected_writer_id);?>
              <p>Writer Name:</p>
               <?php   echo $current_writer["writer_name"]; ?>

              <?php } elseif( $selected_text_id){ ?>
              <?php $current_text = find_text_by_id($selected_text_id);?>
              <h2>Menage Text</h2>
              <p>Text Headline:</p>
              <?php   echo $current_text["headline"]; ?>
              <?php } else { ?>
              <p>Please selected writer or text </p>
              <?php } ?>
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
