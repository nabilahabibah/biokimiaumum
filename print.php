<?php
session_start();
include "koneksi.php";
$query = mysql_query("SELECT * FROM nilai JOIN user ON nilai.username = user.username order by nilai.username");
                
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Biokimia</title>
  </head>
  <body onload = "javascript:window.print()">
    <center><h2><b>DAFTAR HADIR PRAKTIKUM</b></h2></center>
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
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td width="150px">Jumlah Peserta</td>
        <td>:</td>
        <td>
          <?php 
          $queryHitung = mysql_query("SELECT count(*) as jumlah FROM nilai JOIN user ON nilai.username = user.username order by nilai.username");
          $total = mysql_fetch_assoc($queryHitung);
          $totalfix = $total['jumlah'];
          echo $totalfix;?>
        </td>
        <td width="100px"></td>
        <td>Jadwal</td>
        <td>:</td>
        <td></td>
      </tr>
    </table>
    <br><br>
     </table>
     <center>
     <table border="1">
      <tr>
        <td width="200px"><center><b>NIM</b></center></td>
        <td width="200px"><center><b>NAMA</b></center></td>
        <td width="200px"><center><b>NILAI</b></center></td>
      </tr> 
      <?php
        while($hasil = mysql_fetch_assoc($query))
        {
          echo "
              
                <td><center>".$hasil['username']."</center></td>
                <td><center>".$hasil['nama']."</center></td>
                <td><center>".$hasil['nilai_Total']."</center></td>
              </tr>
          ";
        }
      ?>
     </table></center>
  </body>  
</html>