<?php
interface ILoginRepository {
  public function validateLogin($user, $password);
}
?>