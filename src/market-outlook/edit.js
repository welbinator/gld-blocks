import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { buttonText, buttonUrl } = attributes;

    const blockProps = useBlockProps({
        className: 'market-outlook-block bg-gray-900 text-white p-4'
    });

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Button Settings', 'gld-blocks')}>
                    <TextControl
                        label={__('Button Text', 'gld-blocks')}
                        value={buttonText}
                        onChange={(value) => setAttributes({ buttonText: value })}
                    />
                    <TextControl
                        label={__('Button URL', 'gld-blocks')}
                        value={buttonUrl}
                        onChange={(value) => setAttributes({ buttonUrl: value })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <p>{__('Cedar Rapids Metro Commercial Real Estate Outlook', 'gld-blocks')}</p>
                <p>{__('This is a placeholder preview. View on the front end for full layout.', 'gld-blocks')}</p>
            </div>
        </>
    );
}
