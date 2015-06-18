<?php
session_start();
require_once("koneksi.php");
  $kelompok = $_POST['kelompok'];
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
        <td>Kelompok</td>
        <td>:</td>
        <td><?php echo $kelompok?></td>
      </tr>
      <tr>
        <td width="150px">Jumlah Peserta</td>
        <td>:</td>
        <td></td>
        <td width="100px"></td>
        <td>Jadwal</td>
        <td>:</td>
        <td></td>
      </tr>
    </table>
    <br><br>

    <table border="1">
    <center><tr>
        <td rowspan="2"><B>NO</B></td>
        <td rowspan="2"><B>NIM</B></td>
        <td rowspan="2"><B>NAMA</B></td>
        <td colspan="8"><B><center>MODUL</center></B></td>
      </tr>
      <tr>
        <td width="80px" height="30px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
        <td width="80px"></td>
      </tr></center>
     <!--  <?php
               
                //$kelompok = $_POST['kelompok'];
                // echo $kelompok;
                // $query = mysql_query("SELECT * FROM user JOIN jadwal_user ON user.username = jadwal_user.username JOIN jadwal ON jadwal_user.jadwal_id = jadwal.jadwal_id WHERE jadwal.kelompok=$kelompok");
                // while($hasil = mysql_fetch_assoc($query))
                // {
                //   echo "
                //   <tr>
                //   <td>1</td>
                //   <td><center>".$hasil['username']."</center></td>
                //   <td><center>".$hasil['nama']."</center></td> 
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   <td></td>
                //   </tr>";
                //}
      ?> -->
     </table>
  </body>  
</html>