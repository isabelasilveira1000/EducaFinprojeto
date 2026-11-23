<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Disciplina;

require_once __DIR__ . '/../Models/Disciplina.php';

class DisciplinaController extends BaseController
{
    // Endereço da lista de conteúdos: disciplina/show/educacao-fiscal
    public function show(string $slug = ''): void
    {
        $disciplina = Disciplina::find($slug);

        if ($disciplina === null) {
            http_response_code(404);
            exit('Disciplina não encontrada.');
        }

        $this->render('diciplinas/show', [
            'title' => $disciplina['nome'] . ' - EducaFin',
            'disciplina' => $disciplina,
            'disciplinaAtiva' => $disciplina['slug'],
        ]);
    }

    // Endereço da aula: disciplina/conteudo/{disciplina}/{conteudo}
    public function conteudo(string $slug = '', string $conteudoSlug = ''): void
    {
        $resultado = Disciplina::findConteudo($slug, $conteudoSlug);

        if ($resultado === null) {
            http_response_code(404);
            exit('Conteúdo não encontrado. Verifique o endereço e tente novamente.');
        }

        $disciplina = $resultado['disciplina'];
        $conteudo = $resultado['conteudo'];

        $this->render('diciplinas/conteudo', [
            'title' => $conteudo['titulo'] . ' - EducaFin',
            'disciplina' => $disciplina,
            'conteudo' => $conteudo,
            'disciplinaAtiva' => $disciplina['slug'],
        ]);
    }
}
