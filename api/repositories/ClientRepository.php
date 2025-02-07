<?php
require_once __DIR__ . '/../interfaces/IClientRepository.php';
require_once __DIR__ . '/../models/Client.php';

class ClientRepository implements IClientRepository {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getAll() {
    $stmt = $this->db->prepare("SELECT * FROM clients WHERE deleted_at IS NULL");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function create(Client $client) {
    try {
      $stmt = $this->db->prepare("INSERT INTO clients (name, birthday, cpf, rg, phone) VALUES (?, ?, ?, ?, ?)");

      $stmt->bind_param(
        "sssss",
        $client->getName(),
        $client->getBirthday(),
        $client->getCpf(),
        $client->getRg(),
        $client->getPhone()
      );

      return $stmt->execute();

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function update(Client $client) {
    try {
      $stmt = $this->db->prepare("UPDATE
          clients
        SET
          name = ?,
          birthday = ?,
          cpf = ?,
          rg = ?,
          phone = ?,
          updated_at = now()
        WHERE
          id = ?"
      );

      $stmt->bind_param(
        "sssssi",
        $client->getName(),
        $client->getBirthday(),
        $client->getCpf(),
        $client->getRg(),
        $client->getPhone(),
        $client->getId(),
      );

      return $stmt->execute();

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function delete($id) {
    try {
      $stmt = $this->db->prepare("UPDATE clients SET deleted_at = now() WHERE id = ?");
      $stmt->bind_param("i", $id);
      return $stmt->execute();

    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
?>