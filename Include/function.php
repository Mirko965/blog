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
$result_writer = mysqli_query($dbconn, $query);
confirm_query($result_writer) ;
    return $result_writer;
}

function find_text_for_writer($writer_raw_id){
    global $dbconn;
$query  = "SELECT * " ;
$query .= "FROM text ";
$query .= "WHERE visible = 1 ";
$query .= "AND writer_id = {$writer_raw_id} ";
$query .= "ORDER BY position ASC";
$result_text = mysqli_query($dbconn, $query);
confirm_query($result_text);
    return $result_text;
}
