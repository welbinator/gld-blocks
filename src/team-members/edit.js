import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			This block displays the team members in a responsive grid.
		</p>
	);
}
