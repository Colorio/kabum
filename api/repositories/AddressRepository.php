<?php
require_once __DIR__ . '/../interfaces/IAddressRepository.php';
require_once __DIR__ . '/../models/Address.php';

class AddressRepository implements IAddressRepository {
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  public function getByUserId($userId) {
    $stmt = $this->db->prepare("SELECT * FROM addresses WHERE client_id = ? AND deleted_at IS NULL ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function create(Address $address) {
    try {
      $stmt = $this->db->prepare(
        "INSERT INTO addresses (client_id, name, address, city, state, zipcode)
        VALUES (?, ?, ?, ?, ?, ?)"
      );

      $stmt->bind_param(
        "isssss",
        $address->getClientId(),
        $address->getName(),
        $address->getAddress(),
        $address->getCity(),
        $address->getState(),
        $address->getZipcode()
      );

      return $stmt->execute();

    } catch (\Throwable $th) {
      print_r($th); exit; //Debug gustavo
      throw $th;
    }
  }

  public function update(Address $address) {
    try {

      $stmt = $this->db->prepare(
        "UPDATE
          addresses
        SET
          name = ?,
          address = ?,
          city = ?,
          state = ?,
          zipcode = ?
        WHERE
          id = ?"
      );

      $stmt->bind_param(
        "sssssi",
        $address->getName(),
        $address->getAddress(),
        $address->getCity(),
        $address->getState(),
        $address->getZipcode(),
        $address->getId()
      );
      return $stmt->execute();

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function delete($id) {
    try {
      $stmt = $this->db->prepare("UPDATE addresses SET deleted_at = now() WHERE id = ?");
      $stmt->bind_param("i", $id);
      return $stmt->execute();

    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
?>