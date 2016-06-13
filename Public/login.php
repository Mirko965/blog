<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php confirm_logged_in() ?>

<?php
$username = "";

if (isset($_POST['submit'])) {
  // Process the form

  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);

  if (empty($errors)) {
    // Attempt Login

		$username = $_POST["username"];
		$password = $_POST["password"];

		$found_admin = attempt_login($username, $password);

    if ($found_admin) {
      // Success
			// Mark user as logged in
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
      redirect_to("admin.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} else {
  // This is probably a GET request

} // end: if (isset($_POST['submit']))

?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>
    <article class="main">
        <section class="content">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
            <h2>Login</h2>

        <form action="login.php" method="post">
            <p>Username:
                <input type="text" name="username" value="<?php echo $username;?> "  >
            </p>
            <p>Password:
                <input type="password" name="password" value=""  >
            </p>

            <input type="submit" name="submit" value="submit" />
        </form>

        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
