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
        
<!-- Jadwal Update -->
      <?php

        if (isset($_POST['update'])) 
        {
          $jadwal_id = $_POST['jadwal_id'];
          $query = mysql_query("SELECT * FROM jadwal WHERE jadwal_id=$jadwal_id");
          $jadwal = mysql_fetch_assoc($query);
          $kelompok = $jadwal['kelompok'];  
        }        
        ?>
        <div class="row">
        <div class="col-md-7">
          <div class="panel panel-default">
        <div class='panel-heading'>
                  <center><b>Tambah Kelompok</b></center>
                  </div>
                  <div class='panel-body'>
                    <form action="jadwalUpdate.php" method="post" enctype="multipart/form-data">
                        <?php
                        if(isset($sql_message))
                          {
                            echo "<center><label for='exampleInputPassword1'>";
                            echo $sql_message;
                            echo "</label></center>";
                          }
                        ?>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kelompok</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kelompok" name="kelompok" value="<?php echo $kelompok;?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Hari</label>
                          <select type="text" class="form-control" id="exampleInputEmail1" placeholder="hari" name="jadwal_hari">
                              <option value="Senin">Senin</option>
                              <option value="Selasa">Selasa</option>
                              <option value="Rabu">Rabu</option>
                              <option value="Kamis">Kamis</option>
                              <option value="Jumat">Jumat</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Shift</label>
                          <select type="text" class="form-control" id="exampleInputEmail1" placeholder="shift" name="jadwal_shift">
                              <option value="08.00 - 10.00">08.00 - 10.00</option>
                              <option value="10.00 - 12.00">10.00 - 12.00</option>
                              <option value="13.00 - 15.00">13.00 - 15.00</option>
                              <option value="16.00 - 18.00">16.00 - 18.00</option>
                          </select>
                        </div>
                        <center>
                          <button type="reset" class='btn btn-danger' style='width:15%' id="reset" name="reset" value="Batal">Batal</button>
                          <button type="submit" class='btn btn-primary' style='width:15%' id="update1" name="update1" value="update1">Update</button>
                        </center>
                    </form>
                  </div>
                  </div>
                  </div>
                  </div>
  </body>  
</html>
<?php
    if (isset($_POST['update1'])) 
        {
          $kelompok = $_POST['kelompok']; 
          $jadwal_hari = $_POST['jadwal_hari']; 
          $jadwal_shift = $_POST['jadwal_shift']; 
          $update1 = mysql_query("UPDATE `jadwal` SET `jadwal_hari`='$jadwal_hari',`jadwal_shift`='$jadwal_shift' WHERE kelompok=$kelompok");
          if ($update1) {
            echo "lalalal";
          }
        }
?>