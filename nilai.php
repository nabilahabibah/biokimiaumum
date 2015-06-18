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
          <div class="panel-heading"><center><b>Daftar Praktikan </b></center></div>
            <div class="panel-body">
              <center>
                <table class="table">
                <tr>
                  <td><b><center>Nomor Induk Mahasiswa</center></b></td>
                  <td><b><center>Nama</center></b></td>  
                  <td><b><center>Nilai Akhir</center></b></td>   
                  <?php
                  if ($status==6) {
                                 echo "<td><b><center>Aksi</center></b></td>";
                               }             
                  ?>
                </tr> 
                <?php
                // $query = mysql_query("SELECT * FROM user JOIN STATUS ON user.status_id = status.status_id WHERE user.status_id =2 or user.status_id =3");
                $query = mysql_query("SELECT * FROM user JOIN STATUS JOIN nilai ON user.status_id = status.status_id and user.username = nilai.username WHERE user.status_id =2 or user.status_id =3");
                while($hasil = mysql_fetch_assoc($query))
                {
                echo "
                <tr>
                  <td><center>".$hasil['username']."</center></td>
                  <td><center>".$hasil['nama']."</center></td>
                  <td><center>".$hasil['nilai_Total']."</center></td>";
                  if ($status==6) 
                  {
                    echo"
                          <form action='nilaiUpdate.php' method='post'>
                          <input type='hidden' value='".$hasil['username']."' name=username>
                          <input type='hidden' value='".$hasil['nama']."' name=nama>
                          <td><center><button type='submit' class='btn btn-primary' style='width:100%' id='update' name='update' value='update'>Update</button></center></td>
                          </form>
                        
                        ";
                  }
                  echo "</tr>";                  
                }
                ?>
                </table>
                <?php
                if ($status==6) {
                  echo "
                        <form action='print.php' method='post'>
                          <center><button type='submit' class='btn btn-primary' style='width:10%' id='print' name='print' value='print'>Cetak</button></center>
                        </form>
                        <br>
                        <form action='selesai.php' method='post'>
                          <center><button type='submit' class='btn btn-danger' style='width:15%' id='selesai' name='selesai' value='selesai'>Praktikum Berakhir</button></center>
                        </form>
                          ";
                }
                ?>                
              </center>
            </div>
          </div>
        </div>
      <div class="col-md-1"></div>
    </div> 
  </body>
</html>