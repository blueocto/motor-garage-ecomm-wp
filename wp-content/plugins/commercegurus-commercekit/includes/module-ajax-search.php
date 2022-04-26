<?php
/**
 *
 * Ajax Search module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Ajax search options
 *
 * @return string
 */
function commercekit_ajs_options() {
	$commercekit_options                 = get_option( 'commercekit', array() );
	$commercekit_ajs                     = array();
	$commercekit_ajs['ajax_url']         = admin_url( 'admin-ajax.php' );
	$commercekit_ajs['ajax_search']      = isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 1 : 0;
	$commercekit_ajs['char_count']       = 3;
	$commercekit_ajs['action']           = 'commercekit_ajax_search';
	$commercekit_ajs['loader_icon']      = CKIT_URI . 'assets/images/loader2.gif';
	$commercekit_ajs['no_results_text']  = isset( $commercekit_options['ajs_no_text'] ) && ! empty( $commercekit_options['ajs_no_text'] ) ? stripslashes_deep( $commercekit_options['ajs_no_text'] ) : esc_html__( 'No results', 'commercegurus-commercekit' );
	$commercekit_ajs['placeholder_text'] = isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? stripslashes_deep( $commercekit_options['ajs_placeholder'] ) : esc_html__( 'Search products...', 'commercegurus-commercekit' );
	$commercekit_ajs['layout']           = ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'all' : 'product';

	return $commercekit_ajs;
}

/**
 * Ajax do search
 */
