<?php

class Client {
  private $id;
  private $name;
  private $birthday;
  private $cpf;
  private $rg;
  private $phone;

  public function __construct($id = null, $name, $birthday, $cpf, $rg, $phone) {
    $this->id = $id;
    $this->name = $name;
    $this->birthday = $birthday;
    $this->cpf = $cpf;
    $this->rg = $rg;
    $this->phone = $phone;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getBirthday() {
    return $this->birthday;
  }

  public function getCpf() {
    return $this->cpf;
  }

  public function getRg() {
    return $this->rg;
  }

  public function getPhone() {
    return $this->phone;
  }
}

?>