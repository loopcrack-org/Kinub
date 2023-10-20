import Swal from 'sweetalert2';

displayAlert();
function displayAlert() {
  const alertResponse = document.querySelector('#alert-deletedcategory');
  const darkMode = document.querySelector('[data-bs-theme]');

  if (alertResponse) {
    const responseData = JSON.parse(alertResponse.getAttribute('data-response'));

    setTimeout(function () {
      if (darkMode && darkMode.getAttribute('data-bs-theme') === 'dark') {
        document.querySelector('body').classList.add('darkMode');
      }

      Swal.fire({
        icon: responseData.type,
        title: responseData.title,
        text: responseData.message,
        confirmButtonColor: '#0174F6',
      });
    }, 5);
  }
}
