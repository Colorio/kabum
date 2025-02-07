<?php
interface IUserRepository {
  // public function getById($id);
  public function findUser($user);
  public function create(User $user);
}
?>