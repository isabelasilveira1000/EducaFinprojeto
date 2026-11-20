<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Disciplina;

require_once __DIR__ . '/../Models/Disciplina.php';

class HomeController extends BaseController
{
    public function index(): void
    {
        $this->render('users/index', [
            'title' => 'EducaFin - Educação Financeira',
            'disciplinas' => Disciplina::all(),
        ]);
    }
}
