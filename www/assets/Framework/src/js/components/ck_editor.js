


ClassicEditor
	.create( document.querySelector( '#editor' ), { 
		plugins: [ SimpleUploadAdapter ],
		simpleUpload: {
			uploadUrl: "http://localhost:8081/FileStorage/Upload.php"
		}
	})
	.then( editor => {
		window.editor = editor;
		console.log("Éditeur créé avec succès");
	} )
	.catch( error => {
		console.error( 'There was a problem initializing the editor.', error );
	} );


