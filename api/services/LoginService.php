<?php
class LoginService {
  private $loginRepository;
  private $userRepository;

  public function __construct(ILoginRepository $loginRepository, IUserRepository $userRepository) {
    $this->loginRepository = $loginRepository;
    $this->userRepository = $userRepository;
  }

  public function signIn($user, $password) {
    if (empty($user) || empty($password)) {
      return ["error" => "Usuário e Senha são obrigatórios"];
    }

    $isValidUser = $this->loginRepository->validateLogin($user, $password);

    if (!$isValidUser) {
      return ["error" => "Usuário ou senha inválido"];
    }

    session_start();

    $_SESSION['user'] = $this->userRepository->findUser($user);
    $_SESSION['logged'] = true;

    return ["message" => "Login efetuado com sucesso!"];
  }
}
?>