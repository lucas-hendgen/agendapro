<?php declare(strict_types=1);
/**
 * Farmácia Super Popular - Router Principal
 */

require_once __DIR__ . '/../private/bootstrap.php';

require_once PRIVATE_PATH . '/controllers/PageController.php';
require_once PRIVATE_PATH . '/controllers/AuthController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$uri = trim($uri, '/');

$parts = explode('/', $uri);
$route = $parts[0] ?? '';
$slug = $parts[1] ?? '';

$authController = new AuthController();
$controller = new PageController();

switch ($route) {
    case '':
    case 'home':
        $controller->home();
        break;
    case 'medicamentos':
    case 'genericos':
    case 'vitaminas':
    case 'suplementos':
    case 'dermocosmeticos':
    case 'perfumaria':
    case 'infantil':
    case 'mamae-e-bebe':
    case 'higiene':
    case 'saude':
        $controller->category($route);
        break;
    case 'categoria':
        $controller->category($slug);
        break;
    case 'ofertas':
        $controller->offers();
        break;
    case 'busca':
        $controller->search();
        break;
    case 'produto':
        $controller->product();
        break;
    case 'carrinho':
        $controller->cart();
        break;
    case 'checkout':
        $controller->checkout();
        break;
    case 'login':
        $authController->login();
        break;
    case 'registro':
    case 'cadastro':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'minha-conta':
        $authController->account();
        break;
    case 'favoritos':
        $authController->favorites();
        break;
    case 'farmacista':
    case 'farmacista-online':
        $controller->pharmacist();
        break;
    case 'contato':
        $controller->contact();
        break;
    case 'sobre':
        $controller->about();
        break;
    case 'faq':
        $controller->faq();
        break;
    case 'blog':
        $controller->blog();
        break;
    default:
        $controller->notFound();
        break;
}
