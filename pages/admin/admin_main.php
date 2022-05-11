<?php 

include ('pages/admin/admin_pager.php');

?>


<div id="acpContainer">
    <div class="pageTitle"><?php echo $pageTitle; ?> »</div>
    <hr class="pageTitleUnderline">
        <div class="acpContnet">
            <div class="acpContentTitle">
                Jaunumu sadaļa
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=add">Pievienot</a>               
            </div>
            <!-- <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=edit">Labot Jaunumus</a>               
            </div> -->
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=edit2">Labot V2</a>               
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=delete">Dzēst</a>       
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_key.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=config">Kategorija</a>       
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_key.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=config">Konfigurācija</a>       
            </div>
        </div>
        <div class="acpContnet">
            <div class="acpContentTitle">
                Galvenā navigācija
            </div>              
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>#">Pievienot</a>               
            </div>            
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>#">Labot V2</a>               
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>#">Dzēst</a>       
            </div>

            <?php 
                // php code for menu go hear :) but not today 
                ?>

        </div>
        <div class="acpContnet">
            <div class="acpContentTitle">
                To do list :)
            </div>              
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=todo&action=add">Pievienot</a>               
            </div>            
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>#">Labot V2</a>               
            </div>
            <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>#">Dzēst</a>       
            </div>    
        </div>
</div>