
<nav class="headerNavigation">
    <ul>
        <?php 
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql = "SELECT * FROM `main_nav`";
        $result = $conn->query($sql);
            if ($result->num_rows > 0 )
            {
                
                while ($data = $result->fetch_assoc())
                {
                    $visible = $data['visible'];
                    if ($visible = true) 
                    {
                        ?>
                        <li><a href="<?php echo $data['link']; ?>"><?php echo $data['name']; ?></a></li> 
                        <?php
                    }else
                    {
                       echo `false`;
                    }                    
                }
            }
        ?>
    </ul>
</nav>


 <!-- <nav class="headerNavigation">
            <ul>           
                <li><a href="?acp">Admin</a></li>                
                <li><a href="#">contact</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="?news">home</a></li>                
            </ul>
</nav> -->