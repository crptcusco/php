<?php 
include ("../settings.php"); 

if ( isset($_POST['add']) && isset($_POST['table']) )
{
  $input['add']= utf8_decode( $_POST['add']);
  $input['table']= ($_POST['table']);
  $mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);
  $sql = 'CALL em_diccionary_add ("'.$input['add'].'","'.$input['table'].'")';
  $result = $mysqli->query($sql);
  print $sql;
  // print 'echo';
}
