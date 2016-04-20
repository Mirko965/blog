//CONECTION
<?php
	define("DB_SERVER", "");
	define("DB_USER", "");
	define("DB_PASS", "");
	define("DB_NAME", "");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " .
         mysqli_connect_error() .
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>

<?php
while($writer = mysqli_fetch_assoc($result)){
?>
<li><?php echo $writer["writer_name"]; ?></li>
<?php
 }
?>

<?php
// 5. CLOSE CONECTION
if(isset($dbconn)){
  mysqli_close($dbconn);
}

?>

<?php
//2.PERFORM DATABASES QUERY
$query_select_author  = "SELECT * " ;
$query_select_author .= "FROM author ";
$query_select_author .= "WHERE visible = 1 ";
$query_select_author .= "ORDER BY position ASC";
$result_select_author = mysqli_query($dbconn, $query_select_author);
confirm_query($result_select_author); //pokazuje error(function confirm_query)
?>

<?php
//2.PERFORM DATABASES QUERY
$query_select_pages  = "SELECT * " ;
$query_select_pages .= "FROM pages " ;
$query_select_pages .= "WHERE visible = 1 " ;
$query_select_pages .= "AND author_id = {$author["id"]} " ;
$query_select_pages .= "ORDER BY position ASC";
$result_select_pages = mysqli_query($dbconn, $query_select_pages);
confirm_query($result_select_pages); //pokazuje error(function confirm_query)
?>

<?php
if(isset($_GET["author"])){
  $selected_author_id = $_GET["author"];
  $selected_pages_id = null;
} elseif(isset($_GET["page"])) {
  $selected_pages_id = $_GET["page"];
  $selected_author_id = null;
} else {
  $selected_pages_id = null;
  $selected_author_id = null;
}
?>
<?php
if(isset($_GET["author"])){
  $selected_author_id = $_GET["author"];
  $current_author = find_author_by_id($selected_author_id);
  $selected_pages_id = null;
  $current_page = null;
} elseif(isset($_GET["page"])) {
  $selected_pages_id = $_GET["page"];
  $current_page = find_pages_by_id($selected_pages_id);
  $selected_author_id = null;
  $current_author = null;
} else {
  $selected_pages_id = null;
  $selected_author_id = null;
  $current_page = null;
  $current_author = null;
}
?>
<?php
if(isset($_GET["author"])){
  $current_author = find_author_by_id($_GET["author"]);
  $current_page = null;
} elseif(isset($_GET["page"])) {
  $current_page = find_pages_by_id($_GET["page"]);
  $current_author = null;
} else {
  $current_page = null;
  $current_author = null;
}
?>

//NAVIGATION
<ul class="author">
<?php
//2.PERFORM DATABASES QUERY
  $result_select_author = find_all_author();
?>
<?php
// 3.RETURN DATA
while($author = mysqli_fetch_assoc($result_select_author)){
?>
    <?php
    echo "<li ";
     if($author["id"] == $selected_author_id){
    echo "class=\"selected\"";
     }
    echo ">";
    ?>
      <a href="menage_content.php?author=<?php echo $author["id"]?>"><?php echo   $author["author_name"]; ?></a>
        <?php
        $result_select_pages = find_pages_for_author($author["id"]);
        ?>
        <ul class="pages">
          <?php
          while($pages = mysqli_fetch_assoc($result_select_pages)){
          ?>
          <?php
          echo "<li";
           if($pages["id"] == $selected_pages_id){
          echo " class=\"selected\"";
           }
          echo ">";
          ?>
          <a href="menage_content.php?page=<?php echo $pages["id"]?>"><?php echo  $pages["title"]; ?></a>
          </li>
          <?php
          }
          ?>
          <?php
          mysqli_free_result($result_select_pages);
          ?>
        </ul>
  </li>
  <?php
    }
  ?>
  <?php
  //4.relese return data
  mysqli_free_result($result_select_author);
  ?>
</ul>
//End of Navigation 1
//NAVIGATION 2
<?php
  function navigation($selected_author_id, $selected_pages_id) {
    $output = "<ul class=\"author\">";
    $result_select_author = find_all_author();
    while($author = mysqli_fetch_assoc($result_select_author)){
      $output .= "<li ";
      if($author["id"] == $selected_author_id){
      $output .= "class=\"selected\"";
       }
      $output .= ">";
      $output .= "<a href=\"menage_content.php?author=" ;
      $output .= $author["id"] ;
      $output .= "\">" ;
      $output .= $author["author_name"] ;
      $output .= "</a>";

      $result_select_pages = find_pages_for_author($author["id"]);
      $output .= "<ul class=\"pages\">" ;
        while($pages = mysqli_fetch_assoc($result_select_pages)){
        $output .= "<li";
         if($pages["id"] == $selected_pages_id){
        $output .= " class=\"selected\"";
         }
        $output .= ">";
        $output .= "<a href=\"menage_content.php?page=" ;
        $output .= $pages["id"] ;
        $output .= "\">" ;
        $output .= $pages["title"] ;
        $output .= "</a>" ;
        $output .= "</li>";
        }
        mysqli_free_result($result_select_pages);
        $output .= "</ul></li>";
      }
      mysqli_free_result($result_select_author);
      $output .= "</ul>";
      return $output;
    }
?>


//Menage_Contene without refactoring
<main class="main">
    <article class="content">
           <?php if($selected_author_id) { ?>
<h2>Menage Author</h2>
           <?php   $current_author = find_author_by_id($selected_author_id);"<br />" ?>
<h3>Author Name: <?php   echo $current_author["author_name"]; ?></h3>
           <?php } elseif($selected_pages_id) { ?>
<h2>Menage Pages</h2>
           <?php   $current_page = find_pages_by_id($selected_pages_id);"<br />" ?>
<p>Title : <?php echo $current_page["title"]; ?> </p>
           <?php } else { ?>
<p>Please select Author or a Page !!</p>
           <?php }    ?>

      </article>
      <aside role="navigation" id="navigation">
       <div> <?php echo navigation($selected_author_id,$selected_pages_id); ?></div>

      </aside>
</main>
//End of Menage_Contene without refactoring
