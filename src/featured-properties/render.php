<?php

function gld_blocks_render_featured_properties( $attributes ) {
	ob_start();

	$property_types   = $attributes['propertyTypes'] ?? [];
	$display_address  = $attributes['displayAddress'] ?? true;
	$display_type     = $attributes['displayType'] ?? true;
	$display_size     = $attributes['displaySize'] ?? true;
	$display_price    = $attributes['displayPrice'] ?? true;

	$args = [
		'post_type'      => 'gld_property',
		'posts_per_page' => 6,
		'tax_query'      => [],
	];

	if ( ! empty( $property_types ) ) {
		$args['tax_query'][] = [
			'taxonomy' => 'property_type',
			'field'    => 'slug',
			'terms'    => $property_types,
		];
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) : ?>
		<section class="py-16 bg-gray-50">
			<div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 font-montserrat mb-10">
					<span class="text-red-600">GLD</span> Featured Properties
				</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php while ( $query->have_posts() ) :
						$query->the_post();

						$price = get_post_meta( get_the_ID(), 'property_price', true );
						$size      = get_post_meta( get_the_ID(), 'square_footage', true );
						$address   = get_post_meta( get_the_ID(), 'property_address', true );
						$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://via.placeholder.com/600x400?text=No+Image';

						// Sale type (used in badge)
						$sale_type_terms = get_the_terms( get_the_ID(), 'sale_type' );
						$sale_type_label = ( ! is_wp_error( $sale_type_terms ) && is_array( $sale_type_terms ) && isset( $sale_type_terms[0] ) )
							? $sale_type_terms[0]->name
							: '';

						// Property type (used in body)
						$property_type_terms = get_the_terms( get_the_ID(), 'property_type' );
						$property_type_label = ( ! is_wp_error( $property_type_terms ) && is_array( $property_type_terms ) && isset( $property_type_terms[0] ) )
							? $property_type_terms[0]->name
							: '';
						?>
						<div class="bg-white shadow rounded overflow-hidden transition-all duration-300 hover:shadow-lg">

							<div class="relative">
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-64 object-cover" />
								<?php if ( $sale_type_label ) : ?>
									<span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
										<?php echo esc_html( $sale_type_label ); ?>
									</span>
								<?php endif; ?>
							</div>
							<div class="p-6">
								<h3 class="text-xl font-semibold mb-2"><?php the_title(); ?></h3>

								<?php if ( $display_address && ! empty( $address ) ) : ?>
									<div class="flex items-center text-gray-600 mb-2 text-sm">
										<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3z"></path>
											<path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z"></path>
										</svg>
										<?php echo esc_html( $address ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $display_type && $property_type_label ) : ?>
                                    <div class="flex items-center text-gray-600 mb-2 text-sm">
                                        <?php
                                        switch ( strtolower( $property_type_label ) ) {
                                            case 'industrial':
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-warehouse h-4 w-4 mr-2"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"></path><path d="M6 18h12"></path><path d="M6 14h12"></path><rect width="12" height="12" x="6" y="10"></rect></svg>';
                                                break;
                                            case 'retail':
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-store h-4 w-4 mr-2"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>';
                                                break;
                                            default:
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building h-4 w-4 mr-2"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>';
                                                break;
                                        }
                                        ?>
                                        <?php echo esc_html( $property_type_label ); ?>
                                    </div>
                                <?php endif; ?>


								<?php if ( $display_size && ! empty( $size ) ) : ?>
									<div class="flex items-center text-gray-600 mb-2 text-sm">
										<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
											<rect width="18" height="18" x="3" y="3" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"></rect>
										</svg>
										<?php echo esc_html( $size ); ?> SF
									</div>
								<?php endif; ?>

								<?php if ( $display_price && ! empty( $price ) ) : ?>
									<div class="text-red-600 font-bold text-lg"><?php echo esc_html( $price ); ?></div>
								<?php endif; ?>
							</div>
							<div class="p-4">
								<a href="<?php the_permalink(); ?>" class="block text-center bg-gray-900 hover:bg-gray-800 text-white py-2 rounded">
									<?php esc_html_e( 'View Details', 'gld-blocks' ); ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>

				<div class="mt-10 text-center">
					<a href="/properties" class="inline-block border border-red-600 text-red-600 hover:bg-red-50 px-6 py-2 rounded">
						<?php esc_html_e( 'View All Properties', 'gld-blocks' ); ?>
					</a>
				</div>
			</div>
		</section>
	<?php endif;

	wp_reset_postdata();
	return ob_get_clean();
}
