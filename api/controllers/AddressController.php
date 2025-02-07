<?php
class AddressController {
  private $addressService;

  public function __construct(AddressService $addressService) {
    $this->addressService = $addressService;
  }

  public function handleRequest($method, $data, $id = null) {
    $data = json_decode($data);

    switch ($method) {
      case 'GET':
        if ($id) {
          echo json_encode($this->addressService->listAddressesByUser($id));
        } else {
          echo json_encode(["error" => "Usuário não especificado"]);
        }
        break;

      case 'POST':
        echo json_encode($this->addressService->createAddress($data->clientId, $data->addressName, $data->address, $data->city, $data->state, $data->zipcode));
        break;

      case 'PUT':
        echo json_encode($this->addressService->updateAddress($id, $data->clientId, $data->addressName, $data->address, $data->city, $data->state, $data->zipcode));
        break;

      case 'DELETE':
        echo json_encode($this->addressService->deleteAddress($id));
        break;

      default:
        echo json_encode(["error" => "Método não suportado"]);
    }
  }
}
?>