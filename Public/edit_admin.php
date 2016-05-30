<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>

<?php
$admin = find_admin_by_id($_GET["id"]);

if(!$admin){
    redirect_to("menage_admin.php");
}
?>
<?php
if (isset($_POST['submit'])) {

    $required_fields = array("username","password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(empty($errors)){
       $id = $admin["id"];
	   $username = mysql_prep($_POST["username"]);
	   $hashed_password = $_POST["password"];

    $query  = "UPDATE admins SET ";
    $query .= "username = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($dbconn, $query);

	if ($result && mysqli_affected_rows($dbconn) == 1) {
        $_SESSION["message"] = "Admin updated";
		redirect_to("menage_admin.php");
	} else {
		$message = "Admin update failed";
	}
    }
    } else {

    }
?>
 <?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>

        <h2>Edit Admin: <?php echo $admin["username"];?></h2>
        <form action="edit_admin.php?id=<?php urlencode($admin["id"]); ?>" method="post">
            <p>Username:
                <input type="text" name="username" value="<?php echo $admin["username"];?>"  >
            </p>
            <p>Password:
                <input type="text" name="password" value="<?php echo $admin["hashed_password"];?>"  >
            </p>

            <input type="submit" name="submit" value="edit admin" />
        </form>
            <br>
            <p><a href="menage_admin.php">Cancel</a></p>

        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
