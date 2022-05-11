<?php  
require_once ('config/core.php');
?>

<div id="acpContainer">
    <div class="pageTitle"><?php echo $pageTitle; ?> »</div>
    <hr class="pageTitleUnderline">
        <div class="acpContnet">
            <div class="acpContentTitle">
                Jaunumu sadaļa
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="add" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=add">Pievienot</a>               
            </div>
            <!-- <div class="acpConentButton">
                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=edit">Labot Jaunumus</a>               
            </div> -->
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=edit2">Labot V2</a>               
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="delete" src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=delete">Dzēst</a>       
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="category" src="themes/default/images/icons/application_key.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=config">Kategorija</a>       
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="config" src="themes/default/images/icons/application_key.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=news&action=config">Konfigurācija</a>       
            </div>
            
            
        
                   
            <?php 
                if($_GET['action'] == 'add') 
                {
            ?>
             <div class="acpContnet">
                <form action="" method="post">
                    <div><b>Jaunumu nosaukums </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="title"  value="" size="" /><br/>
                    <div><b>Jaunumu bilde </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="photo"  value="" size="" /><br/>
                    <div ><b>Jaunumu texts </b><font color="red">*</font>:<br/></div>                        
                        <textarea id="text" name="text" style="width:380px;height:150px;"></textarea><br/>

                    <input type="submit" name="add_news" value="Nosūtīt" style="width:100px;" />
                </form>
            </div>
            <?php
                    if(isset($_POST['add_news'])) 
                    {
                        $author = intval($_SESSION['user_id']);
                        $title = $_POST['title'];
                        $text = $_POST['text'];
                        $photo = $_POST['photo'];
                        $time = time();

                            if(empty($title) AND empty($photo) AND empty($text)) 
                            {
                            echo "Jaizpilda atzīmētie lauki!";                         
                            }else 
                            {
                                $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                $sql = "INSERT INTO news (author, title, text, photo, added_time)
                                VALUES ('$author', '$title', '$text', '$photo', '$time')";
                                    if ($conn->query($sql) === true) {
                                        echo "Jaunas ziņas pievienotas!";
                                    }else {
                                        echo "ERROR: " . $sql . "<br>" . $conn->error;
                                    }
                                $conn->close();
                            }                                           
                    }                   
                }
                // update news version 2 
                else if ($_GET['action'] == 'edit2') 
                {
                    if(isset($_POST['edit_news']))
                    {
                        echo '
                            <script type="text/javascript">
                            window.location = "?acp=news&action=edit2&item='.intval($_POST['news_item']).'"
                            </script>
                        ';
                    }
                    echo '
                    <div class="acpContnet">
                        <b>Izvēlies jaunumus kurus gribi labot:</b> <br><br>
                        <table id="customers">
                            <tr>
                                <th>ID</th>
                                <th>Virsraksts</th>
                                <th>Autors</th>
                                <th>Pievienots</th>
                                <th>Labots</th>
                                <th>Laboja</th>
                                <th>Darbība</th>
                            </tr>
                        ';

                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT * FROM `news` ORDER BY `news_id` DESC";
                        $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {                                
                                while ($data = $result->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>' . $data['news_id'] . '</td>
                                        <td>' . $data['title'] . '</td>
                                        <td>' . $data['author'] . '</td>                                       
                                        <td>' . date("d.m.Y H:i:s", $data['added_time']) . '</td> 
                                        <td>' . date("d.m.Y H:i:s", $data['edited_time']) . '</td>
                                        <td>' . $data['edited_by'] . '</td>
                                        <td>
                                            
                                            <a href="?acp=news&action=edit2&item=' . $data['news_id'] . '">
                                                <img height="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                                            </a>&nbsp;&nbsp;
                                            <a href="?acp=news&action=delete&item=' . $data['news_id'] . '">
                                                <im height="20px" height="20px" alt="delete" src="themes/default/images/icons/application_delete.png" >
                                            </a>
                                        </td>                                        
                                    </tr>';                                                        
                                }
                            
                            }               
                            $conn->close();
                    echo '</table></div>';

                    if(isset($_GET['item']))
                    {
                        $item = intval($_GET['item']);
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT `news_id`, `title`, `photo`, `text` FROM `news` WHERE `news_id` = '".$item."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                            {
                                while ($data = $result->fetch_assoc()) 
                                {

                        ?>
                            <div class="acpContnet">
                                <form action="" method="post">
                                    
                                    <div><b>Jaunumu nosaukums </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="title"  value="<?php echo $data['title']; ?>" size="" /><br/>
                                    <div><b>Jaunumu bilde </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="photo"  value="<?php echo $data['photo']; ?>" size="" /><br/>
                                    <div ><b>Jaunumu texts </b><font color="red">*</font>:<br/></div>                        
                                        <textarea id="text" name="text" style="width:380px;height:150px;"><?php echo $data['text']; ?></textarea><br/>

                                    <input type="submit" name="update_news" value="Labot jaunumus" style="width:100px;" />
                                </form>
                            </div>                            
                        <?php
                                }                            
                        }               
                        $conn->close();
                        if (isset($_POST['update_news'])) 
                        {
                            $title = $_POST['title'];
                            $photo = $_POST['photo'];
                            $text = $_POST['text'];                            
                            $editTime = time();
                            $edited_user = intval($_SESSION['user_id']);
                                if (empty($title) OR empty($photo) OR empty($text)) 
                                {
                                    echo "Visiem laukiem jābūt aizpildītiem";
                                }else 
                                {
                                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                    $sql = "UPDATE news SET 
                                                title = '".$title."',
                                                photo = '".$photo."',
                                                text = '".$text."',
                                                edited_time = '".$editTime."',
                                                edited_by =   '".$edited_user."'
                                            WHERE news_id = '".$item."'
                                            ";
                                        if($conn->query($sql) === true) 
                                        {
                                            echo "Ziņa labota!";
                                        }else 
                                        {
                                            echo "ERROR: " . $sql . "<br>" . $conn->error;
                                        }
                                    $conn->close();  
                                }
                        }
                    }
                }
                // end off version 2 
                
                else if ($_GET['action'] == 'edit') 
                {
                    if(isset($_POST['edit_news']))
                    {
                        echo '
                            <script type="text/javascript">
                            window.location = "?acp=news&action=edit&item='.intval($_POST['news_item']).'"
                            </script>
                        ';
                    }
                    echo '
                            <form action="" method="POST" name="news_itim_select" style="width:100%;float:left;">
                                <b>Izvēlies jaunumus kurus gribi labot:</b> <br>
                                    <select style="width:100px;" name="news_item"> 
                        ';
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT `news_id`, `title` FROM `news` ORDER BY `news_id` DESC";
                        $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {
                                while ($data = $result->fetch_assoc()) {
                                    echo "<option value='".$data['news_id']."'>".$data['title']."</option>";                        
                                }
                            
                            }               
                            $conn->close();
                    echo '</select> <br>
                        <input type="submit" name="edit_news" value="Labot jaunumus" style="width:100px;" />
                        </form>
                        ';
                    if(isset($_GET['item']))
                    {
                        $item = intval($_GET['item']);
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT `news_id`, `title`, `photo`, `text` FROM `news` WHERE `news_id` = '".$item."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                            {
                                while ($data = $result->fetch_assoc()) 
                                {

                        ?>
                            <div class="acpContnet">
                                <form action="" method="post">
                                    
                                    <div><b>Jaunumu nosaukums </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="title"  value="<?php echo $data['title']; ?>" size="" /><br/>
                                    <div><b>Jaunumu bilde </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="photo"  value="<?php echo $data['photo']; ?>" size="" /><br/>
                                    <div ><b>Jaunumu texts </b><font color="red">*</font>:<br/></div>                        
                                        <textarea id="text" name="text" style="width:380px;height:150px;"><?php echo $data['text']; ?></textarea><br/>

                                    <input type="submit" name="update_news" value="Labot jaunumus" style="width:100px;" />
                                </form>
                            </div>                            
                        <?php
                                }                            
                        }               
                        $conn->close();
                        if (isset($_POST['update_news'])) 
                        {
                            $title = $_POST['title'];
                            $photo = $_POST['photo'];
                            $text = $_POST['text'];
                            $editTime = time();
                                if (empty($title) OR empty($photo) OR empty($text)) 
                                {
                                    echo "Visiem laukiem jābūt aizpildītiem";
                                }else 
                                {
                                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                    $sql = "UPDATE news SET 
                                                title = '".$title."',
                                                photo = '".$photo."',
                                                text = '".$text."',
                                                edited_time = '".$editTime."'
                                            WHERE news_id = '".$item."'
                                            ";
                                        if($conn->query($sql) === true) 
                                        {
                                            echo "Ziņa labota!";
                                        }else 
                                        {
                                            echo "ERROR: " . $sql . "<br>" . $conn->error;
                                        }
                                    $conn->close();  
                                }
                        }
                    }
                }else if($_GET['action'] == 'delete')
                {
                    if(isset($_POST['delete_news']))
                    {
                        echo '
                                <script type="text/javascript">
                                    window.location = "?acp=news&action=delete&item='.intval($_POST['news_item']).'"
                                </script>
                            ';
                    }
                    echo '
                        <div class="acpContnet">                      
                            <form action="" method="POST" name="news_item_select">
                                <b>Izvēlies jaunumus kurus gribi dzēst:</b><br>
                                <select name="news_item">
                        ';

                     
                    $item = intval($_GET['item']);
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                        $sql = "SELECT `news_id`, `title` FROM `news` ORDER BY `news_id` DESC";
                            $result = $conn->query($sql);
                                if($result->num_rows > 0) 
                                {
                                    while ($data = $result->fetch_assoc()) 
                                    {
                                        echo "<option value=".$data['news_id']."> ".$data['title']." </option>";
                                    } 
                                }
                    $conn->close();
                    echo '      </select><br>
                                <input type="submit" name="delete_news" value="Izdzēst jaunumus" style="width:200px;" />
                            </form>
                        </div>
                        ';
                    if(isset($_GET['item'])) 
                    {
                        echo '<div class="acpContnet">
                                Vai tiešām tu vēlies izdzēst jaunumus?<br>
                                <form method="POSt" action="" name="delete_confirm">
                                    <input type="submit" name="yes" value="JĀ!" style="width:100px;" />
                                    <input type="submit" name="no" value="NĒ!" style="width:100px;" />
                                </form>
                            ';
                        if(isset($_POST['yes'])) {
                            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                            $sql = "DELETE FROM `news` WHERE `news_id` = '".intval($_GET['item'])."' ";
                                if($conn->query($sql) === true)
                                {
                                echo "Jaunums izdzēsts!";
                                    
                                }else 
                                {
                                    echo "ERROR: " . $sql . "<br>" . $conn->error;
                                }
                            $conn->close();                       
                        }
                        if(isset($_POST['no'])) {
                            echo '<script type="text/javascript">
                                    window.location = "?acp=news&action=delete"
                                  </script>
                                ';
                        }
                        echo "</div>";
                    }
                }               
