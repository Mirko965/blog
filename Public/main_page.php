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
         $result_select_writer = find_all_writer();
        ?>
            <ul class="writer">
            <?php while($writer_raw = mysqli_fetch_assoc($result_select_writer)){ ?>
            <li class="selected">
                <a href="main_page.php?writer=<?php echo $writer_raw["id"]; ?>" ?><?php echo $writer_raw["writer_name"]; ?></a>
                <ul class="text">
                    <?php
                      $result_select_text = find_text_by_writer_id($writer_raw["id"]);
                    ?>
                    <?php while($text_raw = mysqli_fetch_assoc($result_select_text)) { ?>
                    <li><a href="main_page.php?text=<?php echo $text_raw["id"];?>"><?php echo $text_raw["headline"]; ?></a></li>
                    <?php
                        }
                    ?>
                    <?php mysqli_free_result($result_select_text); ?>
                </ul>
            </li>
            <?php
            }
            ?>
            <?php mysqli_free_result($result_select_writer); ?>
            </ul>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
