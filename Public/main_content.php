<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>

<?php
$query  = "SELECT * " ;
$query .= "FROM writer ";
$query .= "WHERE visible = 1 ";
$query .= "ORDER BY position ASC";
$result = mysqli_query($dbconn, $query);
confirm_query($result);
?>
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
      </section>
      <aside>
        <nav>
          <ul class="writer">
           <?php
           while($writer = mysqli_fetch_assoc($result)){
           ?>
           <li><?php echo $writer["writer_name"]; ?></li>
           <?php
            }
           ?>
          </ul>
        </nav>
      </aside>
    </article>
<?php
 mysqli_free_result($result);
?>
<?php include("../include/layout/footer.php"); ?>
