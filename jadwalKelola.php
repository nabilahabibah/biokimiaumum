<?php

if(!isset($_SESSION['username'])) 
  {
  header('location:index.php'); 
  }
  include "koneksi.php";
    if(isset($_POST['tambah']))
    {
       $jadwal_hari = $_POST['jadwal_hari'];
       $jadwal_shift = $_POST['jadwal_shift'];
       $kelompok = $_POST['kelompok'];
       $kuota = $_POST['kuota'];

       $simpan = mysql_query("INSERT INTO `jadwal` (kelompok,jadwal_hari,jadwal_shift,kuota) VALUES ('$kelompok','$jadwal_hari','$jadwal_shift',$kuota)");
      if(!$simpan) 
      {
        $sql_message = "Jadwal gagal ditambahkan !!";
      }
      else
      {
        header('location:jadwal.php');

      }
    }
?>
<div class="row">
    <div class="col-md-7">
        <div class='panel panel-default'>
            <div class='panel-heading'>
                	<center><b>Jadwal Praktikum</b></center>
            </div>
            <div class='panel-body'>

              <?php
                        if(isset($sql_message))
                          {
                            echo "<center><label for='exampleInputPassword1'>";
                            echo $sql_message;
                            echo "</label></center>";
                          }
                        ?>
            	<center>
                <table class="table">
                  <tr>
                    <td><b><center>Kelompok</center></b></td>
                    <td><b><center>Hari</center></b></td>
                    <td><b><center>Shift</center></b></td>
                    <td><b><center>Kuota</center></b></td>
                    <td><b><center>Aksi</center></b></td>
                  </tr>
                    <?php
                    $query = mysql_query("SELECT * FROM jadwal");
                    while($hasil = mysql_fetch_assoc($query))
                    {
                      echo "
                      <tr>
                        <td><center>".$hasil['kelompok']."</center></td>
                        <td><center>".$hasil['jadwal_hari']."</center></td>
                        <td><center>".$hasil['jadwal_shift']."</center></td>
                        <td><center>".$hasil['kuota']."</center></td>
                        ";
                       if ($status==6)  
                       {
                       	echo "
		                        <form action='jadwalUpdate.php' method='post'>	
                            <input type='hidden' value='".$hasil['jadwal_id']."' name='jadwal_id'>	                        
		                        <td><center><button type='submit' class='btn btn-primary' style='width:50%' id='update' name='update' value='update'>Update</button></center></td>
		                        </form>
		                      </tr>
		                    ";
                       }  
                       elseif ($status==2||$status==3) 
                       {
                         echo "
                            <form action='jadwalPilih.php' method='post'>
                            <input type='hidden' value='".$hasil['jadwal_id']."' name='jadwal_id'>
                            <td><center><button type='submit' class='btn btn-primary' style='width:50%' id='pilih' name='pilih' value='pilih'>Pilih</button></center></td>
                            </form>
                          </tr>
                        ";
                       }                  
                    }
              ?>

	             </table>               
	            </center>
            </div>
            <?php
                if ($status==6) 
                {
                  ?>
                  <div class='panel-heading'>
                	<center><b>Tambah Kelompok</b></center>
			            </div>
			            <div class='panel-body'>
			            	<form action="jadwalKelola.php" method="post" enctype="multipart/form-data">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kelompok" name="kelompok">
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
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Kuota" name="kuota">
                        </div>
			                  <center>
			                    <a href="beranda.php" class='btn btn-danger' style='width:15%' >Kembali</a>
			                    <button type="submit" class='btn btn-primary' style='width:15%' id="tambah" name="tambah" value="tambah">Tambah</button>
			                  </center>
			              </form>
            			</div>
                  <?php
                }
                ?> 
        </div>
                              
    </div>
</div>