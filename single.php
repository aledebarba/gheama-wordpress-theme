<?php
	get_header();
	while (have_posts()) : the_post();
		echo "here";
		get_template_part('templates/template_content');
	endwhile;
	get_footer();
?>