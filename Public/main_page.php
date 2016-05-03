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

            <?php if($selected_writer_id){ ?>
            <h2>Menage writer</h2>
            <?php   $current_writer = find_writer_by_id($selected_writer_id); ?>
            <p>Writer Name :
            <?php   echo $current_writer["writer_name"];?>
            </p>
            <?php }elseif($selected_text_id){ ?>
            <h2>Menage Page</h2>
            <?php $current_text = find_text_by_id($selected_text_id) ?>
            <P>Headline :
            <?php   echo $current_text["headline"]; ?>
            </P>
            <?php }else{ ?>
            <p> Please select writer or text!</p>
            <?php } ?>

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
