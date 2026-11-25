<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Disciplina;
use App\Validators\UserValidator;

require_once __DIR__ . '/../Models/Disciplina.php';

class UserController
{
    public function index(): void
    {
        $this->render('users/index', [
            'title' => 'Usuários',
            'users' => User::all(),
            'disciplinas' => Disciplina::all(),
        ]);
    }

    public function show(string $id = ''): void
    {
        $user = User::find((int) $id);

        if (!$user) {
            http_response_code(404);
            exit('Usuário não encontrado');
        }

        $this->render('users/index', [
            'title' => 'Usuário',
            'users' => [$user],
            'disciplinas' => Disciplina::all(),
        ]);
    }

    public function create(): void
    {
        $this->render('users/form', [
            'title' => 'Novo usuário',
            'errors' => [],
            'old' => [],
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método não permitido');
        }

        $this->checkCsrf();

        $input = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'password' => $_POST['password'] ?? '',
        ];

        $errors = (new UserValidator())->validate($input);

        if (!$errors && User::emailExists($input['email'])) {
            $errors['email'] = 'Este e-mail já está cadastrado.';
        }

        if ($errors) {
            http_response_code(422);
            $old = $input;
            unset($old['password']);
            $this->render('users/form', [
                'title' => 'Novo usuário',
                'errors' => $errors,
                'old' => $old,
                'csrf' => $this->csrfToken(),
            ]);
            return;
        }

        $id = User::create($input['name'], $input['email'], $input['phone'], $input['password']);
        session_regenerate_id(true);
        $_SESSION['user_id'] = $id;
        header('Location: ' . url('user/perfil'));
        exit;
    }

    public function login(): void
    {
        if (!empty($_SESSION['user_id'])) {
            header('Location: ' . url('user/perfil'));
            exit;
        }

        $this->render('users/login', [
            'title' => 'Entrar',
            'errors' => [],
            'old' => [],
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function authenticate(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $email = trim($_POST['email'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        $user = $email !== '' ? User::findByEmail($email) : null;

        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(422);
            $this->render('users/login', [
                'title' => 'Entrar',
                'errors' => ['login' => 'E-mail ou senha incorretos.'],
                'old' => ['email' => $email],
                'csrf' => $this->csrfToken(),
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        header('Location: ' . url('user/perfil'));
        exit;
    }

    public function logout(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        unset($_SESSION['user_id']);
        session_regenerate_id(true);
        header('Location: ' . url('home/index'));
        exit;
    }

    public function perfil(): void
    {
        $this->render('users/perfil', [
            'title' => 'Meu perfil',
            'user' => $this->requireLogin(),
        ]);
    }

    public function plano(): void
    {
        $this->requireLogin();

        // Ainda não existe tabela de progresso: "feitos" fica em 0 até registrar o que foi estudado.
        $itens = array_map(static fn (array $d): array => [
            'nome' => $d['nome'],
            'url' => url('disciplina/conteudo/' . $d['slug'] . '/' . $d['conteudos'][0]['slug']),
            'feitos' => 0,
            'total' => count($d['conteudos']),
        ], array_values(Disciplina::all()));

        $this->render('users/plano', [
            'title' => 'Plano de estudos',
            'itens' => $itens,
        ]);
    }

    private function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método não permitido');
        }
    }

    /** Devolve o usuário logado ou manda para o login. */
    private function requireLogin(): array
    {
        $id = (int) ($_SESSION['user_id'] ?? 0);
        $user = $id > 0 ? User::find($id) : null;

        if (!$user) {
            unset($_SESSION['user_id']);
            header('Location: ' . url('user/login'));
            exit;
        }

        return $user;
    }

    private function csrfToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    private function checkCsrf(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('Token inválido');
        }
    }

    private function render(string $view, array $data = []): void
    {
        $base = __DIR__ . '/../Views/';

        $renderFile = static function (string $__file, array $__data): string {
            extract($__data, EXTR_SKIP);
            ob_start();
            require $__file;
            return ob_get_clean();
        };

        $content = $renderFile($base . $view . '.php', $data);
        $vars = $data + ['content' => $content];

        echo $renderFile($base . 'layouts/main.php', $vars);
    }
}
