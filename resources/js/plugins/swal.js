import Swal from 'sweetalert2';

export function quickAlert({
  icon = 'error',
  title = 'Oops...',
  text = 'Something went wrong!',
  reverseButtons = true,
  confirmButtonText = 'ok',
  cancelButtonText = 'cancel',
}) {
  return Swal.fire({
    icon,
    title,
    html: text,
    reverseButtons,
    confirmButtonText,
    cancelButtonText,
  });
}

export default Swal;