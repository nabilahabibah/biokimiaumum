<?php
session_start();
include "koneksi.php";
if(!isset($_SESSION['username'])) 
  {
  header('location:index.php'); 
  }
else 
  { 
    $username = $_SESSION['username']; 
  }

    if(isset($_POST['tambah']))
    {
       $berita_judul = $_POST['berita_judul'];
       $berita_isi = $_POST['berita_isi'];
       $berita_tanggal = date('Y-m-d');
       
// $foto = $_FILES['foto']['name']; //nama file
//           $fileSize = $_FILES['foto']['size']; //ukuran file
//           $fileError = $_FILES['foto']['error']; //
//           $uploaddir='./img/';
//           $lokasi=$uploaddir.$foto;
//           if($fileSize > 0 || $fileError == 0){ //Check jika error
//          $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder

          $foto = $_FILES['foto']['name']; //nama file
          $fileSize = $_FILES['foto']['size']; //ukuran file
          if ((($_FILES["foto"]["type"] == "image/gif")||($_FILES["foto"]["type"] == "image/jpeg")||
              ($_FILES["foto"]["type"] == "image/pjpeg")))
            {
              $fileError = $_FILES['foto']['error']; //
              $uploaddir='./img/';
              $lokasi=$uploaddir.$foto;
              if($fileSize > 0 || $fileError == 0)
              { //Check jika error
              $move = move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi); //save gambar ke folder
              }   
            }

            $file = $_FILES['file']['name']; //nama file
            $fileSize = $_FILES['file']['size']; //ukuran file
            if ((($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/jpeg")||
                ($_FILES["file"]["type"] == "image/pjpeg")))
              {
                $fileError = $_FILES['file']['error']; //
                $uploaddir='./file/';
                $lokasi=$uploaddir.$file;
                if($fileSize > 0 || $fileError == 0)
                { //Check jika error
                $move = move_uploaded_file($_FILES['file']['tmp_name'],$lokasi); //save gambar ke folder
                }   
              }

          // $file = $_FILES['file']['name']; //nama file    
          //  $fileSize = $_FILES['file']['size']; //ukuran file 
          //  if ((($_FILES["file"]["type"] == "application/zip")||($_FILES["file"]["type"] == "application/pdf")||
          //     ($_FILES["file"]["type"] == "application/msword")))
          //  {
          //     $fileError = $_FILES['file']['error']; //
          //     $uploaddir='./file/';
          //     $lokasi=$uploaddir.$file;
          //     if($fileSize > 0 || $fileError == 0)
          //     { //Check jika error
          //     $move = move_uploaded_file($_FILES['file']['tmp_name'],$lokasi); //save gambar ke folder
          //     }
          //  }
       

      $simpan = mysql_query("INSERT INTO `berita` (berita_judul,berita_tanggal,berita_isi,berita_file,foto,username) VALUES ('$berita_judul','$berita_tanggal','$berita_isi','$file','$foto','$username')");
      if(!$simpan) 
      {
        $sql_message = "Berita gagal ditambahkan !!";
      }
      else
      {
        header('location:beranda.php');
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
      <?php
      include"menu.php";
      include "sidebar.php";
      ?>
      <div class="row">
        <div class="col-md-7">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center">
              Form Tambah Berita
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <form action="tambahBerita.php" method="post" enctype="multipart/form-data">
                  <?php
                  if(isset($sql_message))
                    {
                      echo "<center><label for='exampleInputPassword1'>";
                      echo $sql_message;
                      echo "</label></center>";
                    }
                  ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Judul Berita</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Berita" name="berita_judul">
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Isi Berita</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Isi Berita" name="berita_isi">
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputFile">Foto Berita</label>
                    <input type="file" id="exampleInputFile" name="foto">  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File Berita</label>
                    <input type="file" id="exampleInputFile" name="file">  
                  </div>
                  <center>
                    <a href="beranda.php" class='btn btn-danger' style='width:15%' >Kembali</a>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="tambah" name="tambah" value="tambah">Tambah</button>
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