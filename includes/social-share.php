<?php 

function makplus_social_sharing() {?>
    <ul>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com/home?status=<?php the_permalink() ?>"><i class="fab fa-twitter"></i></a></li>
        <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fab fa-google-plus-g"> </i></a></li>
        <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="fab fa-linkedin-in"></i></a></li>
    </ul>    
	<?php
}


function makplus_product_social_sharing() {?>

	<div class="col-lg-5 text-xl-right text-left social-share">
	    <ul class="list-inline">
	        <li class="list-inline-item mr-4"><?php echo esc_html__( 'Social Share:', 'makplus' ) ?></li>
	        <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook"></i></a></li>
	        <li class="list-inline-item"><a href="https://twitter.com/home?status=<?php the_permalink() ?>"><i class="fa fa-twitter"></i></a></li>
	        <li class="list-inline-item"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="fa fa-pinterest"></i></a></li>
	        <li class="list-inline-item"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="fa fa-linkedin"></i></a></li>
	    </ul>
	</div>
	<?php
}