import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import './style.scss';

const Edit = () => {
	const blockProps = useBlockProps({
		className: 'testimonial-placeholder-block',
	});

	return (
		<div {...blockProps}>
			<p>{__('Testimonials block – dynamic content displayed on the front end.', 'gld-blocks')}</p>
		</div>
	);
};

registerBlockType('gld-blocks/testimonials', {
	title: __('Testimonials', 'gld-blocks'),
	icon: 'format-quote',
	category: 'widgets',
	edit: Edit,
	save: () => null, // dynamic block
});
