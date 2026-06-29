<?php
/**
 * AuthController - Login, Registro e Logout
 */

class AuthController {

    public function login(): void {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Preencha e-mail e senha.';
            } else {
                $user = $this->authenticate($email, $password);
                if ($user) {
                    Auth::login($user);
                    $redirect = $_SESSION['redirect_after_login'] ?? '/minha-conta';
                    unset($_SESSION['redirect_after_login']);
                    header('Location: ' . $redirect);
                    exit;
                } else {
                    $error = 'E-mail ou senha incorretos.';
                }
            }
        }

        $this->render('login', [
            'pageTitle' => 'Entrar - Farmácia Super Popular',
            'error' => $error
        ]);
    }

    public function register(): void {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $cpf = trim($_POST['cpf'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($cpf) || empty($password)) {
                $error = 'Preencha todos os campos obrigatórios.';
            } elseif (strlen($password) < 6) {
                $error = 'A senha deve ter no mínimo 6 caracteres.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'E-mail inválido.';
            } else {
                $user = $this->createUser($name, $email, $cpf, $password);
                if ($user) {
                    Auth::login($user);
                    header('Location: /minha-conta');
                    exit;
                } else {
                    $error = 'Este e-mail já está cadastrado.';
                }
            }
        }

        $this->render('register', [
            'pageTitle' => 'Cadastro - Farmácia Super Popular',
            'error' => $error
        ]);
    }

    public function logout(): void {
        Auth::logout();
        header('Location: /');
        exit;
    }

    public function account(): void {
        Auth::requireAuth();
        $user = Auth::user();
        $this->render('account', [
            'pageTitle' => 'Minha Conta - Farmácia Super Popular',
            'user' => $user
        ]);
    }

    public function favorites(): void {
        Auth::requireAuth();
        $this->render('favorites', [
            'pageTitle' => 'Favoritos - Farmácia Super Popular'
        ]);
    }

    private function authenticate(string $email, string $password): ?array {
        // Mock: em produção, usar Customer::authenticate()
        $mockUsers = $_SESSION['__mock_users'] ?? [];
        foreach ($mockUsers as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                return [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'cpf' => $user['cpf'],
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&background=1a6b4e&color=fff'
                ];
            }
        }

        // Demo user para teste
        if ($email === 'demo@farmaciasuperpopular.com' && $password === 'demo123') {
            return [
                'id' => 1,
                'name' => 'Maria Silva',
                'email' => 'demo@farmaciasuperpopular.com',
                'cpf' => '123.456.789-00',
                'avatar' => 'https://ui-avatars.com/api/?name=Maria+Silva&background=1a6b4e&color=fff'
            ];
        }
        return null;
    }

    private function createUser(string $name, string $email, string $cpf, string $password): ?array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $mockUsers = $_SESSION['__mock_users'] ?? [];

        // Verifica se e-mail já existe
        foreach ($mockUsers as $u) {
            if ($u['email'] === $email) {
                return null;
            }
        }
        if ($email === 'demo@farmaciasuperpopular.com') {
            return null;
        }

        $id = count($mockUsers) + 2;
        $user = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'cpf' => $cpf,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $mockUsers[] = $user;
        $_SESSION['__mock_users'] = $mockUsers;

        return [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'cpf' => $cpf,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=1a6b4e&color=fff'
        ];
    }

    private function render(string $view, array $data = []): void {
        extract($data);
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        if (!file_exists($viewFile)) {
            http_response_code(500);
            echo '<h1>View não encontrada</h1>';
            return;
        }
        require $viewFile;
    }
}
