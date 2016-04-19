<?php include("../include/layout/header.php"); ?>
<?php
	define("DB_SERVER", "mirkohost");
	define("DB_USER", "mirkojelic");
	define("DB_PASS", "fionfion00");
	define("DB_NAME", "my_blog");

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
  <body>
    <header>
      <h1>My Blog</h1>
    </header>
    <article>
      <section class="main">
      </section>
      <aside>
        <nav>

        </nav>
      </aside>
    </article>

<?php include("../include/layout/footer.php"); ?>
