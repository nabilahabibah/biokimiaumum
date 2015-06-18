<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Biokimia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <script src="http://code.jquery.com/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
      <?php
        include "menu.php";
        include "sidebar.php";
        include "berita.php";
        if(isset($_POST['hapus']))
            {
                $berita_id= $_POST['berita_id'];
                $query = mysql_query("DELETE FROM `berita` WHERE berita_id=$berita_id");
                
                if ($query) {
                    header("location:beranda.php");
                }
            }
        ?>
  </body>  
</html>