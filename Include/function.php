<?php
function find_writer_id($writer_id){
    global $dbconn;

    $safe_writer_id = mysqli_real_escape_string($dbconn,$writer_id);

    $query_select_writer  = "SELECT * " ;
    $query_select_writer .= "FROM author ";
    $query_select_writer .= "WHERE id = {$safe_writer_id} ";
    $query_select_writer .= "ORDER BY position ASC";
    $result_select_writer = mysqli_query($dbconn, $query_select_writer);
    confirm_query($result_select_writer);
    if($writer = mysqli_fetch_assoc($result_select_writer)){
        return $writer;
    } else {
        return null;
    }
}
