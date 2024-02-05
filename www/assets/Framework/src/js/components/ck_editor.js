let editor;


document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: 'http://localhost:8081/FileStorage/ckeditor_upload.php'
            }
        })
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch(error => {
            console.error('There was a problem initializing the editor.', error);
        });
});


document.querySelector( '#submit_btn' ).addEventListener( 'click', () => {
    const editorData = editor.getData();
} );