function commercekit_ajax_do_search() {
	$commercekit_options = get_option( 'commercekit', array() );
	$enable_ajax_search  = isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 1 : 0;
	$search_type         = ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'all' : 'product';
	$other_result_text   = isset( $commercekit_options['ajs_other_text'] ) && ! empty( $commercekit_options['ajs_other_text'] ) ? stripslashes_deep( $commercekit_options['ajs_other_text'] ) : esc_html__( 'Other results', 'commercegurus-commercekit' );
	$view_all_text       = isset( $commercekit_options['ajs_all_text'] ) && ! empty( $commercekit_options['ajs_all_text'] ) ? stripslashes_deep( $commercekit_options['ajs_all_text'] ) : esc_html__( 'View all results', 'commercegurus-commercekit' );
	$outofstock          = ( isset( $commercekit_options['ajs_outofstock'] ) && 0 === (int) $commercekit_options['ajs_outofstock'] ) || ! isset( $commercekit_options['ajs_outofstock'] ) ? false : true;
	$commercekit_nonce   = isset( $_GET['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['commercekit_nonce'] ) ) : '';
	$verify_nonce        = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$search_text         = isset( $_GET['query'] ) ? trim( sanitize_text_field( wp_unslash( $_GET['query'] ) ) ) : '';
	$suggestions         = array();
	$view_all_link       = home_url( '/' ) . '?s=' . $search_text . ( 'product' === $search_type ? '&post_type=product' : '' );
	$ajs_excludes        = isset( $commercekit_options['ajs_excludes'] ) ? explode( ',', $commercekit_options['ajs_excludes'] ) : array();
	$outofstock_query    = 'meta-query';
	$result_total        = 0;

	if ( $enable_ajax_search && $search_text ) {

		$args = array(
			's'              => $search_text,
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'post_type'      => 'product',
			'post__not_in'   => $ajs_excludes,
		);
		if ( $outofstock ) {
			$outofstock_query          = str_replace( '-', '_', $outofstock_query );
			$args[ $outofstock_query ] = array(
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT LIKE',
				),
			);
		}

		$product_search = new WP_Query( $args );
		$result_count   = 0;
		$result_total  += $product_search->found_posts;

		if ( $product_search->have_posts() ) {
			while ( $product_search->have_posts() ) {
				$product_search->the_post();
				$post_title = esc_html( $product_search->post->post_title );
				if ( preg_match( '/' . $search_text . '/i', $post_title, $matches ) ) {
					$post_title = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $post_title );
				}
				$post_id = $product_search->post->ID;
				$product = wc_get_product( $post_id );
				$image   = '';
				if ( has_post_thumbnail( $product_search->post ) ) {
					$image = get_the_post_thumbnail( $product_search->post, 'thumbnail' );
				}
				$output = '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="commercekit-ajs-product">';
				if ( $image ) {
					$output .= '<div class="commercekit-ajs-product-image">' . $image . '</div>';
				}
				$output .= '<div class="commercekit-ajs-product-desc">';
				$output .= '<div class="commercekit-ajs-product-title">' . $post_title . '</div>';
				$output .= '<div class="commercekit-ajs-product-price">' . $product->get_price_html() . '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</a>';

				$suggestions[] = array(
					'value' => esc_js( $post_title ),
					'data'  => $output,
					'url'   => esc_url( get_permalink( $post_id ) ),
				);
				$result_count++;
			}
		}

		$terms = get_terms(
			array(
				'product_cat',
				'product_tag',
			),
			array(
				'name__like' => $search_text,
				'hide_empty' => true,
				'number'     => 2,
			)
		);
		if ( count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				$term_name = $term->name;
				if ( preg_match( '/' . $search_text . '/i', $term_name, $matches ) ) {
					$term_name = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $term_name );
				}
				$term_type = ucwords( str_replace( array( 'product_cat', '_' ), array( 'product category', ' ' ), $term->taxonomy ) );
				$output    = '<a href="' . esc_url( get_term_link( $term ) ) . '" class="commercekit-ajs-post">';
				$output   .= '<div class="commercekit-ajs-post-title">' . $term_name . '<span class="post-type">' . $term_type . '</span></div>';
				$output   .= '</div>';
				$output   .= '</a>';

				$suggestions[] = array(
					'value' => esc_js( $term->name ),
					'data'  => $output,
					'url'   => esc_url( get_term_link( $term ) ),
				);
				$result_count++;
			}
			$result_total += count( $terms );
		}

		if ( 'all' === $search_type ) {

			$posts_search  = new WP_Query(
				array(
					's'              => $search_text,
					'post_status'    => 'publish',
					'posts_per_page' => ( 7 - $result_count ),
					'post_type'      => array( 'post', 'page' ),
					'post__not_in'   => $ajs_excludes,
				)
			);
			$result_total += $posts_search->found_posts;

			if ( $posts_search->have_posts() ) {

				$suggestions[] = array(
					'value' => esc_js( $other_result_text ),
					'data'  => '<div class="commercekit-ajs-other-result">' . $other_result_text . '</div>',
					'url'   => 'javascript:;',
				);

				while ( $posts_search->have_posts() ) {
					$posts_search->the_post();
					$post_title = esc_html( $posts_search->post->post_title );
					if ( preg_match( '/' . $search_text . '/i', $post_title, $matches ) ) {
						$post_title = preg_replace( '/' . $search_text . '/i', '<span class="match-text">' . $matches[0] . '</span>', $post_title );
					}
					$post_id   = $posts_search->post->ID;
					$post_type = ucwords( $posts_search->post->post_type );
					$output    = '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="commercekit-ajs-post">';
					$output   .= '<div class="commercekit-ajs-post-title">' . $post_title . '<span class="post-type">' . $post_type . '</span></div>';
					$output   .= '</div>';
					$output   .= '</a>';

					$suggestions[] = array(
						'value' => esc_js( $post_title ),
						'data'  => $output,
						'url'   => esc_url( get_permalink( $post_id ) ),
					);
				}
			}
		}
	}

	$view_all_html = '<a class="commercekit-ajs-view-all" href="' . $view_all_link . '">' . $view_all_text . ' (' . $result_total . ')</a>';
	echo wp_json_encode(
		array(
			'suggestions'   => $suggestions,
			'view_all_link' => $view_all_html,
		)
	);
	exit();
}

add_action( 'wp_ajax_commercekit_ajax_search', 'commercekit_ajax_do_search' );
add_action( 'wp_ajax_nopriv_commercekit_ajax_search', 'commercekit_ajax_do_search' );

/**
 * Ajax search form html
 *
 * @param  string $html of form.
 */
function commercekit_ajax_search_form( $html ) {
	$commercekit_options = get_option( 'commercekit', array() );
	$placeholder_text    = isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? stripslashes_deep( $commercekit_options['ajs_placeholder'] ) : esc_html__( 'Search products...', 'commercegurus-commercekit' );

	$html = preg_replace( '/placeholder=\"([^"]*)\"/i', 'placeholder="' . $placeholder_text . '"', $html );

	return $html;
}
add_filter( 'get_search_form', 'commercekit_ajax_search_form', 99 );
add_filter( 'get_product_search_form', 'commercekit_ajax_search_form', 99 );

