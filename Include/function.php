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

function navigation($selected_writer_id,$selected_text_id){
   $output = "<ul class=\"writer\">";
   $result = find_all_writer();
    while($writer = mysqli_fetch_assoc($result))          {
    $output .= "<li";
    if($writer["id"] == $selected_writer_id)              {
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
        if($text["id"] == $selected_text_id)             {
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

  function find_author_by_id($writer_id){
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
?>
