import Quill from 'quill';

const editorContainers = document.querySelectorAll('.wysiwyg-editor');
editorContainers.forEach((editorContainer) => {
  const editor = editorContainer.querySelector('.editor');
  const quillEditor = new Quill(editor, {
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, 4, 5, 6, false] }],
        [{ header: 1 }, { header: 2 }], // custom button values
        [{ font: [] }],
        [{ size: ['small', false, 'large', 'huge'] }], // custom dropdown
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote'],
        ['link', 'image'],

        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
        [{ indent: '-1' }, { indent: '+1' }], // outdent/indent
        [{ direction: 'rtl' }], // text direction

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ align: [] }],

        ['clean'],
      ],
    },
    placeholder: 'Escribe algo aquí...',
    theme: 'snow', // or 'bubble'
  });
  const inputHidden = editorContainer.querySelector('.input-wysiwyg');
  quillEditor.root.innerHTML = inputHidden.value;
  quillEditor.on('editor-change', function () {
    inputHidden.value = quillEditor.root.innerHTML;
  });
});
