<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>

<?php
$admin_set = find_all_admins();
?>
<?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
            <?php
            echo message();
            ?>
            <h2>Menage Admin</h2>
            <?php
            while($admin = mysqli_fetch_assoc($admin_set)){
                echo $admin["username"];
            }
            ?>

        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
