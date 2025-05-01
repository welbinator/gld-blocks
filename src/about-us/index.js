import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';

registerBlockType('gld-blocks/about-us', {
	edit,
	save: () => null,
});
