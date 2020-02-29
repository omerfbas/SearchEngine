<?php 
/*require_once "panel/piston/config/db_connect.php"; */
 
extract($_GET);
require_once "inc/ust.php"; 
require_once "inc/function.php"; 

if(isset($_GET["page"]) && file_exists("pages/".$_GET["page"].".php")){
	$get_page = $_GET["page"];
	require_once "pages/".$_GET["page"].".php";
}else{
	$get_page = "index";
	require_once "pages/index.php";
}

?>

<?php require_once "inc/alt.php"; ?>