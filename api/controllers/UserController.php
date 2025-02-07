<?php
class UserController {
  private $userService;

  public function __construct(UserService $userService) {
    $this->userService = $userService;
  }

  public function handleRequest($method, $data) {
    $data = json_decode($data);
    switch ($method) {
      case 'POST':
        echo json_encode($this->userService->createUser($data->name, $data->email, $data->password));
        break;

      default:
        echo json_encode(["error" => "Método não suportado"]);
    }
  }
}
?>