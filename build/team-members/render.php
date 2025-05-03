<?php

function gld_blocks_render_team_members($attributes, $content) {
	$args = array(
		'post_type'      => 'team_member',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$query = new WP_Query($args);

	ob_start();
	?>
	<main class="min-h-screen">
		<div class="bg-white min-h-screen">
			
			<div class="container mx-auto px-4 py-16">
				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
					<?php if ($query->have_posts()) :
						while ($query->have_posts()) :
							$query->the_post();
							$name = get_the_title();
							$title = get_post_meta(get_the_ID(), 'gld_team_member_title', true);
							$image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://via.placeholder.com/600x600';
							$link = get_permalink();
							?>
							<a href="<?php echo esc_url($link); ?>" class="group block rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg">
								<div class="relative h-80 overflow-hidden">
									<img alt="<?php echo esc_attr($name); ?>" loading="lazy" decoding="async" class="object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url($image); ?>" style="position: absolute; height: 100%; width: 100%; inset: 0px;" />
									<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
								</div>
								<div class="p-6 pt-6 pb-6 text-center">
									<h3 class="text-xl font-semibold group-hover:text-red-600 transition-colors"><?php echo esc_html($name); ?></h3>
									<?php if ($title) : ?>
										<p class="text-gray-600 mt-1"><?php echo esc_html($title); ?></p>
									<?php endif; ?>
								</div>
							</a>
						<?php endwhile;
						wp_reset_postdata();
					else : ?>
						<p class="text-gray-600">No team members found.</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</main>
	<?php
	return ob_get_clean();
}
