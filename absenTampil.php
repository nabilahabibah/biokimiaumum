<?php
session_start();
include "koneksi.php";
$jadwal_id = $_POST['jadwal_id'];  
$kelompok = mysql_query("SELECT * FROM jadwal WHERE jadwal_id=$jadwal_id");
$kel = mysql_fetch_assoc($kelompok);
$k = $kel['kelompok'];
$jadwal_hari = $kel['jadwal_hari'];
$jadwal_shift = $kel['jadwal_shift'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Biokimia</title>
  </head>
  <body onload = "javascript:window.print()">
    <center><h2><b>Daftar Hadir Praktikum</b></h2></center>
    <center><h3><b>Fakultas Teknologi Pertanian</b></h3></center>
    <table>
      <tr>
        <td width="150px">Matakuliah</td>
        <td>:</td>
        <td>Biokimia Umum</td>
        <td width="100px"></td>
        <td>Dosen</td>
        <td>:</td>
        <td></td>
      </tr>
      <tr>
        <td width="150px">Program Studi</td>
        <td>:</td>
        <td>Teknologi Hasil Pertanian</td>
        <td width="100px"></td>
        <td>Kelompok</td>
        <td>:</td>
        <td><?php echo $k;?></td>
      </tr>
      <tr>
        <td width="150px">Jumlah Peserta</td>
        <td>:</td>
        <td>
          <?php 
          $queryHitung = mysql_query("SELECT count(*) as jumlah FROM user JOIN jadwal_user ON user.username = jadwal_user.username JOIN jadwal ON jadwal_user.jadwal_id = jadwal.jadwal_id WHERE user.status_id=2");
          $total = mysql_fetch_assoc($queryHitung);
          $totalfix = $total['jumlah'];
          echo $totalfix;?>
        </td>
        <td width="100px"></td>
        <td>Jadwal</td>
        <td>:</td>
        <td><?php echo $jadwal_hari; echo ","; echo $jadwal_shift ;?></td>
      </tr>
    </table><br><br>
    <table border="1">
    <center><tr>
        <td rowspan="2" width="150px"><center><B>NIM</B></center></td>
        <td rowspan="2" width="250px"><center><B>NAMA</B></center></td>
        <td colspan="5"><center><B>MODUL</B></center></td>
      </tr>
      <tr>
        <td width="50px" height="30px"><center>1</center></td>
        <td width="50px"><center>2</center></td>
        <td width="50px"><center>3</center></td>
        <td width="50px"><center>4</center></td>
        <td width="50px"><center>5</center></td>
      </tr></center>
      <?php
          $query1 = mysql_query("SELECT * FROM user JOIN jadwal_user ON user.username = jadwal_user.username JOIN jadwal ON jadwal_user.jadwal_id = jadwal.jadwal_id WHERE jadwal.jadwal_id=$jadwal_id");
          while($row = mysql_fetch_assoc($query1))
          {
              echo "
              <tr>
                <td>".$row['username']."</td>
                <td>".$row['nama']."</td>
                <td width='50px' height='30px'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              ";
          }
      ?>


      </table>
  </body>  
</html>

