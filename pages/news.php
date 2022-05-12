<div id="newsContainer">
 <?php

//news lapa atsevišķi pēc ID 
if ($_GET['item']) 
                {
                    $item = intval($_GET['item']);
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);                         
                    $query = "SELECT * FROM news WHERE `news_id` = '".$item."' " ;
                    $result = mysqli_query($conn, $query);   
                        while ($row = mysqli_fetch_array($result)) 
                        {
                        ?>
                            <div class="newsContent">
                                <div class="newsTitle">            
                                    <?php echo $row['title'] ?>
                                </div>                 
                                <img class="newsImage" src="<?php echo $row['photo'] ?>"/>
                                <div class="newsArticle">
                                    <?php echo $row['text']; ?>             
                                </div>          
                            </div>
                        <?php                 
                        }
                    $conn->close();
                }else {                

                    //database connection  
                    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);  
                    if (! $conn) {  
                    die("Connection failed" . mysqli_connect_error());  
                    }  
                    else {  
                mysqli_select_db($conn, 'pagination');  
                    }  
                
                    //define total number of results you want per page
                
                    $results_per_page = $pageConfig['page_newsPerPage'];
                
                    //find the total number of results stored in the database  
                    $query = "select * from news ORDER BY `news_id` DESC";  
                    $result = mysqli_query($conn, $query);  
                    $number_of_result = mysqli_num_rows($result);  
                
                    //determine the total number of pages available  
                    $number_of_page = ceil ($number_of_result / $results_per_page);

                
                    //determine which page number visitor is currently on  
                    if (!isset ($_GET['page']) ) {  
                        $page = 1;                
                    } else {  
                        $page = $_GET['page']; 
                        
                        
                    }  
                
                    //determine the sql LIMIT starting number for the results on the displaying page  
                    $page_first_result = ($page-1) * $results_per_page;  
                
                    //retrieve the selected results from database   
                    $query = "SELECT * FROM news ORDER BY `news_id`  DESC LIMIT " . $page_first_result . ',' . $results_per_page;
                    $result = mysqli_query($conn, $query);  
                    
                    //display the retrieved result on the webpage  
                    while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <div class="newsContent">
                        <div class="newsTitle">            
                            <?php echo $row['title'] ?>
                        </div>                 
                        <img class="newsImage" width="328px" height="248px" alt="News Image" src="<?php echo $row['photo'] ?>"/>
                        <div class="newsArticle">
                            <?php echo substr_replace($row['text'], "...", 1000); ?>             
                        </div>                
                        <button class="read_more" onclick="location.href='?news&item=<?php echo $row['news_id'] ?>'" type="submit" value="Lasīt vairāk...">
                            Lasīt vairāk...
                        </button>  
                    </div>

                        <?php          
                    }  
                
                
                    //display the link of the pages in URL  
                    for($page = 1; $page<= $number_of_page; $page++) {  
                        echo '<div class="pagination">
                                <a href = "?news&page=' . $page . '">' . $page . ' </a>
                            </div>';  
                    }  
                }
                ?>  
                </div>

