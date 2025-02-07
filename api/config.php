<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'kabum';

$db = new mysqli($host, $user, $password, $dbname);

if ($db->connect_error) {
  die(json_encode(["error" => "Conexão falhou: " . $db->connect_error]));
}
?>