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

<!-- Kelola Praktikan -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="panel panel-default">
          <div class="panel-heading"><center><b>Daftar Praktikan </b></center></div>
            <div class="panel-body">
              <center>
                <table class="table">
                <tr>
                  <td><b><center>Nomor Induk Mahasiswa</center></b></td>
                  <td><b><center>Nama</center></b></td>
                  <td><b><center>Email</center></b></td>
                  <td><b><center>Nomor Telepon</center></b></td>
                  <td><b><center>Status</center></b></td>
                  <td><b><center>Aksi</center></b></td>
                </tr>
                <?php
                $query = mysql_query("SELECT * FROM user JOIN STATUS ON user.status_id = status.status_id WHERE user.status_id =1 OR user.status_id =2 OR user.status_id =3");
                while($hasil = mysql_fetch_assoc($query))
                {
                echo "
                <tr>
                  <td><center>".$hasil['username']."</center></td>
                  <td><center>".$hasil['nama']."</center></td>
                  <td><center>".$hasil['email']."</center></td>
                  <td><center>".$hasil['nomor_telepon']."</center></td>
                  <td><center>".$hasil['status_keterangan']."</center></td>
                  <form action='userUpdate.php' method='post'>
                  <input type='hidden' value='".$hasil['username']."' name=username>
                  <td><center><button type='submit' class='btn btn-primary' style='width:100%' id='update' name='update' value='update'>Update</button></center></td>
                  </form>
                </tr>
                ";
                }
                ?>
                </table>
              </center>
            </div>
          </div>
        </div>
      <div class="col-md-1"></div>
    </div> 
  </body>
</html>