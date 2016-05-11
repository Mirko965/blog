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
            <h2>Menage writer</h2>
             <div class="show_writer">
                 <ul>
                     <li>Writer Name :<?php   echo $current_writer["writer_name"];?></li>
                     <li>Writer Position :<?php   echo $current_writer["position"];?></li>
                     <li>Writer Visible :<?php   echo $current_writer["visible"] == 1 ? 'yes':'no'; ?></li>
                 </ul>
            <p><a href="edit_writer.php?writer=<?php echo $current_writer["id"]?>">Edit Writer</a></p>
            </div>
            <div class="show_text">
                <h3>Text in this writer</h3>
                <ul>
                <?php
                $writer_text = find_text_by_writer_id($current_writer["id"]);
                while($text = mysqli_fetch_assoc($writer_text)){
                    echo "<li>";
                    $safe_text_id = $text["id"];
                    echo "<a href=\"main_page.php?text={$safe_text_id}\">";
                    echo $text["headline"];
                    echo "</a>";
                    echo "</li>";
                }
                ?>
                </ul>
                <a href="new_text.php">Add new text ti this writer</a>
            </div>
            <?php }elseif($current_text){ ?>
            <h2>Menage Page</h2>
            <P>Headline :
            <?php   echo $current_text["content"]; ?>
            </P>
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
