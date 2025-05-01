import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls
} from '@wordpress/block-editor';
import {
	PanelBody,
	CheckboxControl,
	SelectControl
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export default function Edit({ attributes, setAttributes }) {
	const {
		propertyTypes = [],
		displayAddress = true,
		displayType = true,
		displaySize = true,
		displayPrice = true,
	} = attributes;

	const blockProps = useBlockProps();

	// Load property_type terms dynamically
	const propertyTypeTerms = useSelect((select) => {
		return select('core').getEntityRecords('taxonomy', 'property_type', { per_page: -1 });
	}, []);

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Property Types', 'gld-blocks')} initialOpen={true}>
					{propertyTypeTerms ? propertyTypeTerms.map((term) => (
						<CheckboxControl
							key={term.id}
							label={term.name}
							checked={propertyTypes.includes(term.slug)}
							onChange={(isChecked) => {
								const newTypes = isChecked
									? [...propertyTypes, term.slug]
									: propertyTypes.filter((slug) => slug !== term.slug);
								setAttributes({ propertyTypes: newTypes });
							}}
						/>
					)) : <p>{__('Loading property types...', 'gld-blocks')}</p>}
				</PanelBody>

				<PanelBody title={__('Info to Display', 'gld-blocks')} initialOpen={false}>
					<CheckboxControl
						label={__('Address', 'gld-blocks')}
						checked={displayAddress}
						onChange={(val) => setAttributes({ displayAddress: val })}
					/>
					<CheckboxControl
						label={__('Type', 'gld-blocks')}
						checked={displayType}
						onChange={(val) => setAttributes({ displayType: val })}
					/>
					<CheckboxControl
						label={__('Square Footage', 'gld-blocks')}
						checked={displaySize}
						onChange={(val) => setAttributes({ displaySize: val })}
					/>
					<CheckboxControl
						label={__('Price', 'gld-blocks')}
						checked={displayPrice}
						onChange={(val) => setAttributes({ displayPrice: val })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<p><strong>{__('Featured Properties', 'gld-blocks')}</strong></p>
				<p>{__('Block Preview — select options on the right →', 'gld-blocks')}</p>
			</div>
		</>
	);
}
