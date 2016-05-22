<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>
<?php find_selected_text(); ?>
    <article class="main">
        <section class="content">
            <?php
            echo message();
            ?>
            <?php if($current_writer){ ?>
                <h2>Menage writer</h2>
                <div class="show_writer">
                  <ul>
                  <li>Writer Name :<?php   echo $current_writer["writer_name"];?></li>
                  <li>Writer Position :<?php   echo $current_writer["position"];?></li>
                  <li>Writer Visible :<?php   echo $current_writer["visible"] == 1 ? 'yes':'no'; ?></li>
                  </ul>
                    <p><a href="edit_writer.php?writer=<?php echo $current_writer["id"]?>">Edit Writer</a></p>
                </div>
                <h2>Menage Text</h2>
                <div class="show_text">
                    <ul>
                    <?php
                    $writer_text = find_text_by_writer_id($current_writer["id"]);
                    while($text = mysqli_fetch_assoc($writer_text)){
                        echo "<li>";
                        echo "<a href=\"main_page.php?text={$text['id']}\">";
                        echo $text["headline"];
                        echo "</a>";
                        echo "</li>";
                    }
                    ?>
                    </ul>
                    <a href="new_text.php?writer=<?php echo urlencode($current_writer["id"]); ?>">Add a new text</a>

                    <?php }elseif($current_text){ ?>
                    <h2>Menage Page</h2>
                    <ul class="text">
                         <li>Headline :<?php echo $current_text["headline"]; ?></li>
                         <li>visible :<?php echo $current_text["visible"] == 1 ? "yes" : "no" ; ?></li>
                         <li>position :<?php echo $current_text["position"]; ?></li>
                        <li>Content : <?php echo $current_text["content"]; ?></li>
                    </ul>
                    <a href="edit_text.php?text=<?php echo urldecode($current_text["id"]);?>">Edit text</a>
                </div>
                    <?php }else{ ?>
                    <!--<h2>Menage content</h2>-->
                    <p> Please select writer or text!</p>
                    <?php } ?>


        </section>
          <aside role="navigation" id="navigation">
            <nav>
            <?php
                echo navigation($current_writer,$current_text)
             ?>
                <p><a href="new_writer.php">+ Add new writer</a></p>
            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
