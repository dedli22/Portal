<?php
require_once ('core.php');
// Lapu identifikātors 


if  (isset($_GET['acp'])) {
        $pageLink = 'pages/admin.php';
        $pageTitle = 'Admin panel 2';
        $pageAcp = 'current';
}else if (isset($_GET['news'])) {
        $pageLink = 'pages/news.php';
        $pageTitle = 'News';
        $pageNews = 'current'; 
}else if (isset($_GET['main'])) {
        $pageLink = 'pages/main.php';
        $pageTitle = 'Main';
        $pageMain = 'current';
}else if (isset($_GET['editProfile'])) {
        $pageLink = 'pages/user/edit_profile.php';
        $pageTitle = 'Edit profile';
        $pageProfile = 'current';
}else if (isset($_GET['editProfile_oboutME'])) {
        $pageLink = 'pages/user/edit_oboutMe.php';
        $pageTitle = 'Edit Obout ME';
        $pageOboutMe = 'current';
}else if (isset($_GET['editProfile_album'])) {
        $pageLink = 'pages/user/edit_album.php';
        $pageTitle = 'Edit album';
        $pageAlbum = 'current';
}else if (isset($_GET['editProfile_password'])) {
        $pageLink = 'pages/user/edit_password.php';
        $pageTitle = 'Edit pasword';
        $pagePassword = 'current';
}else if (isset($_GET['editProfile_picture'])) {
        $pageLink = 'pages/user/edit_picture.php';
        $pageTitle = 'Edit picture';
        $pagePicture = 'current';
}

// deffultā lapa
else {
        $pageLink = 'pages/news.php';
        $pageTitle = $pageConfig['page_name'];
        $pageNews = 'current';
}
?>