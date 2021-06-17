/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default async function save( props ) {
	async function getStudentsJSON() {
		let url = 'http://localhost/testing/wp-json/students/' + props.attributes.status;
		let options = {
			method: 'get',
			// headers: {
			// 	'Content-Type': 'application/json'
			// }
		}
		let response = await fetch(url, options);
		return await response.json();
	}

	async function displayStudents() {
		let studentsArr = await getStudentsJSON();
		let output = [];
		// studentsArr.forEach((student, index) => function () {
		// 	output.push(
		// 		// wp.element.createElement("li", null,
		// 			studentsArr[index]["post_title"]
		// 		// )
		// 	)
		// })
		for (let i = 0; i < studentsArr.length; i++) {
			output.push(studentsArr[i]["post_title"]);
		}

		console.log(output.join(", "))
		return wp.element.createElement("h1", null, output.join(", "));
	}

	return await displayStudents();
}
