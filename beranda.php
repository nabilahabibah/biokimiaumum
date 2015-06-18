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

<!-- Menu -->
    <?php
if(!isset($_SESSION['username']))
{
  header('location:index.php');
}
else
{
  $username = $_SESSION['username'];
}
  require_once("koneksi.php");
  $query = mysql_query("SELECT * FROM user WHERE username = '$username'");
  $hasil = mysql_fetch_array($query);
  $nama = $hasil['nama'];
  $password = base64_decode($hasil['password']);
  $nomor_telepon = $hasil['nomor_telepon'];
  $email = $hasil['email'];
  $alamat = $hasil['alamat'];
  $foto = $hasil['foto'];
  $status = $hasil['status_id'];
?>
<div id="navbar-top">
  <nav class="navbar navbar-default navbar-static" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="beranda.php">Laboratorium Matakuliah Biokimia Umum</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="beranda.php">Beranda</a></li>
          <?php
          switch ($status) {
          case '2':
          echo "
          <li><a href='jadwal.php'>Jadwal</a></li>
          <li><a href='kelompok.php'>Kelompok</a></li>";
          break;

          case '3':
          echo "
          <li><a href='jadwal.php'>Kelompok</a></li>";
          // <li><a href='kelompok.php'>Kelompok</a></li>"
          break;

          case '5':
          echo "
          <li><a href='jadwal.php'>Kelompok</a></li>
          <li><a href='nilai.php'>Nilai</a></li>";
          break;

          case '6':
          echo "
          <li><a href='jadwal.php'>Kelompok</a></li>
          <li><a href='nilai.php'>Nilai</a></li>
          <li><a href='asisten.php'>Asisten</a></li>
          <li><a href='praktikan.php'>Praktikan</a></li>";
          break;

          case '7':
          echo "<li><a href='nilai.php'>Nilai</a></li>";
          break;

          default:
          break;
          }
          ?>
          <li><a href="index.php">Keluar</a></li>
        </ul>
      </div> <!--/.navbar-collapse-->
    </div><!-- /.container-fluid -->
  </nav>
</div>

<!-- Sidebar -->
<div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <ul class="list-group">                  
                <li class="list-group-item">
              <center>
                <?php
                  if ($foto==null) 
                  {
                ?>
                      <img src="gambar/default.JPG?>" class="img-responsive" alt="Responsive image" style="width:70%;height:70%">
                <?php
                  }
                  else
                  {
                ?>
                      <img src="gambar/<?php echo $foto ?>" class="img-responsive" alt="Responsive image" style="width:70%;height:70%">
                <?php
                  }
                ?>
                
              </center>
            </li>               
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-2 col-xs-2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-xs-10">
                      <?php
                        echo $nama;
                      ?>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-2 col-xs-2"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-xs-10">
                      <?php
                        echo $nomor_telepon;
                      ?>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-2 col-xs-2"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-xs-10">
                      <?php
                        echo $email;
                      ?>  
                    </div>
                  </div>
                </li> 
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-2 col-xs-2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-10 col-xs-10">
                      <?php
                        echo $alamat;
                      ?>
                    </div>
                  </div>
                </li>
                
                <?php
                echo "<input type='hidden' value='".$username."' name=username>";?>
                <form action='updateProfil.php' method='post'> 
                <li class="list-group-item">
                  <center>
                    <a href="updateProfil.php" class='btn btn-primary' style='width:50%' id="update" name="update" value="update">Update Profil</a>
                  </center>
                </li>
                </form>
                <?php
                if ($status==6) 
                {
                  ?>
                    <li class="list-group-item">
                      <center>
                        <a href="tambahBerita.php" class='btn btn-primary' style='width:50%' id="tambah" name="tambah" value="tambah">Tambah Berita</a>
                      </center>
                    </li>
                  <?php
                }
                ?>                 
              </ul>
            </div>
          </div>
        </div>

<!-- Berita -->
<div class="row">
    <div class="col-md-7">
        <?php
            $berita = mysql_query("SELECT COUNT(*) as jumlah FROM berita");
            $total = mysql_fetch_assoc($berita);
            $totalfix = $total['jumlah'];
            if ($totalfix==0) 
                {
                    echo "
                    <div class='panel panel-default'>
                    <div class='panel-body'>
                    <div class='col-md-12'><center><img src='img/happy-face.PNG' class='img-responsive' alt='Responsive image' style='width:30%;height:30%'></center></div>
                    <div class='col-md-12'>
                    <b><p align='justify'>Belum ada berita yang ditambahkan .. </p></b>
                    </div>
                    </div>
                    ";
                }
            else
            {
                $query = mysql_query("SELECT * FROM berita ORDER BY berita_id desc");
                while($hasil = mysql_fetch_assoc($query))
                {
                    $berita_id = $hasil['berita_id'];
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
                        <div class='col-md-4'><p align='left'>".$berita_tanggal."</p><center><img src='img/".$foto."' class='img-responsive' alt='Responsive image' style='width:70%;height:70%'></center></div>
                        <div class='col-md-8'>
                        
                        <p align='justify'>".substr($berita_isi,0, 250)."...</p>
                        <a href='beritaDetail.php?berita_id=".$berita_id."' class='btn btn-danger' style='width:20%'>Read More</a>
                        </div>";
                        if ($berita_file<>null) {
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
            }
            
        ?>
    </div>
</div>
  </body>  
</html>