<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
        <?php echo message(); ?>
        <?php $errors = errors(); ?>
        <?php echo form_errors($errors) ; ?>

        <form action="create_new_admin.php" method="post">
            <p>Username:
                <input type="text" name="username" value=""  >
            </p>
            <p>Password:
                <input type="text" name="password" value=""  >
            </p>

            <input type="submit" name="submit" value="create new admin" />
        </form>
            <br>
            <p><a href="main_page.php">Cancel</a></p>

        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
