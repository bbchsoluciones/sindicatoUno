<?php
     require_once('include/header.php');
     require_once('../../controller/NoticiaC.php');
?>
<div class="news-page container">
    <h3 class="text-secondary"><i class="fa fa-newspaper pr-3"></i>Noticias</h3>
    <?php    if(!empty($n)): ?>
    <div class="row">
        <?php 
        
        foreach($n as $row): 
            if($row['publicada']=="publicada"):
                if(empty($row['url_foto_noticia']) || $row['url_foto_noticia']==null):
                    $row['url_foto_noticia']=".././../assets/images/1280x720.png";
                endif;  
                $fecha = ucwords(strftime("%d %b %Y", strtotime($row['fecha_publicacion'])));
                $hora = strftime("%H:%m", strtotime($row['fecha_publicacion']));
                $title = preg_replace('#[^0-9a-z_-]#i', '-', cleanString($row['titulo']));
        ?>

        <div class="row pt-5">
            <div class="col-md-4 p-3 news-img-preview">
                <a href="newsdetail.php?id_news=<?php echo $row['id_noticia'];?>&title=<?php echo substr($title, 0, 150); ?>"
                    class="">
                    <img src="<?php echo $row['url_foto_noticia']; ?>" alt="" class="">
                </a>
            </div>
            <div class="col-md-8 p-3" style="overflow:hidden">
                <h3 class="titulo"><a href="newsdetail.php?id_news=<?php echo $row['id_noticia'];?>&title=<?php echo substr($title, 0, 150); ?>">
                        <?php echo $row['titulo']; ?></a></h3>
                <p class="subtitulo">
                    <?php echo substr(strip_tags(stripslashes($row['cuerpo'])),0,200)."...";?>
                </p>
                <div class="news-time bg-secondary p-2 text-light rounded">
                    <div class="date">
                        <div class="text-center"><i class="fa fa-calendar-alt pr-1"></i>
                            <?php echo $fecha; ?><i class="fa fa-clock pr-1"></i>
                            <?php echo $hora; ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <?php 
            endif;
            endforeach; ?>
        </div>
        <?php     
        else:
        ?>
        <div class="no_registros d-flex justify-content-center">
            <h5 class="text-secondary mt-5">
            No hay contenido que mostrar en estos momentos.
            </h5>
        </div>
        <?php
    endif;?>
    </div>
    <?php
     require_once('include/footer.php');
?>