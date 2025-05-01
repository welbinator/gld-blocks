<?php

function gld_blocks_render_property_search( $attributes, $content ) {
	ob_start();
	?>

	<div class="bg-gray-900 py-8">
		<div class="container mx-auto px-4">
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
				<div class="relative">
					<input type="text" name="s" placeholder="Search: Address, MLS#, City..." class="w-full pl-10 bg-white py-2 px-3 rounded" />
					<span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">
						<?php esc_html_e( '🔍', 'gld-blocks' ); ?>
					</span>
				</div>

				<select name="area" class="w-full bg-white py-2 px-3 rounded">
					<option value="">Select an Area...</option>
					<option value="sw-quadrant">SW Quadrant</option>
					<option value="se-quadrant">SE Quadrant</option>
					<option value="ne-quadrant">NE Quadrant</option>
					<option value="nw-quadrant">NW Quadrant</option>
					<option value="hiawatha-robins">Hiawatha/Robins</option>
					<option value="marion">Marion</option>
					<option value="iowa-city">Iowa City/Coralville</option>
					<option value="corridor-area">Corridor Area</option>
				</select>

				<select name="property_type" class="w-full bg-white py-2 px-3 rounded">
					<option value="">Select a Purchase Type...</option>
					<option value="for-lease">For Lease</option>
					<option value="for-sale">For Sale</option>
				</select>

				<select name="property_type" class="w-full bg-white py-2 px-3 rounded">
					<option value="">Select a Property Type...</option>
					<option value="commercial">Commercial</option>
					<option value="industrial">Industrial/Warehouse</option>
					<option value="office">Office</option>
					<option value="retail">Retail</option>
					<option value="investment">Investment</option>
					<option value="land">Land/Lot/Farm</option>
					<option value="multi-family">Multi-Family</option>
					<option value="special-purpose">Special Purpose</option>
				</select>

				<input type="hidden" name="post_type" value="gld_property" />

				<button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
					<?php esc_html_e( 'Search', 'gld-blocks' ); ?>
				</button>
			</form>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
