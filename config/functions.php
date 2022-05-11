<?php 

require_once ('config/core.php');

ob_start();
session_start();

//Page offline 
function page_off($off) {
  if($off === true){
      return header("Location: pages/offlinePage.php");      
  }
}

// manuāli iedodam user id 1 jo datubāzē 1 lietotājs 
$user_id = 1;
$_SESSION['user_id']=$user_id;


// atlasīt lietotāju pēc ID 
function getUserData($data) {
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$sql = "SELECT $data FROM users WHERE `id`='".$_SESSION['user_id']."'";
mysqli_set_charset($conn, DB_CHARSET);
$result =  $conn->query($sql);

if ($result->num_rows > 0) {
  while ($data = $result->fetch_assoc()) {
   foreach($data as $value) {
       echo $value;
   }
  }      
}  
}
$conn->close();


?> 