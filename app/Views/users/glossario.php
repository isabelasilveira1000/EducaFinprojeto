<?php

declare(strict_types=1);

namespace App\Models;

/** Termos do glossário do EducaFin. Para incluir um termo, adicione um item em dados(). */
class Glossario
{
    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        $out = [];
        foreach (self::dados() as $slug => $termo) {
            $out[$slug] = ['slug' => $slug] + $termo;
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
            'selic' => [
                'termo' => 'Selic',
                'classe' => 'substantivo feminino',
                'definicao' => 'Taxa básica de juros da economia brasileira, definida pelo Comitê de Política Monetária (Copom) do Banco Central. Serve de referência para empréstimos e investimentos.',
                'aula' => ['economia', 'o-que-e-inflacao'],
            ],
            'inflacao' => [
                'termo' => 'Inflação',
                'classe' => 'substantivo feminino',
                'definicao' => 'Aumento generalizado e contínuo dos preços de bens e serviços. Quando ela sobe, o mesmo dinheiro compra menos coisas.',
                'aula' => ['economia', 'o-que-e-inflacao'],
            ],
            'ipca' => [
                'termo' => 'IPCA',
                'classe' => 'sigla',
                'definicao' => 'Índice Nacional de Preços ao Consumidor Amplo, calculado pelo IBGE. É a medida oficial da inflação no Brasil.',
                'aula' => ['economia', 'o-que-e-inflacao'],
            ],
            'poder-de-compra' => [
                'termo' => 'Poder de compra',
                'classe' => 'expressão',
                'definicao' => 'Quantidade de bens e serviços que uma pessoa consegue comprar com certa quantia de dinheiro. Diminui quando os preços sobem mais do que a renda.',
                'aula' => ['economia', 'o-que-e-inflacao'],
            ],
            'juros-compostos' => [
                'termo' => 'Juros compostos',
                'classe' => 'expressão',
                'definicao' => 'Juros calculados sobre o valor inicial somado aos juros já acumulados nos períodos anteriores. Por isso o valor cresce cada vez mais rápido, tanto nos investimentos quanto nas dívidas.',
                'aula' => ['investimentos', 'juros-compostos'],
            ],
            'cdi' => [
                'termo' => 'CDI',
                'classe' => 'sigla',
                'definicao' => 'Certificado de Depósito Interbancário. A taxa do CDI acompanha de perto a Selic e é muito usada como referência para medir o rendimento de investimentos de renda fixa.',
                'aula' => ['investimentos', 'juros-compostos'],
            ],
            'reserva-de-emergencia' => [
                'termo' => 'Reserva de emergência',
                'classe' => 'expressão',
                'definicao' => 'Dinheiro guardado para imprevistos, como perda de renda ou despesas de saúde. O ideal é mantê-lo em aplicações seguras e de fácil resgate.',
                'aula' => ['orcamento-pessoal', 'como-montar-orcamento-pessoal'],
            ],
            'orcamento-pessoal' => [
                'termo' => 'Orçamento pessoal',
                'classe' => 'expressão',
                'definicao' => 'Planejamento das receitas (o que entra) e das despesas (o que sai) de uma pessoa ou família, para saber quanto sobra e para onde o dinheiro está indo.',
                'aula' => ['orcamento-pessoal', 'como-montar-orcamento-pessoal'],
            ],
            'rotativo-do-cartao' => [
                'termo' => 'Rotativo do cartão',
                'classe' => 'expressão',
                'definicao' => 'Crédito que é acionado automaticamente quando a fatura do cartão é paga em valor menor que o total. Costuma ter juros muito altos e deve ser evitado.',
                'aula' => ['credito-e-dividas', 'cartao-de-credito-e-rotativo'],
            ],
            'tributo' => [
                'termo' => 'Tributo',
                'classe' => 'substantivo masculino',
                'definicao' => 'Pagamento obrigatório, previsto em lei, que o Estado cobra para financiar serviços e políticas públicas. Impostos, taxas e contribuições são tipos de tributo.',
                'aula' => ['impostos-e-tributos', 'tributos-impostos-taxas-contribuicoes'],
            ],
            'imposto' => [
                'termo' => 'Imposto',
                'classe' => 'substantivo masculino',
                'definicao' => 'Tributo cobrado sem uma contrapartida direta e específica ao contribuinte. O dinheiro vai para os cofres públicos e ajuda a financiar áreas como saúde, educação e segurança.',
                'aula' => ['impostos-e-tributos', 'tributos-impostos-taxas-contribuicoes'],
            ],
            'taxa' => [
                'termo' => 'Taxa',
                'classe' => 'substantivo feminino',
                'definicao' => 'Tributo cobrado em razão de um serviço público específico, prestado ao contribuinte ou colocado à sua disposição, ou do exercício do poder de polícia.',
                'aula' => ['impostos-e-tributos', 'tributos-impostos-taxas-contribuicoes'],
            ],
            'educacao-fiscal' => [
                'termo' => 'Educação fiscal',
                'classe' => 'expressão',
                'definicao' => 'Processo de aprendizagem sobre como os tributos são arrecadados e como os recursos públicos são aplicados, incentivando a cidadania e o acompanhamento das contas públicas.',
                'aula' => ['educacao-fiscal', 'o-que-e-educacao-fiscal'],
            ],
        ];
    }
}