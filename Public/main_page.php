<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php include("../include/layout/header.php"); ?>


  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">


      </section>
      <aside>
        <nav>
<?php
    //PERFORM DATABASES QUERY
    $query  = "SELECT * " ;
    $query .= "FROM writer ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";
    $result = mysqli_query($dbconn, $query);
      if(!$result){
        die("Databases failed");
      }
?>
          <ul>
          <?php  while($raw = mysqli_fetch_assoc($result)){ ?>
             <li><a href="main_page.php?writer="><?php echo $raw["writer_name"]; ?></a></li>
          <?php
          }
          ?>
          </ul>
<?php
    //PERFORM DATABASES QUERY
    $query  = "SELECT * " ;
    $query .= "FROM text ";
    $query .= "WHERE writer_id = 3 ";
    $query .= "LIMIT 4";
    $result_text = mysqli_query($dbconn, $query);
      if(!$result_text){
        die("Databases failed");
      }
?>
          <ul>
          <?php  while($raw_text = mysqli_fetch_assoc($result_text)){ ?>
             <li><a href="main_page.php?text="><?php echo $raw_text["headline"]; ?></a></li>
          <?php
          }
          ?>
                  <?php
      mysqli_free_result($result_text);
      ?>
          </ul>
        </nav>
      </aside>
    </article>
     <?php
      mysqli_free_result($result);
      ?>
<?php include("../include/layout/footer.php"); ?>
