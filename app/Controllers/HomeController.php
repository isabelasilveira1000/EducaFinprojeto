<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Disciplina;

class HomeController extends BaseController
{
    public function index(): void
    {
        $this->render('home/index', [
            'title' => 'EducaFin - Educação Financeira',
            'disciplinas' => Disciplina::all(),
        ]);
    }
}