<?php
require_once 'config.php';
require_once 'interfaces/IAddressRepository.php';
require_once 'interfaces/ILoginRepository.php';
require_once 'interfaces/IUserRepository.php';
require_once 'interfaces/IClientRepository.php';

require_once 'models/Address.php';
require_once 'models/User.php';
require_once 'models/Client.php';

require_once 'repositories/AddressRepository.php';
require_once 'repositories/LoginRepository.php';
require_once 'repositories/UserRepository.php';
require_once 'repositories/ClientRepository.php';

require_once 'services/AddressService.php';
require_once 'services/LoginService.php';
require_once 'services/UserService.php';
require_once 'services/ClientService.php';

require_once 'controllers/AddressController.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ClientController.php';

$userRepository = new UserRepository($db);
$userService = new UserService($userRepository);
$userController = new UserController($userService);

$clientRepository = new ClientRepository($db);
$clientService = new ClientService($clientRepository);
$clientController = new ClientController($clientService);

$loginRepository = new LoginRepository($db);
$loginService = new LoginService($loginRepository, $userRepository);
$loginController = new LoginController($loginService);

$addressRepository = new AddressRepository($db);
$addressService = new AddressService($addressRepository);
$addressController = new AddressController($addressService);

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

parse_str(file_get_contents("php://input"), $data);

$data = json_encode($data, JSON_PRETTY_PRINT);

switch ($uri[4]) {
  case 'sign-in':
    $loginController->handleRequest($method, $data);
    break;

  case 'users':
    $userController->handleRequest($method, $data);
    break;

  case 'clients':
    $clientId = isset($uri[5]) ? (int)$uri[5] : null;
    $clientController->handleRequest($method, $data, $clientId);
    break;

  case 'addresses':
    $addressId = isset($uri[5]) ? (int)$uri[5] : null;
    $addressController->handleRequest($method, $data, $addressId);
    break;

  default:
    echo json_encode(["error" => "Rota não encontrada"]);
    break;
}
?>
