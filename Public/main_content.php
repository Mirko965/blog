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
          <ul class="writer">
            <?php
              $result = find_all_writer();
             ?>
              <?php
              while($writer = mysqli_fetch_assoc($result)){
              ?>
               <li><?php echo $writer["writer_name"] ?>
                <ul class="text">
                  <?php
                   $result_text = find_text_for_writer($writer["id"])
                  ?>
                  <?php
                  while($text = mysqli_fetch_assoc($result_text)){
                  ?>
                 <li>
                   <?php echo $text["headline"] ?>
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
