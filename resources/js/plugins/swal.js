import Swal from 'sweetalert2';

export function swalBasic({
  icon = 'error',
  title = 'Oops...',
  html = 'Something went wrong!',
  reverseButtons = true,
  confirmButtonText = 'ok',
  cancelButtonText = 'cancel',
}) {
  return Swal.fire({
    icon,
    title,
    html,
    reverseButtons,
    confirmButtonText,
    cancelButtonText,
  });
}
export function swalError(title, html) {
  return swalBasic({ title, html, icon: 'error' });
}
export function swalWarning(title, html) {
  return swalBasic({ title, html, icon: 'warning' });
}
export function swalSuccess(title, html) {
  return swalBasic({ title, html, icon: 'success' });
}

export default Swal;