import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText
} from '@wordpress/block-editor';
import { Button, PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		backgroundImage = '',
		heading = '',
		subheading = '',
		button1Text = '',
		button1Url = '',
		button2Text = '',
		button2Url = '',
	} = attributes;

	const blockProps = useBlockProps({
		className: 'relative w-full overflow-hidden border border-dashed border-gray-300 p-8 text-center'
	});

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Hero Settings', 'gld-blocks')} initialOpen={true}>
					
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) => setAttributes({ backgroundImage: media?.url || '' })}
								allowedTypes={['image']}
								render={({ open }) => (
									<Button onClick={open} variant="secondary">
										{__('Change Background Image', 'gld-blocks')}
									</Button>
								)}
							/>
						</MediaUploadCheck>
					

					
						<TextControl
							label={__('Heading', 'gld-blocks')}
							value={heading}
							onChange={(value) => setAttributes({ heading: value || '' })}
						/>

					

					
						<TextControl
							label={__('Subheading', 'gld-blocks')}
							value={subheading}
							onChange={(value) => setAttributes({ subheading: value || '' })}
						/>
					

					
						<TextControl
							label={__('Button 1 Text', 'gld-blocks')}
							value={button1Text}
							onChange={(value) => setAttributes({ button1Text: value || '' })}
						/>
					

					
						<TextControl
							label={__('Button 1 URL', 'gld-blocks')}
							value={button1Url}
							onChange={(value) => setAttributes({ button1Url: value || '' })}
						/>
					

					
						<TextControl
							label={__('Button 2 Text', 'gld-blocks')}
							value={button2Text}
							onChange={(value) => setAttributes({ button2Text: value || '' })}
						/>
					

					
						<TextControl
							label={__('Button 2 URL', 'gld-blocks')}
							value={button2Url}
							onChange={(value) => setAttributes({ button2Url: value || '' })}
						/>
					
				</PanelBody>
			</InspectorControls>

			{/* Simplified Preview */}
			<div {...blockProps} style={{ backgroundImage: backgroundImage ? `url(${backgroundImage})` : 'none', backgroundSize: 'cover', backgroundPosition: 'center', color: 'white', }}>
				<div className="bg-black-50 p-6 rounded-lg inline-block">
				<RichText.Content
					tagName="h1"
					className="text-3xl md:text-4xl font-bold text-white mb-4 font-montserrat"
					value={heading}
				/>

					<p className="text-white text-lg mb-6">
						{subheading || __('Hero Subheading', 'gld-blocks')}
					</p>
					<div className="flex flex-col sm:flex-row gap-4 justify-center">
						<a href={button1Url || '#'} className="bg-red-600 hover:bg-red-700 text-white text-base px-6 py-2 rounded-md text-center">
							{button1Text || __('Button 1', 'gld-blocks')}
						</a>
						<a href={button2Url || '#'} className="bg-white/10 text-white border border-white hover:bg-white/20 text-base px-6 py-2 rounded-md text-center">
							{button2Text || __('Button 2', 'gld-blocks')}
						</a>
					</div>
				</div>
			</div>
		</>
	);
}
