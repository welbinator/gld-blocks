import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';

registerBlockType('gld/filter-properties', {
	edit: Edit,
	save: Save,
});
