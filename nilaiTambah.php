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

    <?php
      if(isset($_POST['masuk']))
      {
        $username = $_POST['username'];
        $nilai_responsi = $_POST['nilai_responsi'];
        $nilai_praktikum = $_POST['nilai_praktikum'];
        $nilai_laporanAwal = $_POST['nilai_laporanAwal'];
        $nilai_laporanAkhir = $_POST['nilai_laporanAkhir'];
        $nilai_ujianPraktikum = $_POST['nilai_ujianPraktikum'];
        $nilai_Total = ($nilai_responsi+$nilai_praktikum+$nilai_laporanAwal+$nilai_laporanAkhir+$nilai_ujianPraktikum)/5;
        
         $cekuser = mysql_query("SELECT * FROM user WHERE username = '$username'");
          if(mysql_num_rows($cekuser) <> 0) 
          {
            $nilai = mysql_query("INSERT INTO `nilai`(`username`,`nilai_responsi`, `nilai_praktikum`, `nilai_laporanAwal`, `nilai_laporanAkhir`, `nilai_ujianPraktikum`, `nilai_Total`) VALUES ($username,$nilai_responsi,$nilai_praktikum,$nilai_laporanAwal,$nilai_laporanAkhir,$nilai_ujianPraktikum,$nilai_Total)");
            $sql_message = "User dengan NIM ".$username." nilai telah diinputkan";
          }
          else
          {
            $sql_message = "User dengan NIM ".$username." belum terdaftar sebagai praktikan";
          }
      }
    ?>
  <div class="row">
      <div class="col-md-offset-3  col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><center><b>Tambah Nilai Praktikan</b></center></div>
            <div class="panel-body">
              <div class="container-fluid">
                <form action="nilaiTambah.php" method="post" enctype="multipart/form-data">
                  <?php
                  if(isset($sql_message))
                    {
                      echo "<center><label for='exampleInputPassword1'>";
                      echo $sql_message;
                      echo "</label></center>";
                    }
                  ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Induk Mahasiswa</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Induk Mahasiswa" name="username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Akhir Responsi</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Akhir Responsi" name="nilai_responsi">
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Akhir Praktikum</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Akhir Praktikum" name="nilai_praktikum">
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Akhir Laporan Awal</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Akhir Laporan Awal" name="nilai_laporanAwal">
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Akhir Laporan Akhir</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Akhir Laporan Akhir" name="nilai_laporanAkhir">
                  </div> 
                  <?php
                  if ($status==6) {
                    ?>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Ujian Akhir Praktikuum</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Ujian Akhir Praktikuum" name="nilai_ujianPraktikum">
                    </div> 
                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Ujian Akhir Praktikuum</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Ujian Akhir Praktikuum" name="nilai_ujianPraktikum" readonly>
                    </div> 
                    <?php
                  }
                  ?>
                  
                  <center>
                    <button type="reset" class='btn btn-danger' style='width:15%' id="reset" name="reset" value="Batal">Batal</button>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="masuk" name="masuk" value="masuk">Input</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>