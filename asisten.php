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
          <div class="panel-heading"><center><b>Daftar Asisten </b></center></div>
            <div class="panel-body">
              <center>
                <table class="table">
                  <tr>
                    <td><center>Nomor Induk Mahasiswa</center></td>
                    <td><center>Nama</center></td>
                    <td><center>Email</center></td>
                    <td><center>Nomor Telepon</center></td>
                    <td><center>Status</center></td>
                    <td><center>Aksi</center></td>
                  </tr>
                    <?php
                    $query = mysql_query("SELECT * FROM user JOIN STATUS ON user.status_id = status.status_id WHERE user.status_id =4 OR user.status_id =5");
                    while($hasil = mysql_fetch_assoc($query))
                    {
                      echo "
                      <tr>
                        <td><center>".$hasil['username']."</center></td>
                        <td><center>".$hasil['nama']."</center></td>
                        <td><center>".$hasil['email']."</center></td>
                        <td><center>".$hasil['nomor_telepon']."</center></td>
                        <td><center>".$hasil['status_keterangan']."</center></td>
                        <form action='userUpdate.php' method='post'>
                        <input type='hidden' value='".$hasil['username']."' name=username>
                        <td><center><button type='submit' class='btn btn-primary' style='width:100%' id='update' name='update' value='update'>Update</button></center></td>
                        </form>
                      </tr>
                    ";
                  }
              ?>
              </table>               
            </center>
          </div>
        </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </body> 
</html> 

