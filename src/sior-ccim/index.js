import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';

registerBlockType('gld/sior-ccim', {
  edit: Edit,
  save: () => null,
});
