import { useBlockProps } from '@wordpress/block-editor';

export default function Edit() {
	return <div {...useBlockProps()}>Filter Properties block (frontend only)</div>;
}
