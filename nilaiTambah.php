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
      include "menu.php";
      if(isset($_POST['masuk']))
      {
        $username = $_POST['username'];
        $nilai_Total = $_POST['nilai_Total'];
        
         $cekuser = mysql_query("SELECT * FROM user WHERE username = '$username'");
          if(mysql_num_rows($cekuser) <> 0) 
          {
            $nilai = mysql_query("INSERT INTO `nilai`(`username`, `nilai_Total`) VALUES ($username,$nilai_Total)");
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
                    <label for="exampleInputEmail1">Nilai Total Praktikum</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nilai Total Praktikum" name="nilai_Total">
                  </div>
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