<?php

function validateCpf(string $cpf) {
  $cpf = preg_replace('/\D/', '', $cpf);

  if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
    return false;
  }

  for ($i = 9; $i < 11; $i++) {
    $sum = 0;
    for ($j = 0; $j < $i; $j++) {
      $sum += $cpf[$j] * (($i + 1) - $j);
    }
    $digit = ($sum * 10) % 11;
    if ($digit == 10) {
      $digit = 0;
    }
    if ($cpf[$i] != $digit) {
      return false;
    }
  }

  return true;
}



function validateRg(string $rg) {
  $rg = strtoupper(preg_replace('/[^0-9X]/', '', $rg));

  if (strlen($rg) < 7 || strlen($rg) > 12) {
    return false;
  }

  return true;
}


function validateAndConvertDate($userDate) {
  $date = DateTime::createFromFormat('d/m/Y', $userDate);

  if ($date && $date->format('d/m/Y') === $userDate) {
    return $date->format('Y-m-d');
  } else {
    return false;
  }
}
