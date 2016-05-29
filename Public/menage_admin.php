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
            <table>
                <tr>
                    <th>Username</th>
                    <th colspan="2">Action</th>
                </tr>
                  <?php while($admin = mysqli_fetch_assoc($admin_set)){ ?>
                <tr>
                    <td> <?php  echo $admin["username"]; ?></td>
                    <td> <a href="edit_admin.php?id=<?php echo $admin["id"]; ?>">Edit </a> </td>
                    <td> <a href="delete_admin.php?id=<?php echo $admin["id"]; ?>">Delete </a> </td>
                </tr>
                  <?php } ?>
            </table>
            <br>
            <a href="new_admin.php">Add a new Admin</a>
        </section>
          <aside role="navigation" id="navigation">
            <nav>

            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>
