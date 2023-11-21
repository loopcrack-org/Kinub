import Plyr from 'plyr';
import Swal from 'sweetalert2';
import customSelect from 'custom-select';

new Plyr('#kinub-video');
customSelect('select');

const showAlert = (props) => {
  Swal.fire({
    ...props,
  });
};

window.showAlert = showAlert;
