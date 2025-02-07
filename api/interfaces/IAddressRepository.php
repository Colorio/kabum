<?php
interface IAddressRepository {
  public function getByUserId($userId);
  public function create(Address $address);
  public function update(Address $address);
  public function delete($id);
}
?>