<?php
function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}

function mysql_prep($string){
    global $dbconn;
    $escape_string = mysqli_real_escape_string($dbconn, $string);
    return $escape_string;
}

function form_errors($errors=array()) {
	$output = "";
	if (!empty($errors)) {
	  $output .= "<div class=\"error\">";
	  $output .= "Please fix the following errors:";
	  $output .= "<ul>";
	  foreach ($errors as $key => $error) {
	    $output .= "<li>{$error}</li>";
	  }
	  $output .= "</ul>";
	  $output .= "</div>";
	}
	return $output;
}

function confirm_query($result_set){
    if(!$result_set){
    die("Databases failed");
    }
}

function find_all_writer($public = true){
    global $dbconn;

    $query_select_writer  = "SELECT * " ;
    $query_select_writer .= "FROM writer ";
    if($public){
      $query_select_writer .= "WHERE visible = 1 ";
    }
    $query_select_writer .= "ORDER BY position ASC";
    $result_select_writer = mysqli_query($dbconn, $query_select_writer);
    confirm_query($result_select_writer);
    return($result_select_writer);
}

function find_all_admins(){
    global $dbconn;

    $query_admin  = "SELECT * " ;
    $query_admin .= "FROM admins ";
    $query_admin .= "ORDER BY username ASC";
    $result_admin = mysqli_query($dbconn, $query_admin);
    confirm_query($result_admin);
    return($result_admin);
}

function find_writer_by_id($writer_id,$public=true){
    global $dbconn;

    $safe_writer_id = mysqli_real_escape_string($dbconn,$writer_id);

    $query_select_writer  = "SELECT * " ;
    $query_select_writer .= "FROM writer ";
    $query_select_writer .= "WHERE id = {$safe_writer_id} ";
    if($public){
       $query_select_writer .= "AND visible = 1 ";
    }
    $query_select_writer .= "LIMIT 1";
    $result_select_writer = mysqli_query($dbconn, $query_select_writer);
    confirm_query($result_select_writer);
    if($writer = mysqli_fetch_assoc($result_select_writer)){
        return $writer;
    } else {
        null;
    }
}

function find_admin_by_id($admin_id){
		global $dbconn;

		$safe_admin_id = mysqli_real_escape_string($dbconn, $admin_id);

		$query  = "SELECT * ";
		$query .= "FROM admins ";
		$query .= "WHERE id = {$safe_admin_id} ";
		$query .= "LIMIT 1";
		$admin_set = mysqli_query($dbconn, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			return $admin;
		} else {
			return null;
		}
}

function find_text_by_writer_id($writer_id,$public = true){
    global $dbconn;

    $safe_writer_id = mysqli_real_escape_string($dbconn,$writer_id);

    $query_select_text  = "SELECT * " ;
    $query_select_text .= "FROM text " ;
    $query_select_text .= "WHERE writer_id = {$safe_writer_id} " ;
    if($public){
       $query_select_text .= "AND visible = 1 " ;
    }
    $query_select_text .= "ORDER BY position ASC";
    $result_select_text = mysqli_query($dbconn, $query_select_text);
    confirm_query($result_select_text);
    return($result_select_text);
}

function find_text_by_id($text_id,$public=true){
    global $dbconn;

    $query_select_text  = "SELECT * " ;
    $query_select_text .= "FROM text ";
    $query_select_text .= "WHERE id = {$text_id} ";
    if($public){
        $query_select_text .= "AND visible = 1 ";
    }
    $query_select_text .= "LIMIT 1";
    $result_select_text = mysqli_query($dbconn, $query_select_text);
    confirm_query($result_select_text);
    if($text = mysqli_fetch_assoc($result_select_text)){
        return $text;
    } else {
        null;
    }
}

function find_default_text_for_writer($writer_id){
    $text_set = find_text_by_writer_id($writer_id);
    if($first_text = mysqli_fetch_assoc($text_set)){
        return $first_text;
    } else {
        null;
    }
}

function find_selected_text($public = false){
    global $current_writer;
    global $current_text;

  if(isset($_GET["writer"])){
    $current_writer = find_writer_by_id($_GET["writer"],$public);
      if($current_writer && $public){
          $current_text = find_default_text_for_writer($current_writer["id"]);
      }else{
          null;
      }
}elseif(isset($_GET["text"])){
    $current_text = find_text_by_id($_GET["text"],$public);
    $current_writer = null;
}else{
    $current_writer = null;
    $current_text = null;
}

}

function navigation($writer_array,$text_array){
            $output = "<ul class=\"writer\">" ;
            $result_select_writer = find_all_writer(false);
            while($writer_raw = mysqli_fetch_assoc($result_select_writer)){
            $output .= "<li ";
             if($writer_array && $writer_raw["id"] == $writer_array["id"]){
            $output .= "class=\"selected\"";
             }
            $output .= ">";
            $output .= "<a href=\"main_page.php?writer=";
            $output .= $writer_raw["id"];
            $output .= "\">";
            $output .= $writer_raw["writer_name"];
            $output .= "</a>";
                $output .= "<ul class=\"text\">";
                $result_select_text = find_text_by_writer_id($writer_raw["id"],$public=false);
                    while($text_raw = mysqli_fetch_assoc($result_select_text)) {
                    $output .= "<li ";
                    if($text_array && $text_raw["id"] == $text_array["id"]){
                    $output .= "class=\"selected\"";
                    }
                    $output .= ">";
                    $output .= "<a href=\"main_page.php?text=";
                    $output .= $text_raw["id"];
                    $output .= "\">";
                    $output .= $text_raw["headline"];
                    $output .="</a></li>";
                    }
                    mysqli_free_result($result_select_text);
                $output .= "</ul></li>";
            }
               mysqli_free_result($result_select_writer);
            $output .= "</ul>";
    return $output;
}

function public_navigation($writer_array,$text_array){

            $output = "<ul class=\"writer\">" ;
            $result_select_writer = find_all_writer();
            while($writer_raw = mysqli_fetch_assoc($result_select_writer)){
            $output .= "<li ";
             if($writer_array && $writer_raw["id"] == $writer_array["id"]){
            $output .= "class=\"selected\"";
             }
            $output .= ">";
            $output .= "<a href=\"index.php?writer=";
            $output .= $writer_raw["id"];
            $output .= "\">";
            $output .= $writer_raw["writer_name"];
            $output .= "</a>";

                if($writer_array["id"] == $writer_raw["id"] || $text_array["writer_id"] == $writer_raw["id"]){
                $result_select_text = find_text_by_writer_id($writer_raw["id"]);
                $output .= "<ul class=\"text\">";
                    while($text_raw = mysqli_fetch_assoc($result_select_text)) {
                    $output .= "<li ";
                    if($text_array && $text_raw["id"] == $text_array["id"]){
                    $output .= "class=\"selected\"";
                    }
                    $output .= ">";
                    $output .= "<a href=\"index.php?text=";
                    $output .= $text_raw["id"];
                    $output .= "\">";
                    $output .= $text_raw["headline"];
                    $output .="</a></li>";
                    }
                    $output .= "</ul>";
                    mysqli_free_result($result_select_text);
                }
                $output .= "</li>";
            }
               mysqli_free_result($result_select_writer);
            $output .= "</ul>";
    return $output;
}
