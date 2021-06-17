/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { useBlockProps } from '@wordpress/block-editor';

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


export default function Edit(props) {
	function updateStatus(event) {
		props.setAttributes({status: event.target.value})
	}

	function updateCount(event) {
		props.setAttributes({count: event.target.value})
	}

	return wp.element.createElement(
		"div",
		null,
		wp.element.createElement(
			"label",
			{
				for: "status"
			},
			"Status:"
		),
		wp.element.createElement(
			"select",
			{
				name: "status",
				onChange: updateStatus
			},
			wp.element.createElement(
				"option",
				{
					value: "active"
				},
				"Active"
			),
			wp.element.createElement(
				"option",
				{
					value: "inactive"
				},
				"Inactive"
			)
		),
		wp.element.createElement("label", {
			for: "count"
		}, "Count:"),
		wp.element.createElement("input", {
			type: "text",
			name: "count",
			value: props.attributes.count,
			onChange: updateCount
		})
	);
}
