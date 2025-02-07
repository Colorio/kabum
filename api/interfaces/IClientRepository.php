<?php
interface IClientRepository {
  public function getAll();
  public function create(Client $user);
  public function update(Client $user);
  public function delete($id);
}
?>