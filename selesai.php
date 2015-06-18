<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location:index.php');
}
else
{
    include "koneksi.php";
      $berita = mysql_query("DELETE FROM berita");
      if ($berita) {
        $nilai = mysql_query("DELETE FROM nilai");
        if ($nilai) {
          $jadwal_user = mysql_query("DELETE FROM jadwal_user");
          if ($jadwal_user) {
            $jadwal = mysql_query("DELETE FROM jadwal");
            if ($jadwal) {
              $user = mysql_query("DELETE FROM user WHERE status_id=2 or status_id=8");
              if ($user) {
                header("location:beranda.php");
              }
              else
              {
                echo "user";
              }
            }
            else
            {
              echo "jadwal";
            }
          }
          else
          {
            echo "jadwal_user";
          }
        }
        else
        {
          echo "nilai";
        }
      }
      else
      {
        echo "berita";
      }
}
  
?>