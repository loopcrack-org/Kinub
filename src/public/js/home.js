import customSelect from 'custom-select';
import Plyr from 'plyr';
import Swal from 'sweetalert2';

new Plyr('#kinub-video');

const cstSel = customSelect('#product-name')[0];

cstSel.container.addEventListener('custom-select:open', () => {
  cstSel.container.classList.add('turn-arrow');
});

cstSel.container.addEventListener('custom-select:close', () => {
  cstSel.container.classList.remove('turn-arrow');
});

const showAlert = (props) => {
  Swal.fire({
    ...props,
  });
};

window.showAlert = showAlert;
