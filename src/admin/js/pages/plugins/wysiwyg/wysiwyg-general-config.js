import Quill from 'quill';

const wysiwygOptions = {
  modules: {
    toolbar: [
      [{ header: [4, 5, 6, false] }],
      [{ size: ['small', false] }], // custom dropdown
      ['bold', 'italic', 'underline', 'strike'], // toggled buttons
      ['blockquote'],
      ['link', 'image'],

      [{ list: 'ordered' }, { list: 'bullet' }],
      [{ script: 'sub' }, { script: 'super' }], // superscript/subscript
      [{ indent: '-1' }, { indent: '+1' }], // outdent/indent

      [{ align: [] }],

      ['clean'],
    ],
  },
  placeholder: 'Escribe algo aquí...',
  theme: 'snow', // or 'bubble'
};

const editorContainers = document.querySelectorAll('.wysiwyg-editor');
editorContainers.forEach((editorContainer) => {
  const editor = editorContainer.querySelector('.editor');
  const inputHidden = editorContainer.querySelector('.input-wysiwyg');
  const quillEditor = new Quill(editor, wysiwygOptions);

  // initial content
  quillEditor.root.innerHTML = inputHidden.value;

  quillEditor.on('text-change', function () {
    // set html into input
    inputHidden.value = quillEditor.root.innerHTML;
  });
});
