<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">
            <?php
            echo message();
            ?>
            <?php if($current_writer){ ?>

                <div class="show_writer">
                 <h2><?php echo $current_writer["writer_name"];?></h2>
                </div>


                    <?php }elseif($current_text){ ?>
                    <h3><?php echo $current_text["headline"];?></h3>
                        <?php echo $current_text["content"];?>
                    <?php }else{ ?>
                    <!--<h2>Menage content</h2>-->
                    <p> Please select writer or text!</p>
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
