<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">

            <?php if($current_writer){ ?>
            <h2>Menage writer</h2>
            <p>Writer Name :
            <?php   echo $current_writer["writer_name"];?>
            </p>
            <?php }elseif($current_text){ ?>
            <h2>Menage Page</h2>
            <P>Headline :
            <?php   echo $current_text["headline"]; ?>
            </P>
            <?php }else{ ?>
            <h2>Menage content</h2>
            <p> Please select writer or text!</p>
            <?php } ?>

        </section>
          <aside role="navigation" id="navigation">
            <nav>
            <?php
                echo navigation($current_writer,$current_text)
             ?>
            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
