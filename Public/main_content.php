<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
if(isset($_GET["writer"])){
  $current_writer = find_writer_by_id($_GET["writer"]);
  $current_text = null;
} elseif(isset($_GET["text"])) {
  $current_text = find_text_by_id( $_GET["text"]);
  $current_writer = null;
} else {
  $current_text = null;
  $current_writer = null;
}
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
              <?php if($current_writer){ ?>
        <h2>Menage Writer</h2>
              <p>Writer Name:</p>
               <?php   echo $current_writer["writer_name"]; ?>

              <?php } elseif( $current_text){ ?>
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
         echo navigation($current_writer,$current_text);
        ?>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
