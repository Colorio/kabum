<?php
class ClientController {
  private $clientService;

  public function __construct(ClientService $clientService) {
    $this->clientService = $clientService;
  }

  public function handleRequest($method, $data, $clientId) {
    $data = json_decode($data);
    switch ($method) {
      case 'GET':
        echo json_encode($this->clientService->getAll());
        break;

      case 'POST':
        echo json_encode($this->clientService->createClient(
          $data->name,
          $data->birthday,
          $data->cpf,
          $data->rg,
          $data->phone)
        );
        break;

      case 'PUT':
        echo json_encode($this->clientService->updateClient(
          $data->id,
          $data->name,
          $data->birthday,
          $data->cpf,
          $data->rg,
          $data->phone)
        );
        break;

      case 'DELETE':
        echo json_encode($this->clientService->deleteClient($clientId));
        break;

      default:
        echo json_encode(["error" => "Método não suportado"]);
    }
  }
}
?>