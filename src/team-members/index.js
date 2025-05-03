import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';

registerBlockType('gld/team-members', {
	edit: Edit,
	save: () => null,
});
