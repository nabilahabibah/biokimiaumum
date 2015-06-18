<div class="row">
    <div class="col-md-7">
        <?php
            $berita = mysql_query("SELECT COUNT(*) as jumlah FROM berita");
            $total = mysql_fetch_assoc($berita);
            $totalfix = $total['jumlah'];
            if ($totalfix==0) 
                {
                    echo "
                    <div class='panel panel-default'>
                    <div class='panel-body'>
                    <div class='col-md-12'><center><img src='img/happy-face.PNG' class='img-responsive' alt='Responsive image' style='width:30%;height:30%'></center></div>
                    <div class='col-md-12'>
                    <b><p align='justify'>Belum ada berita yang ditambahkan .. </p></b>
                    </div>
                    </div>
                    ";
                }
            else
            {
                $query = mysql_query("SELECT * FROM berita ORDER BY berita_id desc");
                while($hasil = mysql_fetch_assoc($query))
                {
                    $berita_id = $hasil['berita_id'];
                    $berita_judul=$hasil['berita_judul'];
                    $berita_tanggal=$hasil['berita_tanggal'];
                    $berita_isi=$hasil['berita_isi'];
                    $foto=$hasil['foto'];
                    $berita_file=$hasil['berita_file'];
                    if ($foto==null)
                    {
                        $foto='contactPerson.PNG';
                    }
                    else
                    {
                        $foto=$hasil['foto'];
                    }

                    echo "
                        <div class='panel panel-default'>
                        <div class='panel-heading'><center><b>".$berita_judul."</b></center></div>
                        <div class='panel-body'>
                        <div class='col-md-4'><p align='left'>".$berita_tanggal."</p><center><img src='img/".$foto."' class='img-responsive' alt='Responsive image' style='width:70%;height:70%'></center></div>
                        <div class='col-md-8'>
                        
                        <p align='justify'>".substr($berita_isi,0, 250)."...</p>
                        <a href='beritaDetail.php?berita_id=".$berita_id."' class='btn btn-danger' style='width:20%'>Read More</a>
                        </div>";
                        if ($berita_file<>null) {
                        echo "
                        <div class='col-md-12'>
                        <a href='dokumen/".$berita_file."'>Download ".$berita_file."</a>
                        </div>
                        ";
                        }
                        echo "
                        </div>
                        </div>
                        " ;
                }
            }
            
        ?>
    </div>
</div>
