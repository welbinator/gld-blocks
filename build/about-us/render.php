<?php

function gld_blocks_render_about_us( $attributes ) {
	ob_start();

	$heading     = $attributes['heading'] ?? '';
	$intro       = $attributes['intro'] ?? '';
	$paragraph1  = $attributes['paragraph1'] ?? '';
	$paragraph2  = $attributes['paragraph2'] ?? '';
	$button_text = $attributes['buttonText'] ?? '';
	$button_url  = $attributes['buttonUrl'] ?? '#';
	$list1       = $attributes['list1'] ?? [];
	$list2       = $attributes['list2'] ?? [];

	?>
	<section class="py-16 bg-white">
		<div class="container mx-auto px-4">
			<h2 class="text-3xl md:text-4xl font-bold mb-8 text-red-600 font-montserrat"><?php echo esc_html( $heading ); ?></h2>

			<div class="prose prose-lg max-w-none mb-10"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
				<div>
					<h3 class="text-2xl font-bold mb-6">
						GLD Commercial<br><span class="font-normal">Service Offerings:</span>
					</h3>
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
						<ul class="space-y-2">
							<?php foreach ( $list1 as $item ) : ?>
								<li class="flex items-center">
									<span class="h-1.5 w-1.5 rounded-full bg-red-600 mr-2"></span>
									<?php echo esc_html( $item ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
						<ul class="space-y-2">
							<?php foreach ( $list2 as $item ) : ?>
								<li class="flex items-center">
									<span class="h-1.5 w-1.5 rounded-full bg-red-600 mr-2"></span>
									<?php echo esc_html( $item ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<div class="prose prose-lg">
					<?php echo wp_kses_post( wpautop( $paragraph1 ) ); ?>
					<?php echo wp_kses_post( wpautop( $paragraph2 ) ); ?>
				</div>
			</div>

			<div class="text-center">
				<a href="<?php echo esc_url( $button_url ); ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded">
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
