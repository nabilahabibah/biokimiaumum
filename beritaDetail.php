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
        ?>
        <div class="row">
            <div class="col-md-7">
            <?php
              $berita_id = abs(intval($_GET['berita_id']));
              $query = mysql_query("SELECT * FROM berita WHERE berita_id='$berita_id' LIMIT 1");
              while($hasil = mysql_fetch_array($query))
              {
                $berita_judul=$hasil['berita_judul'];
                $berita_tanggal=$hasil['berita_tanggal'];
                $berita_isi=$hasil['berita_isi'];
                $foto=$hasil['foto'];
                $berita_file=$hasil['berita_file'];
                if ($foto==null)
                {
                  $foto='contactPerson.PNG';
                }
                else
                {
                  $foto=$hasil['foto'];
                }
                echo "
                <div class='panel panel-default'>
                <div class='panel-heading'><center><b>".$berita_judul."</b></center></div>
                <div class='panel-body'>
                <div class='col-md-12'><p align='left'>".$berita_tanggal."</p></div>
                <div class='col-md-12'><center><img src='img/".$foto."' class='img-responsive' alt='Responsive image' style='width:40%;height:40%'></center></div><br>
                <div class='col-md-12'>
                <br><p align='justify'>".$berita_isi."</p>
                </div>";
                if ($berita_file<>null) 
                {
                    echo "
                    <div class='col-md-12'>
                    <a href='dokumen/".$berita_file."'>Download ".$berita_file."</a>
                    </div>
                    ";
                }
                    echo "
                    </div>
                    </div>
                    " ;
              }
            ?>
            </div>
        </div>
    </body>
</html>
