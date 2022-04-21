	<footer id="pie-pagina" class="seccion-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php the_field('textos_footer','option') ?>
				</div>
			</div>
		</div>

	  	<div id="elipse-footer" class="wow fadeInDown" data-wow-duration="4s">
	    	<img src="<?php echo get_stylesheet_directory_uri()?>/images/elipses-footer.png" width="180">
	  	</div>
	  	<div id="elipse-footer-2" class="wow fadeInDown" data-wow-duration="4s">
	    	<img src="<?php echo get_stylesheet_directory_uri()?>/images/elipse-footer-2.png" width="180">
	  	</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>    
	<script src="<?php echo get_stylesheet_directory_uri()?>/js/custom.js"></script>
<?php wp_footer(); ?>

  <script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          //console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    /*document.getElementById('moar').onclick = function() {
      var section = document.createElement('section');
      section.className = 'section--purple wow fadeInDown';
      this.parentNode.insertBefore(section, this);
    };*/

    document.body.classList.add('vista-padres');
  </script>

</body>
</html>