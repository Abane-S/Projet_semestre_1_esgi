// import * as InlineEditor from '../../../../../node_modules/@ckeditor/ckeditor5-build-inline/build/ckeditor.js';

ClassicEditor
	.create( document.querySelector( '#editor' ))
	.then( editor => {
		window.editor = editor;
	} )
	.catch( error => {
		console.error( 'There was a problem initializing the editor.', error );
	} );


