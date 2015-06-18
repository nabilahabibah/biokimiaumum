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
      include"menu.php";
      include "sidebar.php";
      if (isset($_POST['update'])) 
        {
          $usernameUpdate = $_POST['username'];
          $password = base64_encode($_POST['password']);
          $nama = $_POST['nama'];
          $email = $_POST['email'];
          $nomor_telepon = $_POST['nomor_telepon'];
          $alamat = $_POST['alamat'];
          
          $foto = $_FILES['foto']['name']; //nama file
          $fileSize = $_FILES['foto']['size']; //ukuran file
          $fileError = $_FILES['foto']['error']; //
          $uploaddir='./gambar/';
          $lokasi=$uploaddir.$foto;
          if($fileSize > 0 || $fileError == 0)
          { //Check jika error
            $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder
          }
            if ($foto==null) 
            {
              $query = mysql_query("UPDATE `user` SET `password`='$password',`nama`='$nama',`email`='$email',`nomor_telepon`='$nomor_telepon',`alamat`='$alamat' WHERE username='$usernameUpdate'");
            }
            else
            {
              $query = mysql_query("UPDATE `user` SET `password`='$password',`nama`='$nama',`email`='$email',`nomor_telepon`='$nomor_telepon',`alamat`='$alamat',`foto`='$foto' WHERE username='$usernameUpdate'");
            }
        }
      ?>
      <div class="row">
        <div class="col-md-7">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center">
              Form Update Profil
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <form action="updateProfil.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIM</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIM" name="username" value="<?php echo $username?>" readonly>
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" value="<?php echo $password?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" value="<?php echo $nama?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="<?php echo $email?>">
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">No.HP</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="No.HP" name="nomor_telepon" value="<?php echo $nomor_telepon?>"required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat" name="alamat" value="<?php echo $alamat?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
                    <input type="file" id="exampleInputFile" name="foto">  
                  </div> 
                  <center>
                    <button type="reset" class='btn btn-danger' style='width:15%' id="reset" name="reset" value="Batal">Batal</button>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="update" name="update" value="update">Update</button>
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