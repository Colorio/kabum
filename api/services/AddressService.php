<?php
class AddressService {
  private $addressRepository;

  public function __construct(IAddressRepository $addressRepository) {
    $this->addressRepository = $addressRepository;
  }

  public function listAddressesByUser($userId) {
    return $this->addressRepository->getByUserId($userId);
  }

  public function createAddress($clientId, $name, $address, $city, $state, $zipcode) {
    if (empty($name) || empty($address) || empty($city) || empty($state) || empty($zipcode)) {
      return ["error" => "Todos os campos são obrigatórios"];
    }

    $address = new Address(null, $clientId, $name, $address, $city, $state, $zipcode);
    return $this->addressRepository->create($address)
      ? ["message" => "Endereço criado com sucesso!"]
      : ["error" => "Erro ao criar endereço"];
  }

  public function updateAddress($id, $clientId, $name, $address, $city, $state, $zipcode) {
    if (empty($name) || empty($address) || empty($city) || empty($state) || empty($zipcode)) {
      return ["error" => "Todos os campos são obrigatórios"];
    }

    $address = new Address($id, $clientId, $name, $address, $city, $state, $zipcode);
    return $this->addressRepository->update($address)
      ? ["message" => "Endereço atualizado com sucesso!"]
      : ["error" => "Erro ao atualizar endereço"];
  }

  public function deleteAddress($id) {
    return $this->addressRepository->delete($id)
      ? ["message" => "Endereço deletado com sucesso!"]
      : ["error" => "Erro ao deletar endereço"];
  }
}
?>