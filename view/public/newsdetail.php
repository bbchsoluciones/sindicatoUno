<?php
include 'include/header.php';
include '../../controller/NoticiaC.php';
if (!empty($noticia)):
    $fecha = ucwords(strftime("%d %b %Y", strtotime($noticia['fecha_publicacion'])));
    $hora = strftime("%H:%m", strtotime($noticia['fecha_publicacion']));
    if (empty($noticia['url_foto_noticia']) || $noticia['url_foto_noticia'] == null):
        $noticia['url_foto_noticia'] = ".././../assets/images/1280x720.png";
    endif;
?>
	<div class="news-detail-page container">
	    <h1 class="title text-center header_title" id="title">
	        <?php echo $noticia['titulo']; ?>
	    </h1>
	    <div class="d-flex justify-content-center">
	        <div class="content">
	            <div class="header_image pt-2">
	                <div id="main_news_image" class="image" style="background:url('<?php echo $noticia['url_foto_noticia']; ?>');background-size:cover;background-position:center;"
	                    alt=""></div>
	            </div>
	            <div class="extra_detail news-font">
	                <div class="row py-2">
	                    <div class="col-6 d-flex justify-content-center align-items-center">
	                        <div class="news-time">
	                            <div class="date">
	                                <div class="text-center"><i class="fa fa-calendar-alt px-2"></i>
	                                    <?php echo $fecha; ?><i class="fa fa-clock px-2"></i>
	                                    <?php echo $hora; ?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-6">
	                        <div class="row d-flex justify-content-center align-items-center">
	                            <div class="col-2">
	                                <img src="<?php echo $noticia['url_foto_perfil']; ?>" alt="" class="rounded-circle">
	                            </div>
	                            <div class="col-10">
	                                por:
	                                <?php echo $noticia['nombres_trabajador']; ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	            </div>
	            <hr class="mt-0" />
	            <div class="body-content">
	                <?php echo $noticia['cuerpo']; ?>
	            </div>
	            <hr/>
	            <div class="comments-content">
	                <div id="disqus_thread"></div>
	                <script>
	                    /**
	                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
	                    /*
	                    var disqus_config = function () {
	                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
	                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
	                    };
	                    */
	                    (function () { // DON'T EDIT BELOW THIS LINE
	                        var d = document,
	                            s = d.createElement('script');
	                        s.src = 'https://localhost-mjod649bqu.disqus.com/embed.js';
	                        s.setAttribute('data-timestamp', +new Date());
	                        (d.head || d.body).appendChild(s);
	                    })();
	                </script>
	                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
	                        powered by Disqus.</a></noscript>

	            </div>
	        </div>

	    </div>

	</div>
	<?php
else:
    header("HTTP/1.0 404 Not Found");
    exit();
endif;
include 'include/footer.php';
?>