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
                <form action="absenTampil.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status Baru</label>
                    <select type="text" class="form-control" id="exampleInputEmail1" placeholder="jadwal_id" name="jadwal_id">
                          <?php
                          $query= mysql_query("select * from jadwal");
                            while($row = mysql_fetch_assoc($query))
                            {
                              echo "<option value=".$row["jadwal_id"].">".$row["kelompok"]."</option>";
                            }
                          ?>
                        </select>
                  </div>
                  <center>
                    <button type="submit" class='btn btn-primary' style='width:15%' id="tampil" name="tampil" value="tampil">
                      Tampilkan</button>
                  </center>
                </form>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </body> 
</html> 
