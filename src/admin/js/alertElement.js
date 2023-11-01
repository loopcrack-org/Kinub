import Swal from 'sweetalert2';

displayAlert();
function displayAlert() {
  const alertResponse = document.querySelector('#alertElement');

  if (alertResponse) {
    const responseData = JSON.parse(alertResponse.getAttribute('data-response'));

    setTimeout(function () {
      Swal.fire({
        icon: responseData.type,
        title: responseData.title,
        text: responseData.message,
        confirmButtonColor: '#0174F6',
      });
    }, 5);
  }
}
