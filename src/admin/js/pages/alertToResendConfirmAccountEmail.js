import Swal from 'sweetalert2';
const resendEmailBtns = document.querySelectorAll('.btn-resendEmail');

resendEmailBtns.forEach((resendEmailBtn) => {
  resendEmailBtn.addEventListener('click', async function (e) {
    e.preventDefault();
    const result = await Swal.fire({
      icon: 'question',
      title: 'Reenvio de correo de confirmación de cuenta',
      text: '¿Está seguro de que desea reenviar el correo para la confirmación de la cuenta del usuario?',
      showCancelButton: true,
      confirmButtonColor: '#0174F6',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
    });

    if (result.isConfirmed) {
      location.href = e.target.href;
    }
  });
});
