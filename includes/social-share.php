<?php 

function makplus_social_sharing() {?>
    <ul>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com/home?status=<?php the_permalink() ?>"><i class="fa fa-twitter"></i></a></li>
        <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fa fa-google-plus"> </i></a></li>
        <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="fa fa-linkedin"></i></a></li>
    </ul>    
	<?php
}