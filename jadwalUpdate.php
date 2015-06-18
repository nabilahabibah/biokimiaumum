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
        include "sidebar.php";

        if (isset($_POST['update'])) 
        {
          $jadwal_id = $_POST['jadwal_id'];
          $query = mysql_query("SELECT * FROM jadwal WHERE jadwal_id=$jadwal_id");
          $jadwal = mysql_fetch_assoc($query);
          $kelompok = $jadwal['kelompok'];  
          $kuota = $jadwal['kuota'];  
        }   
        elseif (isset($_POST['update1'])) 
        {
          $kelompok = $_POST['kelompok']; 
          $jadwal_hari = $_POST['jadwal_hari']; 
          $jadwal_shift = $_POST['jadwal_shift']; 
          $kuota = $_POST['kuota']; 
          $cek = mysql_query("SELECT * FROM jadwal WHERE jadwal_hari='$jadwal_hari' and jadwal_shift='$jadwal_shift'");
          if(mysql_num_rows($cek) <> 0) 
          {
            $sql_message = "Jadwal dengan hari dan shift tersebut telah terdapat jadwal lain !!";
          } 
          else
          {
            $update1 = mysql_query("UPDATE `jadwal` SET `jadwal_hari`='$jadwal_hari',`jadwal_shift`='$jadwal_shift', kuota=$kuota WHERE kelompok=$kelompok");
            if ($update1) {
              $sql_message ="Jadwal berhasil di update";
            }
          }          
        }    
        ?>
        <div class="row">
        <div class="col-md-7">
          <div class="panel panel-default">
        <div class='panel-heading'>
                  <center><b>Tambah Kelompok</b></center>
                  </div>
                  <div class='panel-body'>
                    <form action="jadwalUpdate.php" method="post" enctype="multipart/form-data">
                        <?php
                        if(isset($sql_message))
                          {
                            echo "<center><label for='exampleInputPassword1'>";
                            echo $sql_message;
                            echo "</label></center>";
                          }
                        ?>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kelompok</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kelompok" name="kelompok" value="<?php echo $kelompok;?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Hari</label>
                          <select type="text" class="form-control" id="exampleInputEmail1" placeholder="hari" name="jadwal_hari">
                              <option value="Senin">Senin</option>
                              <option value="Selasa">Selasa</option>
                              <option value="Rabu">Rabu</option>
                              <option value="Kamis">Kamis</option>
                              <option value="Jumat">Jumat</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Shift</label>
                          <select type="text" class="form-control" id="exampleInputEmail1" placeholder="shift" name="jadwal_shift">
                              <option value="08.00 - 10.00">08.00 - 10.00</option>
                              <option value="10.00 - 12.00">10.00 - 12.00</option>
                              <option value="13.00 - 15.00">13.00 - 15.00</option>
                              <option value="16.00 - 18.00">16.00 - 18.00</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Kuota</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kuota" name="kuota" value="<?php echo $kuota;?>">
                        </div>
                        <center>
                          <a href="jadwal.php" class='btn btn-danger' style='width:15%' >Kembali</a>
                          <button type="submit" class='btn btn-primary' style='width:15%' id="update1" name="update1" value="update1">Update</button>
                        </center>
                    </form>
                  </div>
                  </div>
                  </div>
                  </div>
  </body>  
</html>