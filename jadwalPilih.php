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
                if(isset($_POST['pilih']))
                  {
                      $jadwal_id = $_POST['jadwal_id'];
                      $username = $_SESSION['username'];
                      $cek = mysql_query("SELECT * FROM jadwal WHERE jadwal_id=$jadwal_id");
                      $cekjadwal = mysql_fetch_assoc($cek);
                      $kuota = $cekjadwal['kuota'];  

                      $banyak = mysql_query("SELECT count(*) as jumlah FROM jadwal_user WHERE jadwal_id=$jadwal_id");
                      $total = mysql_fetch_assoc($banyak);
                      $totalfix = $total['jumlah'];
                      
                      if ($totalfix<$kuota) 
                      {
                        $pilih = mysql_query("INSERT INTO jadwal_user (jadwal_id,username) VALUES ($jadwal_id,$username)");
                        $kuotaSekarang = $kuota - 1 ; 
                        $updateKuota = mysql_query("UPDATE `jadwal` SET kuota = $kuotaSekarang WHERE jadwal_id=$jadwal_id");
                        if ($pilih) 
                        {
                          $sql = mysql_query("SELECT *FROM jadwal_user JOIN user ON jadwal_user.username=user.username JOIN jadwal ON jadwal_user.jadwal_id=jadwal.jadwal_id WHERE jadwal_user.username=$username ");         
                          $hasil1 = mysql_fetch_array($sql);  
                          $jadwal_hari = $hasil1['jadwal_hari'];
                          $jadwal_shift = $hasil1['jadwal_shift'];
                            ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="panel panel-default">
                                  <div class="panel-heading" style="text-align:center">
                                  <b>Jadwal Praktikum</b>
                                  </div>
                                <div class="panel-body">
                                  <div class="container-fluid">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Hari</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $jadwal_hari?>" placeholder="hari" name="hari" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Shift</label>
                                      <input type="shift" class="form-control" id="exampleInputPassword1" value="<?php echo $jadwal_shift?>" placeholder="shift" name="shift" readonly>
                                    </div>    
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php
                        }
                      }
                      else
                      {
                        $sql_message = "Kuota jadwal yang dipilih sudah penuh.. Silahkan pilih jadwal lain!!";
                        ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="panel panel-default">
                                  <div class="panel-heading" style="text-align:center">
                                  <b>Jadwal Praktikum</b>
                                  </div>
                                <div class="panel-body">
                                  <div class="container-fluid">
                                    <?php
                                    if(isset($sql_message))
                                      {
                                        echo "<center><label for='exampleInputPassword1'>";
                                        echo $sql_message;
                                        echo "</label></center>";
                                      }
                                    ?>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Hari</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="hari" name="hari" readonly>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Shift</label>
                                      <input type="shift" class="form-control" id="exampleInputPassword1" placeholder="shift" name="shift" readonly>
                                    </div>    
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php
                      }
                  }
        ?>        
  </body>  
</html>