
<div class="newsContent">
    <?php
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $sql = "SELECT * FROM `todolist`";
    $result = mysqli_query($conn, $sql);
        if($result) 
        {
            while($data = mysqli_fetch_assoc($result))
                {            
                    ?>
                    <div class="newsTitle" style="font-size: 20px;">
                            <h1>
                                <?php echo $data['title']; ?>      
                            </h1>
                    </div>
                    <img class="newsImage" width="328px" height="248px" alt="News Image" src="<?php echo $data['photo'] ?>"/>
                    <div class="newsArticle">
                        <?php echo $data['text'];
                         echo 'Pagaidu progress: <b>10%</b>&nbsp;'; 
                        // Projekta uzsākšanas laiks
                        $d = new DateTime('26-04-2022'); 
                        $n = new DateTime();
                        $interval = $d->diff($n);
                        echo $interval->format('un projekts tiek taisits jau %a naktis!');
            ?>  
                    </div> 
                <?php        
                }
        }
    ?>
</div>






