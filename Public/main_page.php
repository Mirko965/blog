<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
if(isset($_GET["writer"])){
    $selected_writer_id = $_GET["writer"];
    $selected_text_id = null;
}elseif(isset($_GET["text"])){
    $selected_text_id = $_GET["text"];
    $selected_writer_id = null;
}else{
    $selected_writer_id = null;
    $selected_text_id = null;
}
?>
    <article class="main">
      <section class="content">

      </section>
      <aside role="navigation" id="navigation">
        <nav>
            <?php
                echo navigation($selected_writer_id,$selected_text_id)
             ?>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
