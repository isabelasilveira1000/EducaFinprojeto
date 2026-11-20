<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Disciplinas e conteúdos do site.
 * Para adicionar um conteúdo, inclua uma linha em 'conteudos' da disciplina.
 */
class Disciplina
{
    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        $out = [];
        foreach (self::dados() as $slug => $d) {
            $out[$slug] = ['slug' => $slug] + $d;
        }
        return $out;
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        return self::all()[$slug] ?? null;
    }

    private static function dados(): array
    {
        return [
            'educacao-fiscal' => [
                'nome' => 'Educação Fiscal',
                'descricao' => 'Cidadania, função social dos tributos e controle dos gastos públicos.',
                'bg' => '#dcebe9', 'fg' => '#1b7473',
                'icone' => '<path d="M3 21h18M5 21V10m4 11V10m6 11V10m4 11V10M3 10l9-6 9 6z"/>',
                'conteudos' => [
                    ['titulo' => 'O que é Educação Fiscal', 'resumo' => 'Entenda por que conhecer os tributos e acompanhar o uso do dinheiro público é um exercício de cidadania.', 'tempo' => '4 min', 'nivel' => 'Básico'],
                ],
            ],
            'impostos-e-tributos' => [
                'nome' => 'Impostos e Tributos',
                'descricao' => 'Como funcionam os tributos no Brasil e quem paga cada um.',
                'bg' => '#f6e3dd', 'fg' => '#c0472b',
                'icone' => '<path d="M5 3h14v18l-3-2-2 2-2-2-2 2-2-2-3 2z"/><path d="M14.5 8.5c-.5-.7-1.4-1-2.5-1-1.4 0-2.3.7-2.3 1.6 0 2.2 5 1 5 3.2 0 1-1 1.7-2.6 1.7-1.2 0-2.1-.4-2.6-1.2M12 6v1.5m0 7V16"/>',
                'conteudos' => [
                    ['titulo' => 'Tributos: impostos, taxas e contribuições', 'resumo' => 'Veja a diferença entre impostos, taxas e contribuições e quem paga cada um.', 'tempo' => '5 min', 'nivel' => 'Básico'],
                ],
            ],
            'orcamento-pessoal' => [
                'nome' => 'Orçamento Pessoal',
                'descricao' => 'Planejamento, controle de gastos e reserva de emergência.',
                'bg' => '#e1ece4', 'fg' => '#1f7a4a',
                'icone' => '<path d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0 0 4h14a1 1 0 0 1 1 1v3m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5"/><path d="M20 11h-3a2 2 0 0 0 0 4h3z"/>',
                'conteudos' => [
                    ['titulo' => 'Como montar um orçamento pessoal', 'resumo' => 'Aprenda a listar ganhos e gastos e a separar uma parte todo mês.', 'tempo' => '5 min', 'nivel' => 'Básico'],
                ],
            ],
            'investimentos' => [
                'nome' => 'Investimentos',
                'descricao' => 'Juros compostos, renda fixa e primeiros passos para investir.',
                'bg' => '#e3e8f2', 'fg' => '#2a5fa5',
                'icone' => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
                'conteudos' => [
                    ['titulo' => 'Juros compostos', 'resumo' => 'Entenda por que os juros sobre juros fazem o dinheiro crescer mais com o passar do tempo.', 'tempo' => '6 min', 'nivel' => 'Intermediário'],
                ],
            ],
            'credito-e-dividas' => [
                'nome' => 'Crédito e Dívidas',
                'descricao' => 'Cartão, empréstimos, juros e como sair do vermelho.',
                'bg' => '#f6e1e6', 'fg' => '#b0345a',
                'icone' => '<rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="M2 10h20"/>',
                'conteudos' => [
                    ['titulo' => 'Cartão de crédito e juros do rotativo', 'resumo' => 'Descubra como os juros do rotativo funcionam e como evitar que a dívida cresça.', 'tempo' => '5 min', 'nivel' => 'Básico'],
                ],
            ],
            'economia' => [
                'nome' => 'Economia',
                'descricao' => 'Inflação, Selic e os conceitos que movem o seu bolso.',
                'bg' => '#f4e8d4', 'fg' => '#b07a00',
                'icone' => '<path d="M3 3v18h18"/><path d="M8 17v-5m4 5V8m4 9v-3"/>',
                'conteudos' => [
                    ['titulo' => 'O que é inflação', 'resumo' => 'Entenda por que os preços sobem e como o IPCA mede essa alta.', 'tempo' => '4 min', 'nivel' => 'Básico'],
                ],
            ],
        ];
    }
}