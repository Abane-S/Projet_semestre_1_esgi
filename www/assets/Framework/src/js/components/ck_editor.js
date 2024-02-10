let editor;


document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');
    if (editorElement) {
        ClassicEditor
            .create(editorElement, {
                ckfinder: {
                    uploadUrl: 'http://localhost:8081/FileStorage/ckeditor_upload.php'
                }
            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });
    } else {
        console.log('The #editor element was not found.');
    }


    const submitBtn = document.querySelector('#submit_btn');
    if (submitBtn) {
        submitBtn.addEventListener('click', () => {
            if (editor) {
                const editorData = editor.getData();
                // Ici, vous pouvez utiliser editorData comme vous le souhaitez
            } else {
                console.error('Editor is not initialized');
            }
        });
    } else {
        console.log('The #submit_btn element was not found.');
    }


});