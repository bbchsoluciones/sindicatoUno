<?php
    include('include/header.php');
    include('../../controller/NoticiaC.php');
?>
<div class="news-page container">
    <div class="row">
        <div class="col-12">
            <h5>Noticias</h5>
        </div>
        <!-- <div class="col-3">
                <h5 class="text-right">Más visto</h5>
            </div> -->
    </div>
    <div class="justify-content-center">
        <?php 
        
        foreach($n as $row): 
            if($row['publicada']=="publicada"):
                if(empty($row['url_foto_noticia']) || $row['url_foto_noticia']==null):
                    $row['url_foto_noticia']=".././../assets/images/1280x720.png";
                endif;  
                $fecha = ucwords(strftime("%d %b %Y", strtotime($row['fecha_publicacion'])));
                $hora = strftime("%H:%m", strtotime($row['fecha_publicacion']));
        ?>

        <div class="row pt-5">
            <div class="col-4 news-img-preview">
                <a href="newsdetail.php?id_news=<?php echo $row['id_noticia']?>" class="">
                    <img src="<?php echo $row['url_foto_noticia']; ?>" alt="" class="">
                </a>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <h3 class="titulo"><a href="newsdetail.php?id_news=<?php echo $row['id_noticia']?>"><?php echo $row['titulo']; ?></a></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="subtitulo"><?php echo substr(strip_tags(stripslashes($row['cuerpo'])),0,290)."...";?></p>
                    </div>
                </div>

                <div class="news-time bg-secondary p-2 text-light rounded">
                    <div class="date">
                        <div class="text-center"><i class="fa fa-calendar-alt pr-1"></i><?php echo $fecha; ?><i class="fa fa-clock pr-1"></i><?php echo $hora; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <?php 
            endif;
            endforeach; ?>
    </div>
</div>
<?php
    include('include/footer.php');
?>