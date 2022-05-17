<aside class="userInfoBar">
    <div class="userSayHello">
        Hello,
        <a href='#'>
            <font color='red'>
                <?php
                echo getUserData('firstname');
                echo " ";
                echo getUserData('lastname');
                ?>
            </font>
        </a>
        <br />
        <div class="userStatus">
            Your rank:
            <a href="#">
                <font color='red'>
                    ADMIN
                </font>
            </a>
        </div>

    </div>
    <div class="userManageIfno">
        <ul>
            <li><a class="<?php echo $pageProfile; ?>" href="?editProfile">» Edit profile</a></li>
            <li><a class="<?php echo $pageOboutMe; ?>" href="?editProfile_oboutME">» Edit about me</a></li>
            <li><a class="<?php echo $pageAlbum; ?>" href="?editProfile_album">» Edit album</a></li>
            <li><a class="<?php echo $pagePassword; ?>" href="?editProfile_password">» Edit someting</a></li>
            <li><a class="<?php echo $pagePicture; ?>" href="?editProfile_picture">» Edit profile</a></li>
        </ul>
    </div>
</aside>
<section class="centerContent">


    <?php
    if (file_exists($pageLink)) {
        include($pageLink);
    } else {
        echo '<b><p>Lapa netika atrasta!</p></b>';
    }
    ?>



</section>
