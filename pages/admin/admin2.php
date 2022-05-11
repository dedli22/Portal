<?php  
require_once ('config/core.php');
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
                                                <img height="20px" src="themes/default/images/icons/application_edit.png" >
                                            </a>&nbsp;&nbsp;
                                            <a href="?acp=news&action=delete&item=' . $data['news_id'] . '">
                                                <img height="20px" src="themes/default/images/icons/application_delete.png" >
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
            ?>



        </div>
</div>

