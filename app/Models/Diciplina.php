<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Disciplina;

class DisciplinaController extends BaseController
{
    // Endereço: disciplina/show/educacao-fiscal
    public function show(string $slug = ''): void
    {
        $disciplina = Disciplina::find($slug);

        if (!$disciplina) {
            http_response_code(404);
            exit('Disciplina não encontrada');
        }

        $this->render('disciplinas/show', [
            'title' => $disciplina['nome'] . ' - EducaFin',
            'disciplina' => $disciplina,
            'disciplinaAtiva' => $disciplina['slug'],
        ]);
    }
}