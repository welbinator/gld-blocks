<?php

function gld_blocks_render_market_outlook( $attributes ) {
	$button_text = esc_html( $attributes['buttonText'] ?? 'Download the Report' );
	$button_url  = esc_url( $attributes['buttonUrl'] ?? '#' );

	ob_start(); ?>

	<section class="py-16 bg-gray-900 text-white">
		<div class="container mx-auto px-4">
			<h2 class="text-3xl md:text-4xl font-bold mb-12 text-center font-montserrat">
				Cedar Rapids Metro Commercial Real Estate Outlook
			</h2>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
				<?php
				$items = [
					['icon' => 'building-2', 'title' => 'Industrial', 'url' => '/industrial'],
					['icon' => 'building', 'title' => 'Office', 'url' => '/office'],
					['icon' => 'store', 'title' => 'Retail / Service', 'url' => '/retail'],
					['icon' => 'hotel', 'title' => 'Multifamily / Mixed Use', 'url' => '/multifamily-mixed-use'],
				];

				foreach ( $items as $item ) :
					?>
					<div class="bg-gray-800 p-8 rounded-lg text-center hover:bg-gray-700 transition-colors">
						<div class="flex justify-center mb-6">
							<?php echo gld_blocks_icon_svg( $item['icon'], 'h-12 w-12 text-red-500' ); ?>
						</div>
						<h3 class="text-xl font-semibold mb-4"><?php echo esc_html( $item['title'] ); ?></h3>
						<a href="<?php echo esc_url( $item['url'] ); ?>" class="text-red-400 hover:text-red-300 inline-block mt-2">Learn More</a>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="mt-12 text-center">
				<h4 class="text-xl mb-6">An in-depth analysis of annual market conditions</h4>
				<a href="<?php echo $button_url; ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded">
					<?php echo $button_text; ?>
				</a>
			</div>
		</div>
	</section>

	<?php return ob_get_clean();
}

function gld_blocks_icon_svg( $name, $class = '' ) {
	switch ( $name ) {
		case 'building-2':
			return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 h-12 w-12 text-red-500"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>';
		case 'building':
			return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building h-12 w-12 text-red-500"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M12 6h.01"></path><path d="M12 10h.01"></path><path d="M12 14h.01"></path><path d="M16 10h.01"></path><path d="M16 14h.01"></path><path d="M8 10h.01"></path><path d="M8 14h.01"></path></svg>';
		case 'store':
			return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-store h-12 w-12 text-red-500"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"></path><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"></path><path d="M2 7h20"></path><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"></path></svg>';
		case 'hotel':
			return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel h-12 w-12 text-red-500"><path d="M10 22v-6.57"></path><path d="M12 11h.01"></path><path d="M12 7h.01"></path><path d="M14 15.43V22"></path><path d="M15 16a5 5 0 0 0-6 0"></path><path d="M16 11h.01"></path><path d="M16 7h.01"></path><path d="M8 11h.01"></path><path d="M8 7h.01"></path><rect x="4" y="2" width="16" height="20" rx="2"></rect></svg>';
		default:
			return '';
	}
}
