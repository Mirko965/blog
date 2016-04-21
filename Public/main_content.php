<?php require_once("../include/function.php")?>
<?php include("../include/layout/header.php"); ?>
<?php
	define("DB_SERVER", "mirkohost");
	define("DB_USER", "mirkojelic");
	define("DB_PASS", "fionfion00");
	define("DB_NAME", "my_blog");

  // 1. Create a database connection
  $dbconn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " .
         mysqli_connect_error() .
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
<?php
if(isset($_GET["writer"])){
  $selected_writer_id = $_GET["writer"];
  $selected_text_id = null;
} elseif(isset($_GET["text"])) {
  $selected_text_id = $_GET["text"];
  $selected_writer_id = null;
} else {
  $selected_text_id = null;
  $selected_writer_id = null;
}
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article role="combobox">
      <section class="main">
        <h2>Menage Content</h2>
        <?php
         echo $selected_writer_id;
        ?>
        <?php
         echo $selected_text_id;
        ?>
      </section>
      <aside>
        <nav>
          <ul class="writer">
            <?php
             //2.PERFORM DATABASES QUERY
             $query  = "SELECT * " ;
             $query .= "FROM writer ";
             $query .= "WHERE visible = 1 ";
             $query .= "ORDER BY position ASC";
             $result = mysqli_query($dbconn, $query);
             if(!$result){
               die("Database query failed");
             }
             ?>
              <?php
              while($writer = mysqli_fetch_assoc($result)){
              ?>
              <?php
               echo "<li";
                if($writer["id"] == $selected_writer_id){
               echo " class=\"selected\"";
                }
               echo ">";
              ?>
                 <a href="main_content.php?writer=<?php echo $writer["id"] ?>"><?php echo $writer["writer_name"] ?></a>
                <ul class="text">
                  <?php
                  $query_text  = "SELECT * " ;
                  $query_text .= "FROM text " ;
                  $query_text .= "WHERE visible = 1 " ;
                  $query_text .= "AND writer_id = {$writer["id"]} " ;
                  $query_text .= "ORDER BY position ASC";
                  $result_text = mysqli_query($dbconn, $query_text);
                  if(!$result_text){
                   die("Database query failed");
                  }
                  ?>
                  <?php
                  while($text = mysqli_fetch_assoc($result_text)){
                  ?>
                  <?php
                  echo "<li";
                    if($text["id"] == $selected_text_id){
                  echo " class=\"selected\"";
                    }
                  echo ">";
                  ?>
                   <a href="main_content.php?text=<?php echo $text["id"] ?>"><?php echo $text["headline"] ?></a>
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
            mysqli_free_result($result);
            ?>
          </ul>
        </nav>
      </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
