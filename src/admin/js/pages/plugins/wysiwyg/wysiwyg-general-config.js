import { Tooltip } from 'bootstrap';
import Quill from 'quill';

const form = document.querySelector('#form');
const editorContainers = document.querySelectorAll('.wysiwyg-editor');
editorContainers.forEach((editorContainer) => {
  const tooltip = new Tooltip(editorContainer);
  tooltip.disable();
  const editor = editorContainer.querySelector('.editor');
  const quillEditor = new Quill(editor, {
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
  });
  const inputHidden = editorContainer.querySelector('.input-wysiwyg');
  toggleSubmit(quillEditor, tooltip, form);
  quillEditor.root.innerHTML = inputHidden.value;
  quillEditor.on('editor-change', function () {
    inputHidden.value = quillEditor.root.innerHTML;
    toggleSubmit(quillEditor, tooltip, form);
  });
});

function handleSubmit(event) {
  console.log('hey');
  event.preventDefault();
}

function isQuillEmpty(quill) {
  const regex = /<[^>]*>/g;
  const body = quill.root.innerHTML;
  const isEmpty = !body.replace(regex, '').length;
  return isEmpty;
}

function toggleSubmit(quill, tooltip, form) {
  if (isQuillEmpty(quill)) {
    tooltip.show();
    console.log('mamó');
    form.addEventListener('submit', (e) => handleSubmit(e));
  } else {
    tooltip.disable();
    form.removeEventListener('submit', (e) => handleSubmit(e));
  }
}
