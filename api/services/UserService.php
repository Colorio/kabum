<?php
class UserService {
  private $userRepository;

  public function __construct(IUserRepository $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function findUser($user, $password) {
    return $this->userRepository->findUser($user, $password);
  }

  public function createUser($name, $email, $password) {
    if (empty($name) || empty($email) || empty($password)) {
      return ["error" => "Nome, Email e Senha são obrigatórios"];
    }

    $password = password_hash($password, PASSWORD_BCRYPT);
    $user = new User(null, $name, $email, $password);

    return $this->userRepository->create($user)
      ? ["message" => "Usuário criado com sucesso!"]
      : ["error" => "Erro ao criar usuário"];
  }
}
?>