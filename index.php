<?php 
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(0);
require_once 'themes/puffy/header.php';


page_off($pageConfig['page_offline']); 


include ('pages/main.php');



require_once 'themes/puffy/footer.php';
?>