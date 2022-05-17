<nav class="headerNavigation">
    <ul>
        <?php
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $sql = "SELECT * FROM `main_nav` ORDER BY `link_order` DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($data = $result->fetch_assoc()) {
                $visible = $data['visible'];
                if ($visible = true) {
        ?>
                    <li><a href="<?php echo $data['link']; ?>"><?php echo $data['name']; ?></a></li>
        <?php
                } else {
                    echo `false`;
                }
            }
        }
        ?>
    </ul>
</nav>
