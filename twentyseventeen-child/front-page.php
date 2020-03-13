<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <?php
        //取得する投稿のパラメータ
        const CATEGORY_NEWS = 'news';
        $myposts = get_posts([
            'posts_per_page'   => 5,
            'category_name'    => CATEGORY_NEWS,
            'orderby'          => 'date',
            'order'            => 'DESC',
        ]);
        // Show the selected front page content.
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post(); ?>
                <div class="panel-content">
                    <div class="wrap">
                    <header class="entry-header">
                        <h2 class="entry-title">News</h2>
                    </header>
                    <table class="table table-hover">
                        <tbody>
                            <?php foreach($myposts as $post): setup_postdata( $post ); ?>
                                <tr>
                                    <td style="width:200px;"><?php the_date(); ?></td>
                                    <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                                </tr>
                            <?php endforeach;
                            wp_reset_postdata();?>
                        </tbody>
                    </table>
                    </div>
                </div>
            <?php endwhile;
		else :
            get_template_part( 'template-parts/post/content', 'none' );
		endif;
		?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();