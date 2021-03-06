<?php
/**
 *
 * BoldR Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 *
 * Copyright 2013-2017 Mathieu Sarrasin - Iceable Media
 *
 * Single Post Template
 *
 */

get_header();

?><div class="container" id="main-content"><?php

	?><div id="page-container" class="left with-sidebar"><?php

		if(have_posts()):
		while(have_posts()) : the_post();

		?><div id="post-<?php the_ID(); ?>" <?php post_class("single-post"); ?>><?php

			?><div class="postmetadata"><?php
				?><span class="meta-date"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php
					?><span class="month"><?php the_time('M'); ?></span><?php
					?><span class="day"><?php the_time('d'); ?></span><?php
					?><span class="year"><?php the_time('Y'); ?></span><?php

					// Echo published and updated dates for hatom-feed - not to be displayed on front end
					?><span class="published"><?php the_time(get_option('date_format')); ?></span><?php
					?><span class="updated"><?php the_modified_date(get_option('date_format')); ?></span><?php
				?></a></span><?php

				if ( ( comments_open() || get_comments_number()!=0 ) && !post_password_required() ):
				?><span class="meta-comments"><?php
					comments_popup_link( __( 'No', 'boldr-lite' ), __( '1', 'boldr-lite' ), __( '%', 'boldr-lite' ), 'comments-count', '' );
					comments_popup_link( __( 'Comment', 'boldr-lite' ), __( 'Comment', 'boldr-lite' ), __( 'Comments', 'boldr-lite' ), '', __('Comments Off', 'boldr-lite') );
				?></span><?php
				endif;

				?><span class="meta-author vcard author"><?php
					_e('by ', 'boldr-lite');
					?><span class="fn"><?php the_author(); ?></span><?php
				?></span><?php

				edit_post_link(__('Edit', 'boldr-lite'), '<span class="editlink">', '</span>');

			?></div><?php

				if ( '' != get_the_post_thumbnail() ):	// As recommended from the WP codex, to avoid potential failure of has_post_thumbnail()
			?><div class="thumbnail"><a href="<?php get_permalink() ?>"><?php
				the_post_thumbnail('large', array('class' => 'scale-with-grid'));
			?></a></div><?php
			endif;

			?><div class="post-contents"><?php
				?><h3 class="entry-title"><?php
				?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a><?php
				?></h3><?php
				if ( has_category() ):
					?><div class="post-category"><?php _e('Posted in', 'boldr-lite'); ?> <?php the_category(', '); ?></div><?php
				endif;

				the_content();

				?><div class="clear"></div><?php
				$args = array(
					'before'           => '<br class="clear" /><div class="paged_nav">' . __('Pages:', 'boldr-lite'),
					'after'            => '</div>',
					'link_before'      => '<span>',
					'link_after'       => '</span>',
					'next_or_number'   => 'number',
					'nextpagelink'     => __('Next page', 'boldr-lite'),
					'previouspagelink' => __('Previous page', 'boldr-lite'),
					'pagelink'         => '%',
					'echo'             => 1
				);
				wp_link_pages( $args );

				if (has_tag()) the_tags('<div class="tags"><span class="the-tags">'.__('Tags', 'boldr-lite').':</span>', '', '</div>');


			?></div><br class="clear" /><?php

		?></div><?php // end div post

		?><div class="article_nav"><?php
			if ( is_attachment() ): // Use image navigation links on attachment pages, post navigation otherwise
				if ( boldr_adjacent_image_link(false) ): // Is there a previous image ?
				?><div class="previous"><?php previous_image_link(0, __("Previous Image", 'boldr-lite') ); ?></div><?php
				endif;
				if ( boldr_adjacent_image_link(true) ): // Is there a next image ?
				?><div class="next"><?php next_image_link(0, __("Next Image",'boldr-lite') ); ?></div><?php
				endif;
			else:
				if ("" != get_adjacent_post( false, "", true ) ): // Is there a previous post?
				?><div class="previous"><?php previous_post_link('%link', __("Previous Post", 'boldr-lite') ); ?></div><?php
				endif;
				if ("" != get_adjacent_post( false, "", false ) ): // Is there a next post?
				?><div class="next"><?php next_post_link('%link', __("Next Post", 'boldr-lite') ); ?></div><?php
				endif;
			endif;
			?><br class="clear" /><?php
		?></div><?php


		// Display comments section only if comments are open or if there are comments already.
		if ( comments_open() || get_comments_number()!=0 ):
			?><hr /><?php
			?><div class="comments"><?php comments_template( '', true ); ?></div><?php

			?><div class="article_nav"><?php
				if ("" != get_adjacent_post( false, "", true ) ): // Is there a previous post?
				?><div class="previous"><?php previous_post_link('%link', __("Previous Post", 'boldr-lite') ); ?></div><?php
				endif;
				if ("" != get_adjacent_post( false, "", false ) ): // Is there a next post?
				?><div class="next"><?php next_post_link('%link', __("Next Post", 'boldr-lite') ); ?></div><?php
				endif;
				?><br class="clear" /><?php
			?></div><?php
		endif;

		endwhile;

		else:

		?><h2><?php _e('Not Found', 'boldr-lite'); ?></h2><?php
		?><p><?php _e('What you are looking for isn\'t here...', 'boldr-lite'); ?></p><?php

		endif;

	?></div>

	
<?php // End page container

	?><div id="sidebar-container" class="right"><?php get_sidebar(); ?></div><?php

?></div><?php // End main content

get_footer();
