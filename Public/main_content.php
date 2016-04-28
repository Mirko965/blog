<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>
<?php

//2.PERFORM DATABASES QUERY
$query  = "SELECT * " ;
$query .= "FROM writer ";
//$query .= "WHERE visible = 1 ";
//$query .= "ORDER BY position ASC";
$result = mysqli_query($dbconn, $query);
  if(!$result){
    die("Databases failed");
  }
?>

  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
          <ul>
          <?php  while($raw = mysqli_fetch_assoc($result)){ ?>
             <li><a href=""><?php echo $raw["writer_name"]; ?></a></li>
          <?php
          }
          ?>
          </ul>

      </section>
      <aside>
        <nav>

        </nav>
      </aside>
    </article>
     <?php
      mysqli_free_result($result);
      ?>
<?php include("../include/layout/footer.php"); ?>
