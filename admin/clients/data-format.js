function formatDate(date) {
  let [year, month, day] = date.split('-');

  return `${day}/${month}/${year}`;
}

function formatDateToDatabase(date) {
  let [day, month, year] = date.split('/');
  return `${year}-${month}-${day}`;
}

function formatCpf(cpf) {
  let value = cpf.replace(/\D/g, '');
  return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
}

function formatPhone(phone) {
  let value = phone.replace(/\D/g, '');
  return value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
}