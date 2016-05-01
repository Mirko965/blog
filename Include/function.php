<?php
function confirm_query($result_set){
    if(!$result_set){
    die("Databases failed");
    }
}

function find_all_writer(){
    global $dbconn;

    $query_select_writer  = "SELECT * " ;
    $query_select_writer .= "FROM writer ";
    $query_select_writer .= "WHERE visible = 1 ";
    $query_select_writer .= "ORDER BY position ASC";
    $result_select_writer = mysqli_query($dbconn, $query_select_writer);
    confirm_query($result_select_writer);
    return($result_select_writer);
}

function find_text_by_writer_id($writer_raw_id){
    global $dbconn;

    $query_select_text  = "SELECT * " ;
    $query_select_text .= "FROM text " ;
    $query_select_text .= "WHERE visible = 1 " ;
    $query_select_text .= "AND writer_id = {$writer_raw_id} " ;
    $query_select_text .= "ORDER BY position ASC";
    $result_select_text = mysqli_query($dbconn, $query_select_text);
    confirm_query($result_select_text);
    return($result_select_text);
}
