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
        ?>
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center">
              Absen Praktikum Matakuliah Biokimia Umum
            </div>
            <div class="panel-body">
              <div class="container-fluid">
                <table class="table">
                <tr>
                  <td><b><center>Nomor Induk Mahasiswa</center></b></td>
                  <td><b><center>Nama</center></b></td>
                  <td><b><center>Kelompok</center></b></td> 
                </tr>
                <?php
                $query1 = mysql_query("SELECT * FROM user JOIN jadwal_user ON user.username = jadwal_user.username JOIN jadwal ON jadwal_user.jadwal_id = jadwal.jadwal_id WHERE user.status_id=2 order by kelompok");
                while($row = mysql_fetch_assoc($query1))
                {
                  echo "
                  <tr>
                    <td><center>".$row['username']."</center></td>
                    <td><center>".$row['nama']."</center></td>  
                    <td><center>".$row['kelompok']."</center></td>  
                  </tr>";
                }
                ?>
              </table>
                <form action="absenTampil.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Cetak</label>
                    <select type="text" class="form-control" id="exampleInputEmail1" placeholder="kelompok" name="jadwal_id">
                          <?php
                          $query= mysql_query("SELECT * FROM jadwal");
                            while($row = mysql_fetch_assoc($query))
                            {
                              echo "<option value=".$row["jadwal_id"].">".$row["kelompok"]."</option>";
                            }
                          ?>
                        </select>
                  </div>
                  <center>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="tampil" name="tampil" value="tampil">
                      Cetak</button>
                  </center>
                </form>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </body> 
</html> 
