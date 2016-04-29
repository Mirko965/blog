<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
if(isset($_GET["writer"])){
    $selected_writer = $_GET["writer"];
    $selected_text = null;
}elseif($_GET["text"]){
    $selected_text = $_GET["text"];
    $selected_writer = null;
}else{
    $selected_writer = null;
    $selected_text = null;
}
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
      <?php
          echo $selected_writer;
      ?>
      <?php
          echo $selected_text;
      ?>
      </section>
      <aside>
        <nav>
        <ul class="writer_nav">
         <?php
            //PERFORM DATABASES QUERY
            $query  = "SELECT * " ;
            $query .= "FROM writer ";
            $query .= "WHERE visible = 1 ";
            $query .= "ORDER BY position ASC";
            $result_writer = mysqli_query($dbconn, $query);
            confirm_query($result_writer) ;
         ?>
            <?php  while($writer_raw = mysqli_fetch_assoc($result_writer)){ ?>
            <li>
               <a href="main_page.php?writer=<?php echo $writer_raw["id"]; ?>"><?php echo $writer_raw["writer_name"]; ?></a>
               <?php
                $query  = "SELECT * " ;
                $query .= "FROM text ";
                $query .= "WHERE visible = 1 ";
                $query .= "AND writer_id = {$writer_raw["id"]} ";
                $query .= "ORDER BY position ASC";
                $result_text = mysqli_query($dbconn, $query);
                confirm_query($result_text);
            ?>
                <ul class="text_nav">
                  <?php  while($raw_text = mysqli_fetch_assoc($result_text)){ ?>
                <li>
                    <a href="main_page.php?text=<?php echo $raw_text["id"]; ?>"><?php echo $raw_text["headline"]; ?></a>
                </li>
                <?php
                }
                ?>
                <?php
                mysqli_free_result($result_text);
                ?>
                </ul>
            </li>
            <?php
              }
            ?>
            <?php
            mysqli_free_result($result_writer);
            ?>
        </ul>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
