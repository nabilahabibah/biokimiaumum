<?php
session_start();
require_once("koneksi.php");
unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Biokimia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  </head>
  <!-- <body  background="img/bg.gif"> -->
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
            <a class="navbar-brand" href="index.php">Laboratorium Matakuliah Biokimia Umum</a>
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
    <div class="container">
      <div class="content cover text-center">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="animated hiding" data-animation="fadeInDown" data-delay="300">Praktikum Matakuliah Biokimia Umum</h1>
            <h3 class="animated hiding" data-animation="fadeIn" data-delay="600">Jurusan Teknologi Hasil Pertanian</h3>
            <h1 class="animated hiding" data-animation="fadeIn" data-delay="600">Fakultas Teknologi Pertanian</h1>
            <img src="img/uu.PNG" width="20%" height="20%">
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
