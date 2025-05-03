<?php

function gld_blocks_render_sior_ccim($attributes) {
	$siorTitle    = $attributes['siorTitle'] ?? '';
	$siorVideoUrl = $attributes['siorVideoUrl'] ?? '';
	$siorText     = $attributes['siorText'] ?? '';
	$siorLogo     = $attributes['siorLogo'] ?? '';

	$ccimTitle    = $attributes['ccimTitle'] ?? '';
	$ccimText     = $attributes['ccimText'] ?? '';
	$ccimLogo     = $attributes['ccimLogo'] ?? '';

	// Query team members with CCIM or SIOR taxonomy term
	$args = [
		'post_type'      => 'team_member',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'tax_query'      => [
			[
				'taxonomy' => 'team_member_designation',
				'field'    => 'slug',
				'terms'    => ['sior', 'ccim'],
			],
		],
		'orderby' => 'menu_order',
		'order'   => 'ASC',
	];
	$team_query = new WP_Query($args);

	ob_start();
	?>
	<div class="container mx-auto px-4 py-12">
		<section class="mb-16">
			<h2 class="text-3xl font-semibold text-red-600 mb-8 font-montserrat"><?php echo esc_html($siorTitle); ?></h2>
			<div class="max-w-2xl mx-auto mb-10">
				<div class="relative" style="padding-bottom: 85%;">
					<iframe
						src="<?php echo esc_url($siorVideoUrl); ?>"
						title="SIOR Video"
						class="absolute top-0 left-0 w-full h-full rounded-lg"
						frameborder="0"
						allowfullscreen
					></iframe>
				</div>
			</div>
			<div class="sior-text prose prose-lg max-w-none mb-8">
				<?php echo wp_kses_post($siorText); ?>
			</div>
			<div class="max-w-xs mb-12">
				<img src="<?php echo esc_url($siorLogo); ?>" alt="SIOR Logo" class="h-auto">
			</div>
		</section>

		<section class="mb-16">
			<h2 class="text-3xl font-semibold text-red-600 mb-8 font-montserrat"><?php echo esc_html($ccimTitle); ?></h2>
			<div class="ccim-text prose prose-lg max-w-none mb-8">
				<?php echo wp_kses_post($ccimText); ?>
			</div>
			<div class="max-w-xs mb-12">
				<img src="<?php echo esc_url($ccimLogo); ?>" alt="CCIM Logo" class="h-auto">
			</div>
		</section>

		<?php if ($team_query->have_posts()) : ?>
			<section>
				<h2 class="text-3xl font-semibold text-red-600 mb-8 font-montserrat">GLD Designees</h2>
				<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
					<?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
						<?php
						$name     = get_the_title();
						$title    = get_post_meta(get_the_ID(), 'gld_team_member_title', true);
						$image    = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://via.placeholder.com/150';
						?>
						<div class="text-center">
							<div class="relative w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full">
								<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="object-cover w-full h-full">
							</div>
							<h3 class="font-semibold"><?php echo esc_html($name); ?></h3>
							<?php if ($title): ?>
								<p class="text-sm text-gray-600"><?php echo esc_html($title); ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</section>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}
