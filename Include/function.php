<?php
function confirm_query($result_set){
  if(!$result_set){
    die("Databases failed");
  }
}

function find_all_writer(){
  global $dbconn;

  $query  = "SELECT * " ;
  $query .= "FROM writer ";
  $query .= "WHERE visible = 1 ";
  $query .= "ORDER BY position ASC";
  $result = mysqli_query($dbconn, $query);
  confirm_query($result);
  return $result;

}

function find_text_for_writer($writer_id){
  global $dbconn;

  $query_text  = "SELECT * " ;
  $query_text .= "FROM text " ;
  $query_text .= "WHERE visible = 1 " ;
  $query_text .= "AND writer_id = {$writer_id} " ;
  $query_text .= "ORDER BY position ASC";
  $result_text = mysqli_query($dbconn, $query_text);
  confirm_query($result_text);
  return $result_text;
}

function navigation($writer_array,$text_array){
   $output = "<ul class=\"writer\">";
   $result = find_all_writer();
    while($writer = mysqli_fetch_assoc($result))          {
    $output .= "<li";
    if($writer_array && $writer["id"] == $writer["id"])              {
    $output .= " class=\"selected\"";
}
    $output .= ">";
    $output .= "<a href=\"main_content.php?writer=";
    $output .= $writer["id"];
    $output .= "\">";
    $output .= $writer["writer_name"] ;
    $output .= "</a>";

      $result_text = find_text_for_writer($writer["id"]);
      $output .= "<ul class=\"text\">";
        while($text = mysqli_fetch_assoc($result_text))  {
        $output .= "<li";
        if($text_array && $text["id"] == $text["id"])             {
        $output .= " class=\"selected\"";
}
        $output .= "\">";
        $output .= "<a href=\"main_content.php?text=";
        $output .= $text["id"];
        $output .= "\">";
        $output .= $text["headline"];
        $output .= "</a></li>";
}
        mysqli_free_result($result_text);
        $output .= "</ul></li>";
}
     mysqli_free_result($result);
     $output .= "</ul>";
     return $output;
}

function find_writer_by_id($writer_id){
        global $dbconn;
        $safe_writer_id = mysqli_real_escape_string($dbconn,$writer_id);

        $query  = "SELECT * " ;
        $query .= "FROM writer ";
        $query .= "WHERE id = {$safe_writer_id} ";
        $query .= "LIMIT 1";
        $result = mysqli_query($dbconn, $query);
        confirm_query($result); //pokazuje error(function confirm_query)

        if ($writer = mysqli_fetch_assoc($result)){
          return $writer;
        } else {
          return null;
        }
  }

function find_text_by_id($text_id){
        global $dbconn;
        $safe_text_id = mysqli_real_escape_string($dbconn,$text_id);

        $query  = "SELECT * " ;
        $query .= "FROM text ";
        $query .= "WHERE id = {$safe_text_id} ";
        $query .= "LIMIT 1";
        $result_text_id = mysqli_query($dbconn, $query);
        confirm_query($result_text_id); //pokazuje error(function confirm_query)

        if ($text = mysqli_fetch_assoc($result_text_id)){
          return $text;
        } else {
          return null;
        }
  }

function find_selected_writer_or_text(){
    global $current_writer;
    global $current_text;

    if(isset($_GET["writer"])){
      $current_writer = find_writer_by_id($_GET["writer"]);
      $current_text = null;
    } elseif(isset($_GET["text"])) {
      $current_text = find_text_by_id( $_GET["text"]);
      $current_writer = null;
    } else {
      $current_text = null;
      $current_writer = null;
    }
}
?>
