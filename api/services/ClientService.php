<?php
require_once "./utils.php";

class ClientService {
  private $clientRepository;

  public function __construct(IClientRepository $clientRepository) {
    $this->clientRepository = $clientRepository;
  }

  public function getAll() {
    return $this->clientRepository->getAll();
  }

  public function createClient($name, $birthday, $cpf, $rg, $phone) {
    $cpf = preg_replace('/\D/', '', $cpf);
    $rg = preg_replace('/[^0-9Xx]/', '', $rg);
    $phone = preg_replace('/\D/', '', $phone);

    if (empty($name) || empty($birthday) || empty($cpf) || empty($rg) || empty($phone)) {
      return ["error" => "Todos os campos são obrigatórios"];
    }
    if (!validateCpf($cpf)) {
      return ["error" => "CPF inválido"];
    }

    if (!validateRg($rg)) {
      return ["error" => "RG inválido"];
    }

    if (!validatePhoneNumber($phone)) {
      return ["error" => "Telefone inválido"];
    }

    $birthday = validateAndFormatDate($birthday);

    if (!$birthday) {
      return ["error" => "Data de nascimento inválida"];
    }

    $client = new Client(null, $name, $birthday, $cpf, $rg, $phone);

    return $this->clientRepository->create($client)
      ? ["message" => "Cliente cadastrado com sucesso!"]
      : ["error" => "Erro ao criar cliente"];
  }

  public function updateClient($id, $name, $birthday, $cpf, $rg, $phone) {
    $id = preg_replace('/\D/', '', $id);
    $cpf = preg_replace('/\D/', '', $cpf);
    $rg = preg_replace('/[^0-9Xx]/', '', $rg);
    $phone = preg_replace('/\D/', '', $phone);

    if (empty($name) || empty($birthday) || empty($cpf) || empty($rg) || empty($phone)) {
      return ["error" => "Todos os campos são obrigatórios"];
    }
    if (!validateCpf($cpf)) {
      return ["error" => "CPF inválido"];
    }

    if (!validateRg($rg)) {
      return ["error" => "RG inválido"];
    }

    if (!validatePhoneNumber($phone)) {
      return ["error" => "Telefone inválido"];
    }

    $birthday = validateAndFormatDate($birthday);

    if (!$birthday) {
      return ["error" => "Data de nascimento inválida"];
    }

    $client = new Client($id, $name, $birthday, $cpf, $rg, $phone);

    return $this->clientRepository->update($client)
      ? ["message" => "Cliente atualizado com sucesso!"]
      : ["error" => "Erro ao criar cliente"];
  }

  public function deleteClient($id) {
    return $this->clientRepository->delete($id)
      ? ["message" => "Cliente deletado com sucesso!"]
      : ["error" => "Erro ao deletar cliente"];
  }
}
?>