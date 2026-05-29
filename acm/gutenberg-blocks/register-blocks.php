<?php



add_filter( 'block_categories_all', 'example_block_category', 10, 2 );
function example_block_category( $categories, $post ) {

	array_push(
		$categories,
		array(
			'slug'  => 'acm-category',
			'title' => __( 'ACM Blocks', 'acm' ),
			'icon'  => null,
		)
	);

	return $categories;
}

function register_acm_blocks() {
	register_block_type( __DIR__ . '/acm-banner/build' );
	register_block_type( __DIR__ . '/acm-breadcrumbs/build' );
	register_block_type( __DIR__ . '/acm-comments/build' );
	register_block_type( __DIR__ . '/acm-footer/build' );
	register_block_type( __DIR__ . '/acm-header/build' );
	register_block_type( __DIR__ . '/acm-main-wrapper/build' );
	register_block_type( __DIR__ . '/acm-page-404/build' );
	register_block_type( __DIR__ . '/acm-page-content/build' );
	register_block_type( __DIR__ . '/acm-query-loop/build' );
	register_block_type( __DIR__ . '/acm-row-wrapper/build' );
	register_block_type( __DIR__ . '/acm-search/build' );
	register_block_type( __DIR__ . '/acm-side-bar/build' );
	register_block_type( __DIR__ . '/acm-single-content/build' );
}
add_action( 'init', 'register_acm_blocks' );

// npx @wordpress/create-block --variant dynamic --namespace "acm-banner" --title "ACM Banner" --short-description "This is a banner for front page." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-breadcrumbs" --title "ACM Breadcrumbs" --short-description "Breadcrumbs allow you to navigate to any page which is higher in hierarchy than the current one is." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-side-bar" --title "ACM Side Bar" --short-description "This is a side bar block, which lets you add other blocks to your side bar." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-screen-reader-front-page" --title "ACM Screen Reader For Front Page" --short-description "This is text for screen readers." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-query-loop" --title "ACM Query Loop" --short-description "This block renders posts." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-page-content" --title "ACM Page Content" --short-description "This block renders page's content." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-page-404" --title "ACM Page Content" --short-description "This block renders page's content." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-comments" --title "ACM Comments" --short-description "This block adds comments to a post." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-single" --title "ACM Single" --short-description "This block shows post content." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-search" --title "ACM Search" --short-description "This block shows search results." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm-archive" --title "ACM Archive" --short-description "This block renders all posts in any selected category." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm" --title "ACM Main Wrapper" --short-description "This block creates body for all other blocks inside." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm" --title "ACM Single Content" --short-description "This block renders content for a single post." --category theme
// npx @wordpress/create-block --variant dynamic --namespace "acm" --title "ACM Row Wrapper" --short-description "Wrapper Block." --category theme