?> 

        </div>
        <div class="acpContnet">
            <div class="acpContentTitle">
                Galvenā navigācija
            </div>              
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="add" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=nav&action=add_mainNav">Pievienot</a>               
            </div>            
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=nav&action=edit_mainNav">Labot</a>               
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="delete" src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=nav&action=delete_mainNav">Dzēst</a>       
            </div>

            <?php 
                 

                if($_GET['action'] == 'add_mainNav') 
                {
            ?>
             <div class="acpContnet">
                <form action="" method="post">
                    <div><b>Jauna linka nosaukums: </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="name"  value="" size="" /><br/>
                    <div><b>Linka adrese: </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="link"  value="" size="" /><br/>
                    <div ><b>Links Būs redzams ?</b><font color="red">*</font>:<br/><br></div>                        
                                       
                    <input type="radio" name="visible" 
                    <?php if (isset($visible) && $visible == "true") echo "checked";?>
                    value="true"> Jā!
                    <input type="radio" name="visible"
                    <?php if (isset($visible) && $visible == "false") echo "checked";?>
                    value="false"> Nē!                   
                   
                    <br/><br>

                    <input type="submit" name="add_mainNav" value="Nosūtīt" style="width:100px;" />
                </form>
            </div>
            <?php
                    if(isset($_POST['add_mainNav'])) 
                    {
                        $added_by = intval($_SESSION['user_id']);
                        $name = $_POST['name'];
                        $link = $_POST['link'];
                        $visible = $_POST['visible'];
                        $edited_by = "";                        
                        

                            if(empty($name) AND empty($link) AND empty($visible)) 
                            {
                            echo "Jaizpilda atzīmētie lauki!";                         
                            }else 
                            {
                                $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                $sql = "INSERT INTO main_nav (name, link, visible, added_by, edited_time)
                                VALUES ('$name', '$link', '$visible', '$added_by', '$editet_by')";
                                    if ($conn->query($sql) === true) {
                                        echo "Jauns menu links pievienots!";
                                    }else {
                                        echo "ERROR: " . $sql . "<br>" . $conn->error;
                                    }
                                $conn->close();
                            }                                           
                    }                   
                }else if ($_GET['action'] == 'edit_mainNav') 
                {
                    if(isset($_POST['edit_mainNav']))                    
                    ?>                    
                    <div class="acpContnet">
                        <b>Izvēlies Linku kuru gribi labot:</b> <br><br>
                        <table id="customers">
                            <tr>
                                <th>ID</th>
                                <th>Nosaukums</th>                                
                                <th>Links</th>                               
                                <th>Redzamiba</th>
                                <th>Pievienoja</th>                                                            
                                <th>Darbība</th>
                            </tr>                        
                        <?php

                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);                                    
                        $sql =  "SELECT * FROM `main_nav` ORDER BY `nav_id` DESC";
                        mysqli_set_charset($conn, DB_CHARSET);
                        $result = $conn->query($sql);
                        
                            if ($result->num_rows > 0) 
                            {                                
                                while ($data = $result->fetch_assoc()) {                                
                                    echo '
                                    <tr>
                                        <td>' . $data['nav_id'] . '</td>
                                        <td>' . $data['name'] . '</td>
                                        <td>' . $data['link'] . '</td>                                       
                                        <td>' . $data['visible'] . '</td>                                         
                                        <td>' . $data['added_by'] . '</td>
                                        <td>
                                            
                                            <a href="?acp=nav&action=edit_mainNav&item=' . $data['nav_id'] . '">
                                                <img height="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                                            </a>&nbsp;&nbsp;
                                            <a href="?acp=nav&action=delete_mainNav&item=' . $data['nav_id'] . '">
                                                <img height="20px" height="20px" alt="delete" src="themes/default/images/icons/application_delete.png" >
                                            </a>
                                        </td>                                        
                                    </tr>';                                                        
                                }
                            
                            }               
                            $conn->close();
                    echo '</table></div>';

                    if(isset($_GET['item']))
                    {
                        $item = intval($_GET['item']);
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT `nav_id`, `name`, `link`, `visible` FROM `main_nav` WHERE `nav_id` = '".$item."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                            {
                                while ($data = $result->fetch_assoc()) 
                                {

                        ?>
                            <div class="acpContnet">
                                <form action="" method="post">
                                    <?php echo $error_test; ?>
                                    <div><b>Linka nosaukums </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="name"  value="<?php echo $data['name']; ?>" size="" /><br/>
                                    <div><b>Links </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="link"  value="<?php echo $data['link']; ?>" size="" /><br/>
                                    <div ><b>visible</b><font color="red">*</font>:<br/></div>                        
                                    <input type="radio" name="visible" 
                                        <?php if (isset($visible) OR $data['visible'] == "true") echo "checked";?>
                                        value="true"> Jā!
                                        <input type="radio" name="visible"
                                        <?php if (isset($visible) OR $data['visible'] == "false") echo "checked";?>
                                        value="false"> Nē!    
                                    
                                    <br/>

                                    <input type="submit" name="update_main_nav" value="Labot menu" />
                                </form>
                            </div>                            
                        <?php
                                }                            
                        }               
                        $conn->close();
                        if (isset($_POST['update_main_nav'])) 
                        {
                            $name = $_POST['name'];
                            $link = $_POST['link'];
                            $visible = $_POST['visible'];                            
                            $editTime = time();
                           
                                if (empty($name) OR empty($link) OR empty($visible)) 
                                {
                                    echo "Visiem laukiem jābūt aizpildītiem";
                                }else 
                                {
                                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                    $sql = "UPDATE main_nav SET 
                                                name = '".$name."',
                                                link = '".$link."',
                                                visible = '".$visible."',
                                                edited_time = '".$editTime."'                                                
                                            WHERE nav_id = '".$item."'
                                            ";
                                        if($conn->query($sql) === true) 
                                        {
                                            $error_test = "Ziņa labota!";
                                            echo "Ziņa labota!";
                                        }else 
                                        {
                                            echo "ERROR: " . $sql . "<br>" . $conn->error;
                                        }
                                    $conn->close();  
                                }
                        }
                    }
                }else if($_GET['action'] == 'delete_mainNav')
                {
                    if(isset($_POST['delete_mainNav']))
                    {
                        echo '
                                <script type="text/javascript">
                                    window.location = "?acp=nav&action=delete_mainNav&item='.intval($_POST['mainNav_item']).'"
                                </script>
                            ';
                    }
                    ?>
                        <div class="acpContnet">                      
                            <form action="" method="POST" name="todolist_item_select">
                                <b>Izvēlies menu linku kuru gribi dzēst:</b><br>
                                <select name="mainNav_item">
                    <?php

                     
                    $item = intval($_GET['item']);
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                        $sql = "SELECT `nav_id`, `name` FROM `main_nav` ORDER BY `nav_id` DESC";
                            $result = $conn->query($sql);
                                if($result->num_rows > 0) 
                                {
                                    while ($data = $result->fetch_assoc()) 
                                    {
                                        echo "<option value=".$data['nav_id']."> ".$data['name']." </option>";
                                    } 
                                }
                    $conn->close();
                    echo '      </select><br>
                                <input type="submit" name="delete_mainNav" value="Izdzēst no menu saraksta" style="width:200px;" />
                            </form>
                        </div>
                        ';
                    if(isset($_GET['item'])) 
                    {
                        echo '<div class="acpContnet">
                                Vai tiešām tu vēlies izdzēst menu?<br>
                                <form method="POST" action="" name="delete_mainNav_confirm">
                                    <input type="submit" name="yes" value="JĀ!" style="width:100px;" />
                                    <input type="submit" name="no" value="NĒ!" style="width:100px;" />
                                </form>
                            ';
                        if(isset($_POST['yes'])) {
                            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                            $sql = "DELETE FROM `main_nav` WHERE `nav_id` = '".intval($_GET['item'])."' ";
                                if($conn->query($sql) === true)
                                {
                                echo "menu izdzēsts!";
                                    
                                }else 
                                {
                                    echo "ERROR: " . $sql . "<br>" . $conn->error;
                                }
                            $conn->close();                       
                        }
                        if(isset($_POST['no'])) {
                            echo '<script type="text/javascript">
                                    window.location = "?acp=todo&action=delete_todolist"
                                  </script>
                                ';
                        }
                        echo "</div>";
                    }
                }
                ?>

        </div>

               



        <div class="acpContnet">
            <div class="acpContentTitle">
                To do list :)
            </div>              
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="add" src="themes/default/images/icons/application_add.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=todo&action=add_todolist">Pievienot</a>               
            </div>            
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=todo&action=edit_todolist">Labot</a>               
            </div>
            <div class="acpConentButton">
                <img width="20px" height="20px" alt="delete"  src="themes/default/images/icons/application_delete.png" >
                <a href="<?php echo $pageConfig['page_url']; ?>?acp=todo&action=delete_todolist">Dzēst</a>       
            </div>

            <?php 
                if($_GET['action'] == 'add_todolist') 
                {
            ?>
             <div class="acpContnet">
                <form action="" method="post">
                    <div><b>Jauns To do lista nosaukums </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="title"  value="" size="" /><br/>
                    <div><b>To do lista bilde </b><font color="red">*</font>:<br/></div>
                        <input type="text" name="photo"  value="" size="" /><br/>
                    <div ><b>To do lista texts </b><font color="red">*</font>:<br/></div>                        
                        <textarea id="text" name="text" style="width:380px;height:150px;"></textarea><br/>

                    <input type="submit" name="add_todolist" value="Nosūtīt" style="width:100px;" />
                </form>
            </div>
            <?php
                    if(isset($_POST['add_todolist'])) 
                    {
                        $author = intval($_SESSION['user_id']);
                        $title = $_POST['title'];
                        $text = $_POST['text'];
                        $photo = $_POST['photo'];
                        

                            if(empty($title) AND empty($photo) AND empty($text)) 
                            {
                            echo "Jaizpilda atzīmētie lauki!";                         
                            }else 
                            {
                                $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                $sql = "INSERT INTO todolist (author, title, text, photo)
                                VALUES ('$author', '$title', '$text', '$photo')";
                                    if ($conn->query($sql) === true) {
                                        echo "Jaunas ziņas pievienotas!";
                                    }else {
                                        echo "ERROR: " . $sql . "<br>" . $conn->error;
                                    }
                                $conn->close();
                            }                                           
                    }                   
                }else if ($_GET['action'] == 'edit_todolist') 
                {
                    if(isset($_POST['edit_todolist']))                    
                    ?>                    
                    <div class="acpContnet">
                        <b>Izvēlies jaunumus kurus gribi labot:</b> <br><br>
                        <table id="customers">
                            <tr>
                                <th>ID</th>
                                <th>Virsraksts</th>
                                <th>Autors</th>
                                <th>Pievienots</th>
                                <th>Labots</th>
                                <th>Laboja</th>
                                <th>Darbība</th>
                            </tr>                        
                        <?php

                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);                                    
                        $sql =  "SELECT * FROM `todolist` ORDER BY `id` DESC";
                        mysqli_set_charset($conn, DB_CHARSET);
                        $result = $conn->query($sql);
                        
                            if ($result->num_rows > 0) 
                            {                                
                                while ($data = $result->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <td>' . $data['news_id'] . '</td>
                                        <td>' . $data['title'] . '</td>
                                        <td>' . $data['author'] . '</td>                                       
                                        <td>' . date("d.m.Y H:i:s", $data['added_time']) . '</td> 
                                        <td>' . /*date("d.m.Y H:i:s", $data['edited_time']) .*/ '</td>
                                        <td>' . $data['edited_by'] . '</td>
                                        <td>
                                            
                                            <a href="?acp=todo&action=edit_todolist&item=' . $data['id'] . '">
                                                <img height="20px" height="20px" alt="edit" src="themes/default/images/icons/application_edit.png" >
                                            </a>&nbsp;&nbsp;
                                            <a href="?acp=todo&action=delete_todolist&item=' . $data['id'] . '">
                                                <img height="20px" height="20px" alt="delete" src="themes/default/images/icons/application_delete.png" >
                                            </a>
                                        </td>                                        
                                    </tr>';                                                        
                                }
                            
                            }               
                            $conn->close();
                    echo '</table></div>';

                    if(isset($_GET['item']))
                    {
                        $item = intval($_GET['item']);
                        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);            
                        $sql =  "SELECT `id`, `title`, `photo`, `text` FROM `todolist` WHERE `id` = '".$item."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                            {
                                while ($data = $result->fetch_assoc()) 
                                {

                        ?>
                            <div class="acpContnet">
                                <form action="" method="post">
                                    <?php echo $error_test; ?>
                                    <div><b>Jauns To do lista nosaukums </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="title"  value="<?php echo $data['title']; ?>" size="" /><br/>
                                    <div><b>To do lista bilde </b><font color="red">*</font>:<br/></div>
                                        <input type="text" name="photo"  value="<?php echo $data['photo']; ?>" size="" /><br/>
                                    <div ><b>to do Lista teksts</b><font color="red">*</font>:<br/></div>                        
                                        <textarea id="text" name="text" style="width:97.5%;height:260px;"><?php echo $data['text']; ?></textarea><br/>

                                    <input type="submit" name="update_todolist" value="Labot to do listu" style="width:100px;" />
                                </form>
                            </div>                            
                        <?php
                                }                            
                        }               
                        $conn->close();
                        if (isset($_POST['update_todolist'])) 
                        {
                            $title = $_POST['title'];
                            $photo = $_POST['photo'];
                            $text = $_POST['text'];                            
                            $editTime = time();
                            $edited_user = intval($_SESSION['user_id']);
                                if (empty($title) OR empty($photo) OR empty($text)) 
                                {
                                    echo "Visiem laukiem jābūt aizpildītiem";
                                }else 
                                {
                                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                                    $sql = "UPDATE todolist SET 
                                                title = '".$title."',
                                                photo = '".$photo."',
                                                text = '".$text."',
                                                edited_time = '".$editTime."',
                                                edited_user =   '".$edited_user."'
                                            WHERE id = '".$item."'
                                            ";
                                        if($conn->query($sql) === true) 
                                        {
                                            $error_test = "Ziņa labota!";
                                            echo "Ziņa labota!";
                                        }else 
                                        {
                                            echo "ERROR: " . $sql . "<br>" . $conn->error;
                                        }
                                    $conn->close();  
                                }
                        }
                    }
                }else if($_GET['action'] == 'delete_todolist')
                {
                    if(isset($_POST['delete_todolist']))
                    {
                        echo '
                                <script type="text/javascript">
                                    window.location = "?acp=todo&action=delete_todolist&item='.intval($_POST['todolist_item']).'"
                                </script>
                            ';
                    }
                    ?>
                        <div class="acpContnet">                      
                            <form action="" method="POST" name="todolist_item_select">
                                <b>Izvēlies to do Listu kurus gribi dzēst:</b><br>
                                <select name="todolist_item">
                    <?php

                     
                    $item = intval($_GET['item']);
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                        $sql = "SELECT `id`, `title` FROM `todolist` ORDER BY `id` DESC";
                            $result = $conn->query($sql);
                                if($result->num_rows > 0) 
                                {
                                    while ($data = $result->fetch_assoc()) 
                                    {
                                        echo "<option value=".$data['id']."> ".$data['title']." </option>";
                                    } 
                                }
                    $conn->close();
                    echo '      </select><br>
                                <input type="submit" name="delete_todolist" value="Izdzēst no to do lista" style="width:200px;" />
                            </form>
                        </div>
                        ';
                    if(isset($_GET['item'])) 
                    {
                        echo '<div class="acpContnet">
                                Vai tiešām tu vēlies izdzēst to do listu?<br>
                                <form method="POST" action="" name="delete_todolist_confirm">
                                    <input type="submit" name="yes" value="JĀ!" style="width:100px;" />
                                    <input type="submit" name="no" value="NĒ!" style="width:100px;" />
                                </form>
                            ';
                        if(isset($_POST['yes'])) {
                            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                            $sql = "DELETE FROM `todolist` WHERE `id` = '".intval($_GET['item'])."' ";
                                if($conn->query($sql) === true)
                                {
                                echo "to do lists izdzēsts!";
                                    
                                }else 
                                {
                                    echo "ERROR: " . $sql . "<br>" . $conn->error;
                                }
                            $conn->close();                       
                        }
                        if(isset($_POST['no'])) {
                            echo '<script type="text/javascript">
                                    window.location = "?acp=todo&action=delete_todolist"
                                  </script>
                                ';
                        }
                        echo "</div>";
                    }
                }
            ?>



        </div>
</div>

