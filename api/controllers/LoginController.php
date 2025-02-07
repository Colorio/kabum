<?php
class LoginController {
  private $loginService;

  public function __construct(LoginService $loginService) {
    $this->loginService = $loginService;
  }

  public function handleRequest($method, $data) {
    $data = json_decode($data);
    switch ($method) {
      case 'POST':
        echo json_encode($this->loginService->signIn($data->user, $data->password));
        break;

      default:
        echo json_encode(["error" => "Método não suportado"]);
    }
  }
}
?>