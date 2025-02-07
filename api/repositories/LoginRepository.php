<?php
require_once __DIR__ . '/../interfaces/ILoginRepository.php';

class LoginRepository implements ILoginRepository {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function validateLogin($user, $password) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$user]);

    $findedUser = $stmt->get_result()->fetch_assoc();

    return $findedUser && password_verify($password, $findedUser['password']);
  }
}
?>