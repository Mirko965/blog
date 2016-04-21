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
?>
