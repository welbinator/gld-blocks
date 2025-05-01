import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	const blockProps = useBlockProps({
		className: 'property-search-editor-preview'
	});

	return (
		<div {...blockProps}>
			<div className="property-search-inner">
				<p style={{ fontWeight: 'bold', marginBottom: '8px' }}>Property Search Form</p>
				<p style={{ fontSize: 'smaller', color: '#666' }}>
					(Preview only — form will appear on frontend)
				</p>
			</div>
		</div>
	);
}
