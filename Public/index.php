<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php $layout_context = "public"; ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(true); ?>
    <article class="main">
        <section class="content">
            <?php if($current_text){ ?>
             <h2><?php echo $current_text["headline"];?></h2>
                <?php echo nl2br(htmlentities($current_text["content"]));?>
                <?php }else{ ?>
                <!--<h2>Menage content</h2>-->
                <h3>Welcome</h3>
                <?php } ?>
        </section>
          <aside role="navigation" id="navigation">
            <nav>
            <?php
                echo public_navigation($current_writer,$current_text)
             ?>
            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
