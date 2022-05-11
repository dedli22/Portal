<?php 

// Main page configuration 
$pageConfig = [
    'page_name' => 'Social portāls',
    'page_url' => 'http://localhost/hosts/project/portal_v2/',
    'page_offline' => false,
    'page_offlineMsg' => 'Sorry we\'re down for maintenance.!',
    'page_version' => '0.1',
    'page_errorReport' => 'yes',
    'page_newsPerPage' => '3',
];

// Database  configuration
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', '');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'portal');
   define('DB_CHARSET', 'utf8mb4');

// Database connection   
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
mysqli_set_charset($conn, DB_CHARSET);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mysql!<br>";
        echo "Error: " . mysqli_connect_error();
        exit();
    } 

?>