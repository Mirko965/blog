<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connection.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php require_once("../include/validation_function.php"); ?>
<?php find_selected_text(); ?>
<?php
if(!$current_writer){
    redirect_to("main_page.php");
}
?>
<?php
if (isset($_POST['submit'])) {

    $required_fields = array("writer_name","position","visible");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("writer_name" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if(empty($errors)){
       $id = $current_writer["id"];
	   $writer_name = mysql_prep($_POST["writer_name"]);
	   $position = (int) $_POST["position"];
	   $visible = (int) $_POST["visible"];

	   $query  = "UPDATE writer SET ";
	   $query .= "writer_name = '{$writer_name}', ";
       $query .= "position = {$position}, ";
       $query .= "visible = {$visible}  ";
	   $query .= "WHERE id = {$id} ";
	   $query .= "LIMIT 1";
	   $result = mysqli_query($dbconn, $query);

	if ($result && mysqli_affected_rows($dbconn) == 1) {
        $_SESSION["message"] = "Writer updated";
		redirect_to("main_page.php");
	} else {
		$message = "Writer update failed";
	}
    }
    } else {

    }
?>
 <?php $layout_context = "admin"; ?>
<?php include("../include/layout/header.php"); ?>

    <article class="main">
        <section class="content">
        <?php
            if(!empty($message)){
                echo "<div class=\"message\">". $message . "</div>";
            }
        ?>
        <?php echo form_errors($errors) ; ?>

        <h2>Edit writer:<?php echo $current_writer["writer_name"];?></h2>
        <form action="edit_writer.php?writer=<?php echo $current_writer["id"]?>" method="post">
            <p>Writer name:
                <input type="text" name="writer_name" value="<?php echo $current_writer["writer_name"]?>">
            </p>
            <p>Position:
                <select name="position" >
                    <?php
                    $writer_number = find_all_writer($public=false);
                    $writer_count = mysqli_num_rows($writer_number);
                    for($count = 1; $count <= $writer_count; $count++){
                      echo  "<option value=\"{$count}\"";
                        if($current_writer["position"] == $count){
                           echo  "selected";
                        }
                      echo  ">{$count}</option>";
                    }
                    ?>
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="1" <?php if($current_writer["visible"] == 1){ echo "checked";} ?>  />Yes
                <input type="radio" name="visible" value="0" <?php if($current_writer["visible"] == 0){ echo "checked";} ?> />No
            </p>
            <input type="submit" name="submit" value="edit writer" />
        </form>
            <br>
            <p><a href="main_page.php">Cancel</a></p>
            <p><a href="deleted_writer.php?writer=<?php echo $current_writer["id"];?>" onclick="return confirm('Are you shure?')">Delete Writer</a></p>

        </section>
          <aside role="navigation" id="navigation">
            <nav>
            <?php
                echo navigation($current_writer,$current_text)
             ?>
            </nav>
          </aside>
    </article>
<?php include("../include/layout/footer.php"); ?>




