<?php

function gld_blocks_render_home_hero( $attributes ) {
	ob_start();

	// Safely fetch attributes.
	$background_image = esc_url( $attributes['backgroundImage'] ?? '' );
	$subheading       = esc_html( $attributes['subheading'] ?? '' );
	$button1_text     = esc_html( $attributes['button1Text'] ?? '' );
	$button1_url      = esc_url( $attributes['button1Url'] ?? '#' );
	$button2_text     = esc_html( $attributes['button2Text'] ?? '' );
	$button2_url      = esc_url( $attributes['button2Url'] ?? '#' );
	error_log( print_r( $attributes['heading'], true ) );

	?>
	<div class="home-hero-block relative h-[600px] md:h-[700px] w-full overflow-hidden">
		<div class="absolute inset-0 w-full h-[120%] -top-[10%] bg-cover bg-center" style="background-image: url('<?php echo $background_image; ?>')"></div>

		<div class="absolute inset-0 bg-black/40 flex items-center justify-center px-4">
			<div class="max-w-2xl text-center">
				<h1 class="text-5xl md:text-6xl font-bold text-white mb-4 font-montserrat whitespace-pre-line">
					<?php echo wp_kses_post( $attributes['heading'] ?? '' ); ?>
				</h1>
				<p class="text-white text-xl mb-8">
					<?php echo $subheading; ?>
				</p>
				<div class="flex flex-col sm:flex-row gap-4 justify-center">
					<a href="<?php echo $button1_url; ?>" class="bg-red-600 hover:bg-red-700 text-white text-lg px-6 py-3 rounded-md text-center">
						<?php echo $button1_text; ?>
					</a>
					<a href="<?php echo $button2_url; ?>" class="bg-white/10 text-white border border-white hover:bg-white/20 text-lg px-6 py-3 rounded-md text-center">
						<?php echo $button2_text; ?>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php

	return ob_get_clean();
}