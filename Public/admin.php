<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

<?php confirm_logged_in() ?>

    <article class="main">
        <section class="content">
        <h2>Admin Menu</h2>
            <p>Welcome to admin area <?php echo $_SESSION["username"]; ?> </p>
            <ul>
            <li><a href="main_page.php">Menage website content</a></li>
            <li><a href="menage_admin.php">Menage admin users</a></li>
            <li><a href="">logout</a></li>
            </ul>
        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
