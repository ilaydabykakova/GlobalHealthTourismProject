<?
session_start();
session_destroy(); 
$_SESSION["UyeID"]="";

header("Refresh: 1; url=admingiris.php");
?>