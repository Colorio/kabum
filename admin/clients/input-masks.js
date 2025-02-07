
function applyDateMask(event) {
  let x = event.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,2})(\d{0,4})/);
  event.target.value = !x[2] ? x[1] : x[1] + '/' + x[2] + (x[3] ? '/' + x[3] : '');
  event.target.value = event.target.value.replace(/[^0-9\/]/g, '');
}

function applyCpfMask(event) {
  let x = event.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
  x = event.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
  event.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' : '') + x[3] + (x[4] ? '-' + x[4] : '');
  event.target.value.replace(/[^0-9]/g, '');
}

function applyPhoneMask(event) {
  let x = event.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
  event.target.value = !x[2] ? x[1] : `(${x[1]}) ${x[2]}-${x[3] || ''}`;
  event.target.value = event.target.value.replace(/[^0-9() \-]/g, '');
}

function applyZipcodeMask(event) {
  let x = event.target.value.replace(/\D/g, '').match(/(\d{0,5})(\d{0,3})/);
  event.target.value = !x[2] ? x[1] : `${x[1]}-${x[2]}`;
  event.target.value = event.target.value.replace(/[^0-9\-]/g, '');
}

document.getElementById("birthday").addEventListener("input", applyDateMask);
document.getElementById("cpf").addEventListener("input", applyCpfMask);
document.getElementById("phone").addEventListener("input", applyPhoneMask);
