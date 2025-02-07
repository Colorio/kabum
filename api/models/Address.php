<?php

class Address {
  private $id;
  private $clientId;
  private $name;
  private $address;
  private $city;
  private $state;
  private $zipcode;

  public function __construct($id = null, $clientId, $name, $address, $city, $state, $zipcode) {
    $this->id = $id;
    $this->clientId = $clientId;
    $this->name = $name;
    $this->address = $address;
    $this->city = $city;
    $this->state = $state;
    $this->zipcode = $zipcode;
  }

  function getId() {
    return $this->id;
  }

  function getClientId() {
    return $this->clientId;
  }

  function getName() {
    return $this->name;
  }

  function getAddress() {
    return $this->address;
  }

  function getCity() {
    return $this->city;
  }

  function getState() {
    return $this->state;
  }

  function getZipcode() {
    return $this->zipcode;
  }
}

?>