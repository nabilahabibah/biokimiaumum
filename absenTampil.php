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
          <div class="panel-heading"><center><b>Absen Praktikum</b></center></div>
            <div class="panel-body">
              <center>
                <form action='absenCetak.php' method='post'>
                <table class="table">
                <tr>
                  <td><b><center>Nomor Induk Mahasiswa</center></b></td>
                  <td><b><center>Nama</center></b></td> 
                </tr>
                <?php
                $jadwal_id = $_POST['jadwal_id'];
                $query = mysql_query("SELECT * FROM user JOIN jadwal_user ON user.username = jadwal_user.username JOIN jadwal ON jadwal_user.jadwal_id = jadwal.jadwal_id WHERE jadwal_user.jadwal_id=$jadwal_id");
                while($hasil = mysql_fetch_assoc($query))
                {
                  echo "
                  <tr>
                  <td><b><center>".$hasil['username']."</center></b></td>
                  <td><b><center>".$hasil['nama']."</center></b></td>
                  <input type='hidden' value='".$hasil['kelompok']."' name='kelompok'>  
                </tr>";
                }
                echo "
                </table>   
                <form action='absenCetak.php' method='post'>
                <input type='hidden' value='".$hasil['kelompok']."' name='kelompok'>  
                  <center><button type='submit' class='btn btn-danger' style='width:15%' id='cetak' name='cetak' value='cetak'>Cetak</button></center>
                </form>"; 
                ?>        
              </center>
            </div>
          </div>
        </div>
      <div class="col-md-1"></div>
    </div> 
 </body> 
</html> 