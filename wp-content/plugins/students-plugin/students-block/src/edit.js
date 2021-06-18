/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

import { TextControl } from '@wordpress/components';
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import {
	Panel,
	PanelBody,
	PanelRow,
	RadioControl,
	__experimentalNumberControl as NumberControl,
} from "@wordpress/components";
import "./editor.scss";
import ServerSideRender from "@wordpress/server-side-render";

export default function Edit(props) {

	let updateStatus = (newStatus) => {
		props.setAttributes({ status: newStatus });
	}

	let updateCount = (newCount) => {
		props.setAttributes({ count: newCount });
	}
	console.log(props.attributes.count);
	return (
		<div {...useBlockProps()}>
				<InspectorControls key="setting">
					<Panel>
						<PanelBody title="Settings" initialOpen={true}>
							<PanelRow>
								<RadioControl
									label="Status:"
									onChange={updateStatus}
									selected={props.attributes.status}
									options={[
										{ label: "Active", value: "active" },
										{ label: "Inactive", value: "inactive" },
									]}
								/>
							</PanelRow>
							<PanelRow>
								<NumberControl
									label="Count:"
									onChange={updateCount}
									value={props.attributes.count}
								/>
							</PanelRow>
						</PanelBody>
					</Panel>
				</InspectorControls>

			<ServerSideRender block='create-block/students-block' attributes={props.attributes} />
		</div>
	);
}
