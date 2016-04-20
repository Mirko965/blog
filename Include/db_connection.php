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
