<?php
require '../config/core.php';


if ($pageConfig['page_offline']) {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title><?php echo $pageConfig['page_name'] ?></title>
    <style>
      body {
        background: #FF5F42;
        font-family: tahoma;
        font-size: 17pt;
        height: 100%;
        margin-top: 60px;
        text-align: center;
        color: #454545;
      }

      a:visited,
      a:active,
      a:hover {
        text-decoration: none;
        color: #454545;
      }
    </style>
  </head>

  <body class="page_off">
    <img src="../themes/puffy/images/pageOff/pngegg.png" width="300px" height="200px">
    <h1><?php echo $pageConfig['page_offlineMsg']; ?></h1>
    <h2><a class="page_off" href="<?php echo $pageConfig['page_url'] ?>">We'll be back shortly.</a></h2>
  </body>

  </html>
<?php
} else {
  header("Location:" . $pageConfig['page_url']);
  die();
}
?>