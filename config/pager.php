<?php
require_once ('core.php');
// Lapu identifikātors 


if  (isset($_GET['acp'])) {
        $pageLink = 'pages/admin.php';
        $pageTitle = 'Admin panel 2';
}else if (isset($_GET['news'])) {
        $pageLink = 'pages/news.php';
        $pageTitle = 'News'; 
}else if (isset($_GET['main'])) {
        $pageLink = 'pages/main.php';
        $pageTitle = 'Main';
}

// deffultā lapa
else {
        $pageLink = 'pages/news.php';
        $pageTitle = $pageConfig['page_name'];;
}



?>