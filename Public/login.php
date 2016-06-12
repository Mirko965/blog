<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

<?php
$username = "";

if (isset($_POST['submit'])) {

    $required_fields = array("username","password");
    validate_presences($required_fields);

    if(!empty($errors)){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $found_admin = attempt_login($username,$password);

	if ($found_admin) {
		redirect_to("admin.php");
	} else {
		 $_SESSION["message"] = "Username/password not found";
		redirect_to("login.php");
	}
    } else {

    }
}
?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>
            <h2>Login</h2>

        <form action="login.php" method="post">
            <p>Username:
                <input type="text" name="username" value=" "  >
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
