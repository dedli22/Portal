<?php 
// inkludojam main failus 
require_once ('config/core.php');
require_once ('config/functions.php');
require ('locale/Latvian/latvian.php');
require ('config/directorys.php');
require ('config/pager.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="the page description"/>
    <link rel='canonical' href='http://localhost/hosts/project/portal_v2/' />    
    <link rel="stylesheet" href="themes/puffy/theme.css">
    
    <title><?php echo $pageConfig['page_name'];?></title>
</head>
<body>
<div class="container">
    <header>
      <div class="pageInfoBar">
        <div class="headerLogo">
            <a href="<?php echo $pageConfig['page_url'];?> ">
                <img src="http://localhost/hosts/templates/portal_v2/themes/puffy/images/header/logo_small1_trans.png" alt="Logo" height="40px" width="171px"/>
            </a>
        </div>
        <div class="searchBar">
          <form class="search-form">
					  <input type="search" placeholder="Search...">
					  <input type="submit" value="Submit">
				  </form>   
        </div>
        <?php 
            include ('themes/puffy/Main_navigation.php');
        ?>
      </div>
      <div class="languageBar">
        <div class="languageFlags">
            <a href=""><img width="34px" height="24px" style="padding-left:10px; margin: 5px;" src="themes/puffy/images/header/latvia.png" alt="Latvian"/></a>
            <a href=""><img width="34px" height="24px" style="margin: 5px;" src="themes/puffy/images/header/english.png" alt="English"/></a>
            <a href=""><img width="34px" height="24px" style="margin: 5px;" src="themes/puffy/images/header/russia.png" alt="Russian"/></a>
        </div>
      </div>        
    </header>
    <?php 
        include ('themes/puffy/user_bar.php');
    ?>