<?php
	/* Template Name: No Widgets */
	get_header();
	while (have_posts()) : the_post();

    if(have_rows('page_header')) :
	while(have_rows('page_header')) : the_row();
		get_template_part('templates/widget_intro');
	endwhile;
	endif;
?>

<section class="widget-layout default full">
    <div class="hold">
        <div class="article-hold">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
	endwhile;
	get_footer();
?>