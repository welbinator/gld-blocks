import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		heading,
		intro,
		paragraph1,
		paragraph2,
		buttonText,
		buttonUrl,
		list1,
		list2
	} = attributes;

	const updateListItem = (index, value, listName) => {
		const newList = [...(listName === 'list1' ? list1 : list2)];
		newList[index] = value;
		setAttributes({ [listName]: newList });
	};

	const blockProps = useBlockProps({ className: 'py-16 bg-white' });

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Button Settings', 'gld-blocks')}>
					<TextControl
						label={__('Button Text', 'gld-blocks')}
						value={buttonText}
						onChange={(val) => setAttributes({ buttonText: val })}
					/>
					<TextControl
						label={__('Button URL', 'gld-blocks')}
						value={buttonUrl}
						onChange={(val) => setAttributes({ buttonUrl: val })}
					/>
				</PanelBody>
			</InspectorControls>

			<section {...blockProps}>
				<div className="container mx-auto px-4">
					<RichText
						tagName="h2"
						className="text-3xl md:text-4xl font-bold mb-8 text-red-600 font-montserrat"
						value={heading}
						onChange={(val) => setAttributes({ heading: val })}
						placeholder={__('About Us', 'gld-blocks')}
					/>

					<div className="prose prose-lg max-w-none mb-10">
						<RichText
							tagName="p"
							value={intro}
							onChange={(val) => setAttributes({ intro: val })}
							placeholder={__('Intro paragraph...', 'gld-blocks')}
						/>
					</div>

					<div className="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
						<div>
							<h3 className="text-2xl font-bold mb-6">
								GLD Commercial<br /><span className="font-normal">Service Offerings:</span>
							</h3>

							<div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
								<ul className="space-y-2">
									{list1.map((item, i) => (
										<li key={i} className="flex items-center">
											<span className="h-1.5 w-1.5 rounded-full bg-red-600 mr-2"></span>
											<TextControl
												value={item}
												onChange={(val) => updateListItem(i, val, 'list1')}
											/>
										</li>
									))}
								</ul>
								<ul className="space-y-2">
									{list2.map((item, i) => (
										<li key={i} className="flex items-center">
											<span className="h-1.5 w-1.5 rounded-full bg-red-600 mr-2"></span>
											<TextControl
												value={item}
												onChange={(val) => updateListItem(i, val, 'list2')}
											/>
										</li>
									))}
								</ul>
							</div>
						</div>

						<div className="prose prose-lg space-y-6">
							<RichText
								tagName="p"
								value={paragraph1}
								onChange={(val) => setAttributes({ paragraph1: val })}
								placeholder={__('Paragraph 1', 'gld-blocks')}
							/>
							<RichText
								tagName="p"
								value={paragraph2}
								onChange={(val) => setAttributes({ paragraph2: val })}
								placeholder={__('Paragraph 2', 'gld-blocks')}
							/>
						</div>
					</div>

					<div className="text-center">
						<a href={buttonUrl} className="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded">
							{buttonText || __('Meet Our Team', 'gld-blocks')}
						</a>
					</div>
				</div>
			</section>
		</>
	);
}
