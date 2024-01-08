import Quill from 'quill';

const wysiwygOptions = {
  modules: {
    toolbar: [
      [{ header: [4, 5, 6, false] }],
      [{ size: ['small', false] }],
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote'],
      ['link', 'image'],

      [{ list: 'ordered' }, { list: 'bullet' }],
      [{ script: 'sub' }, { script: 'super' }],
      [{ indent: '-1' }, { indent: '+1' }],

      [{ align: [] }],

      ['clean'],
    ],
  },
  placeholder: 'Escribe algo aquí...',
  theme: 'snow',
};

const editorContainers = document.querySelectorAll('.wysiwyg-editor');
editorContainers.forEach((editorContainer) => {
  const editor = editorContainer.querySelector('.editor');
  const inputHidden = editorContainer.querySelector('.input-wysiwyg');
  const quillEditor = new Quill(editor, wysiwygOptions);

  quillEditor.root.innerHTML = inputHidden.value;

  quillEditor.on('text-change', function () {
    if (quillEditor.root.textContent !== '') {
      inputHidden.value = quillEditor.root.innerHTML;
    } else {
      inputHidden.value = '';
    }
  });
});
