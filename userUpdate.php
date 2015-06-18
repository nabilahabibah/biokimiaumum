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
        if(isset($_POST['update']))
        {
          $username = $_POST['username'];
          $query = mysql_query("SELECT * FROM user JOIN STATUS ON user.status_id = status.status_id WHERE username = '$username'");
          $user = mysql_fetch_assoc($query);
          $nama = $user['nama'];
          $nomor_telepon = $user['nomor_telepon'];
          $email = $user['email'];
          $alamat = $user['alamat'];
          $foto = $user['foto'];
          $status_id = $user['status_id'];
        }
        elseif (isset($_POST['updateUser'])) 
        {
          $usernameUpdate = $_POST['username'];
          $status_id = $_POST['status_id'];
          $query = mysql_query("UPDATE user SET status_id=$status_id WHERE username=$usernameUpdate");
          if(!$query) 
          {
            $sql_message = "Status user gagal di update !!";
          }
          else
          {
            if ($status_id==1||$status_id==2||$status_id==3) 
            {
              header('location:praktikan.php');
            }
            else
            {
              header('location:asisten.php');
            }            
          }
        }
        
        ?>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center">
              Form Update User
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <form action="userUpdate.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIM</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIM" name="username" value="<?php echo $username?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" value="<?php echo $nama?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="<?php echo $email?>" readonly>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">No.HP</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="No.HP" name="nomor_telepon" value="<?php echo $nomor_telepon?>"required readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status Sekarang</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Status" name="status_keterangan" value="<?php echo $user['status_keterangan'];?>" required readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status Baru</label>
                    <select type="text" class="form-control" id="exampleInputEmail1" placeholder="status_id" name="status_id">
                          <?php
                          $query= mysql_query("select * from status");
                            while($row = mysql_fetch_assoc($query))
                            {
                              if (($row["status_id"])==6 ||($row["status_id"])==7 ){
                                continue;
                              }
                              echo "<option value=".$row["status_id"].">".$row["status_keterangan"]."</option>";
                            }
                          ?>
                        </select>
                  </div>
                  <center>
                    <a href="praktikan.php" class='btn btn-danger' style='width:15%' >Kembali</a>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="updateUser" name="updateUser" value="updateUser">update</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>  
  </div>
  </body>  
</html>