<?php
    include "koneksi.php";

    if(isset($_POST['daftar']))
    {
          $username = $_POST['username'];
          $password = base64_encode($_POST['password']);
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $nomor_telepon = $_POST['nomor_telepon'];
          $alamat = $_POST['alamat'];
          $status_id = 4;
          $role_id = 1;
          
          // $foto = $_FILES['foto']['name']; //nama file
          // $fileSize = $_FILES['foto']['size']; //ukuran file
          // $fileError = $_FILES['foto']['error']; //
          // $uploaddir='./gambar/';
          // $lokasi=$uploaddir.$foto;
          // if($fileSize > 0 || $fileError == 0)
          // { //Check jika error
          //   $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder
          // }

          $foto = $_FILES['foto']['name']; //nama file
          $fileSize = $_FILES['foto']['size']; //ukuran file
          if ((($_FILES["foto"]["type"] == "image/gif")||($_FILES["foto"]["type"] == "image/jpeg")||
              ($_FILES["foto"]["type"] == "image/pjpeg")))
            {
              $fileError = $_FILES['foto']['error']; //
              $uploaddir='./gambar/';
              $lokasi=$uploaddir.$foto;
              if($fileSize > 0 || $fileError == 0)
              { //Check jika error
              $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder
              }   
            }
          
          $cekuser = mysql_query("SELECT * FROM user WHERE username = '$username'");
          if(mysql_num_rows($cekuser) <> 0) 
          {
            $sql_message = "Username sudah terdaftar.!!";
          } 
          else 
          {
            $simpan = mysql_query("INSERT INTO `user`(`username`, `password`, `nama`, `email`, `nomor_telepon`, `alamat`, `foto`, `status_id`, `role_id`) VALUES ('$username', '$password', '$nama', '$email', '$nomor_telepon', '$alamat', '$foto', '$status_id', '$role_id')");
            if(!$simpan) 
            {
              $sql_message = "Pendaftaran gagal dilakukan..!!";
            }
            else
            {
              header('location:index.php');
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
                                  <span class ="sr-only">Toggle navigation</span>
                                  <span class ="icon-bar"></span>
                                  <span class ="icon-bar"></span>
                                  <span class ="icon-bar"></span>
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
                            Form Pendaftaran Open Recruitment Asisten
                            </div>
                          <div class="panel-body">
                            <div class="container-fluid">
                              <form action="asisten_daftar.php" method="post" enctype="multipart/form-data">
                                <?php
                                  if(isset($sql_message))
                                    {
                                      echo "<center><label for='exampleInputPassword1'>";
                                      echo $sql_message;
                                      echo "</label></center>";
                                    }
                                  ?>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">NIM</label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIM" name="username" required>
                                </div>                  
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nama</label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
                                </div>                  
                                <div class="form-group">
                                  <label for="exampleInputPassword1">No.HP</label>
                                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="No.HP" name="nomor_telepon" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Alamat</label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat" name="alamat" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">Bukti Transkip Nilai (JPG, PNG, JPEG)</label>
                                  <input type="file" id="exampleInputFile" name="foto">  
                                </div> 
                                <center>
                                  <a href="index.php" class='btn btn-danger' style='width:15%' >Kembali</a>
                                  <button type="submit" class='btn btn-primary' style='width:15%' id="daftar" name="daftar" value="Daftar">Daftar</button>
                                </center>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </body>
  </html>