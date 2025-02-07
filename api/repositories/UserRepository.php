<?php
require_once __DIR__ . '/../interfaces/IUserRepository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository implements IUserRepository {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function findUser($user) {
    $stmt = $this->db->prepare("SELECT id, name, email FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$user]);
    return $stmt->get_result()->fetch_assoc();
  }

  public function create(User $user) {
    $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $user->getName(), $user->getEmail(), $user->getPassword());
    return $stmt->execute();
  }
}
?>