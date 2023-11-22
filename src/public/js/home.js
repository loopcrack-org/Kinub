import customSelect from 'custom-select';
import Plyr from 'plyr';
import Swal from 'sweetalert2';

new Plyr('#kinub-video');

const cstSel = customSelect('select')[0];
console.log;

cstSel.container.addEventListener('click', function name() {
  if (!cstSel.container.classList.contains('is-open')) {
    cstSel.container.classList.add('turn-arrow');
  } else {
    cstSel.container.classList.remove('turn-arrow');
  }
});

function detectarSelect(e) {
  e.preventDefault();
  if (cstSel.container.classList.contains('is-open')) {
    return;
  } else {
    cstSel.container.classList.remove('turn-arrow');
  }
}

document.addEventListener('click', detectarSelect);

const showAlert = (props) => {
  Swal.fire({
    ...props,
  });
};

window.showAlert = showAlert;
