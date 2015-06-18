<?php
  session_start();
  require_once("koneksi.php");
  unset($_SESSION['username']);
if(isset($_POST['masuk']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pw = base64_encode($password);
    $cekuser = mysql_query("SELECT * FROM user WHERE username = '$username'");
    $jumlah = mysql_num_rows($cekuser);
    $hasil = mysql_fetch_array($cekuser);
    
    $status = $hasil['status_id'];
    $role = $hasil['role_id'];
  if($jumlah == 0) 
  {
    $sql_message = "Username yang Anda inputkan tidak terdaftar !!";
  }
  else
  {
    if($pw <> $hasil['password'])
    {
      $sql_message = "Password yang Anda masukkan salah !!";
    }
    else
    {
      if ($_SESSION['username'] = $hasil['username'])
      {
        if ($role==2||$status==8)
        {
          $sql_message = "Maaf, Anda tidak diizinkan untuk melakukan Login !!";
        }
        else
        {
          header('location:beranda.php');
        }
      }
    }
  }
}
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
            <a class="navbar-brand" href="asisten_beranda.php">Laboratorium Matakuliah Biokimia Umum</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php">Beranda</a></li>
              <li><a href="praktikan_daftar.php">Praktikan</a></li>
              <li><a href="asisten_daftar.php">OR Laboratorium</a></li>
              <li><a href="login.php">Masuk</a></li>
            </ul>
          </div> <!--/.navbar-collapse-->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
    <div class="row">
      <div class="col-md-offset-3  col-md-6" style="top:50px">
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align:center">
          Form Login
          </div>
        <div class="panel-body">
          <div class="container-fluid">
            <form action="login.php" method="post" enctype="multipart/form-data">
            <?php
              if(isset($sql_message))
              {
                echo "<center><label for='exampleInputPassword1'>";
                echo $sql_message;
                echo "</label></center>";
              }
            ?>
            
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>                  
            <center>
              <a href="index.php" class='btn btn-danger' style='width:15%' >Kembali</a>
              <button type="submit" class='btn btn-primary' style='width:15%' id="masuk" name="masuk" value="masuk">Masuk</button>
            </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
