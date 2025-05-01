import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<div {...useBlockProps({ className: 'testimonial-placeholder-block' })}>
			<p>Testimonials will appear here on the front-end.</p>
		</div>
	);
}
