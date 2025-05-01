<?php

function gld_blocks_render_testimonials( $attributes ) {
	ob_start();

	$args = [
		'post_type'      => 'gld_review',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	];
	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		$testimonials = [];

		while ( $query->have_posts() ) :
			$query->the_post();
			$reviewer_title = get_post_meta( get_the_ID(), 'reviewer_title', true );
			$testimonials[] = [
				'content' => apply_filters( 'the_content', get_the_content() ),
				'author'  => get_the_title(),
				'title'   => $reviewer_title,
			];
		endwhile;

		// Only output if testimonials exist.
		if ( ! empty( $testimonials ) ) :
			$first = $testimonials[0];
			?>
			<section class="py-16 bg-gray-900 text-white relative">
				
				<div class="container mx-auto px-4 relative z-10">
					<div class="max-w-4xl mx-auto">
						<div class="text-center mb-10">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote h-12 w-12 text-red-500 mx-auto mb-4"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"></path><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"></path></svg>
							<h2 class="text-3xl md:text-4xl font-bold font-montserrat">What Our Clients Say</h2>
						</div>

						<div class="relative">
                            <?php foreach ( $testimonials as $index => $t ) : ?>
                                <div class="testimonial-slide <?php echo $index === 0 ? 'active' : ''; ?> rounded-lg border shadow-sm bg-gray-800 border-none text-white p-6 pt-6">
                                    <div class="text-center">
                                        <div class="text-lg md:text-xl italic mb-6 text-white">
                                            <?php echo apply_filters( 'the_content', $t['content'] ); ?>
                                        </div>
                                        <div class="mt-4">
                                            <p class="font-semibold text-lg text-white"><?php echo esc_html( $t['author'] ); ?></p>
                                            <?php if ( ! empty( $t['title'] ) ) : ?>
                                                <p class="text-gray-300"><?php echo esc_html( $t['title'] ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>




						<div class="flex justify-center mt-6">
                            <?php foreach ( $testimonials as $index => $t ) : ?>
                                <button
                                    class="testimonial-dot h-2 w-2 mx-1 rounded-full <?php echo $index === 0 ? 'bg-red-600' : 'bg-gray-600'; ?>"
                                    aria-label="View testimonial <?php echo $index + 1; ?>">
                                </button>
                            <?php endforeach; ?>
                        </div>

					</div>
				</div>
			</section>
			<?php
		endif;
	endif;

	wp_reset_postdata();
	return ob_get_clean();
}
