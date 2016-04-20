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
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article role="combobox">
      <section class="main">
        <h2>Menage Content</h2>
      </section>
      <aside>
        <nav>
          <ul class="writer">
          <?php
          while($writer = mysqli_fetch_assoc($result)){
          ?>
            <li><?php echo $writer["writer_name"] ?></li>
          <?php
          }
          ?>
        </nav>
      </aside>
    </article>
<?php
mysqli_free_result($result);
?>
<?php include("../include/layout/footer.php"); ?>
