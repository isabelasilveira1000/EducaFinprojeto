<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Disciplinas e aulas do EducaFin.
 * Para incluir uma aula, adicione um item em "conteudos" com slug,
 * conceito, exemplos e quiz.
 */
class Disciplina
{
    /** @return array<string, array<string, mixed>> */
    public static function all(): array
    {
        $out = [];
        foreach (self::dados() as $slug => $disciplina) {
            $out[$slug] = ['slug' => $slug] + $disciplina;
        }
        return $out;
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        return self::all()[$slug] ?? null;
    }

    /** @return array{disciplina: array<string, mixed>, conteudo: array<string, mixed>}|null */
    public static function findConteudo(string $disciplinaSlug, string $conteudoSlug): ?array
    {
        $disciplina = self::find($disciplinaSlug);

        if ($disciplina === null) {
            return null;
        }

        foreach ($disciplina['conteudos'] as $conteudo) {
            if (($conteudo['slug'] ?? '') === $conteudoSlug) {
                return [
                    'disciplina' => $disciplina,
                    'conteudo' => $conteudo,
                ];
            }
        }

        return null;
    }

    private static function dados(): array
    {
        return [
            'educacao-fiscal' => [
                'nome' => 'Educação Fiscal',
                'descricao' => 'Cidadania, função social dos tributos e controle dos gastos públicos.',
                'bg' => '#dcebe9',
                'fg' => '#1b7473',
                'icone' => '<path d="M3 21h18M5 21V10m4 11V10m6 11V10m4 11V10M3 10l9-6 9 6z"/>',
                'conteudos' => [
                    [
                        'slug' => 'o-que-e-educacao-fiscal',
                        'titulo' => 'O que é Educação Fiscal',
                        'resumo' => 'Entenda por que conhecer os tributos e acompanhar o uso do dinheiro público é um exercício de cidadania.',
                        'tempo' => '4 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Educação Fiscal é o processo de aprendizagem que ajuda as pessoas a compreenderem como os tributos são arrecadados, por que são cobrados e como os recursos públicos devem ser utilizados. Ela aproxima a arrecadação, o orçamento e a prestação de serviços da vida cotidiana. Também incentiva a participação social e o acompanhamento das decisões do poder público.',
                        'exemplos' => [
                            'Pedir a nota fiscal em uma compra ajuda a registrar a operação e fortalece a transparência das relações de consumo.',
                            'Consultar informações sobre o orçamento municipal permite acompanhar quanto foi planejado para áreas como saúde, educação e transporte.',
                            'Participar de uma audiência pública é uma forma de contribuir com decisões sobre prioridades e gastos da comunidade.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'Qual atitude está relacionada à cidadania fiscal?',
                                'opcoes' => [
                                    'Acompanhar como os recursos públicos são aplicados.',
                                    'Ignorar as informações sobre o orçamento público.',
                                    'Evitar pedir nota fiscal em qualquer compra.',
                                    'Considerar que os tributos não têm relação com os serviços públicos.',
                                ],
                                'resposta' => 0,
                                'explicacao' => 'A cidadania fiscal envolve conhecer a arrecadação e acompanhar a aplicação dos recursos públicos.',
                            ],
                            [
                                'pergunta' => 'Qual é uma das funções da nota fiscal?',
                                'opcoes' => [
                                    'Substituir o orçamento do município.',
                                    'Registrar a operação de compra ou prestação de serviço.',
                                    'Garantir que o produto nunca tenha defeitos.',
                                    'Definir os salários dos servidores públicos.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'A nota fiscal documenta a operação e contribui para o registro e a transparência das transações.',
                            ],
                            [
                                'pergunta' => 'Quem pode acompanhar e fiscalizar a aplicação do dinheiro público?',
                                'opcoes' => [
                                    'Somente empresas privadas.',
                                    'Apenas os responsáveis pela arrecadação.',
                                    'A sociedade, além dos órgãos de controle.',
                                    'Ninguém, pois o orçamento é sigiloso por definição.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'O controle social permite que a população acompanhe ações e gastos, junto aos órgãos oficiais de controle.',
                            ],
                        ],
                    ],
                ],
            ],
            'impostos-e-tributos' => [
                'nome' => 'Impostos e Tributos',
                'descricao' => 'Como funcionam os tributos no Brasil e quem paga cada um.',
                'bg' => '#f6e3dd',
                'fg' => '#c0472b',
                'icone' => '<path d="M5 3h14v18l-3-2-2 2-2-2-2 2-2-2-3 2z"/><path d="M14.5 8.5c-.5-.7-1.4-1-2.5-1-1.4 0-2.3.7-2.3 1.6 0 2.2 5 1 5 3.2 0 1-1 1.7-2.6 1.7-1.2 0-2.1-.4-2.6-1.2M12 6v1.5m0 7V16"/>',
                'conteudos' => [
                    [
                        'slug' => 'tributos-impostos-taxas-contribuicoes',
                        'titulo' => 'Tributos: impostos, taxas e contribuições',
                        'resumo' => 'Veja a diferença entre impostos, taxas e contribuições e quem paga cada um.',
                        'tempo' => '5 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Tributo é um valor obrigatório cobrado pelo poder público, conforme regras previstas em lei. No Brasil, existem diferentes espécies de tributos. O imposto não depende de um serviço específico prestado diretamente a quem paga. A taxa está relacionada ao exercício do poder de polícia ou a um serviço público específico e divisível. Já as contribuições têm finalidades determinadas pela Constituição e pela legislação.',
                        'exemplos' => [
                            'IPTU: é um imposto municipal relacionado à propriedade de imóvel urbano. Seu pagamento não representa a compra de um serviço específico para aquele contribuinte.',
                            'Taxa de coleta de resíduos: pode ser cobrada quando vinculada a um serviço público específico e divisível, conforme as regras legais aplicáveis.',
                            'Contribuição previdenciária: é uma contribuição destinada ao financiamento da seguridade social, de acordo com as regras previstas em lei.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'Qual característica diferencia o imposto de uma taxa?',
                                'opcoes' => [
                                    'O imposto é sempre voluntário.',
                                    'O imposto não exige uma contraprestação estatal específica e direta ao contribuinte.',
                                    'O imposto só pode ser cobrado por municípios.',
                                    'O imposto é cobrado apenas quando há um serviço individualizado.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'O imposto não está vinculado a um serviço público específico prestado diretamente ao contribuinte. A taxa possui vínculo com serviço específico e divisível ou com o poder de polícia.',
                            ],
                            [
                                'pergunta' => 'Em qual situação uma taxa pode ser cobrada?',
                                'opcoes' => [
                                    'Para financiar qualquer gasto sem vínculo definido.',
                                    'Somente sobre a renda das pessoas.',
                                    'Em razão de serviço público específico e divisível ou do exercício do poder de polícia.',
                                    'Como pagamento por um produto vendido por uma loja.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'A taxa está ligada ao exercício do poder de polícia ou à utilização, efetiva ou potencial, de serviço público específico e divisível, nos termos legais.',
                            ],
                            [
                                'pergunta' => 'A contribuição previdenciária é um exemplo de:',
                                'opcoes' => [
                                    'Contribuição destinada ao financiamento da seguridade social.',
                                    'Imposto municipal sobre imóveis urbanos.',
                                    'Taxa cobrada pela emissão de um documento.',
                                    'Preço pago pela compra de um produto.',
                                ],
                                'resposta' => 0,
                                'explicacao' => 'A contribuição previdenciária integra as contribuições sociais destinadas ao financiamento da seguridade social.',
                            ],
                        ],
                    ],
                ],
            ],
            'orcamento-pessoal' => [
                'nome' => 'Orçamento Pessoal',
                'descricao' => 'Planejamento, controle de gastos e reserva de emergência.',
                'bg' => '#e1ece4',
                'fg' => '#1f7a4a',
                'icone' => '<path d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0 0 4h14a1 1 0 0 1 1 1v3m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5"/><path d="M20 11h-3a2 2 0 0 0 0 4h3z"/>',
                'conteudos' => [
                    [
                        'slug' => 'como-montar-orcamento-pessoal',
                        'titulo' => 'Como montar um orçamento pessoal',
                        'resumo' => 'Aprenda a listar ganhos e gastos e a separar uma parte todo mês.',
                        'tempo' => '5 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Orçamento pessoal é uma ferramenta de planejamento que organiza o dinheiro que entra e o dinheiro que sai em determinado período. Ao registrar receitas e despesas, fica mais fácil perceber para onde o dinheiro está indo, identificar prioridades, evitar gastos acima da renda e planejar objetivos. O orçamento deve ser revisado com frequência, porque os valores e as necessidades podem mudar.',
                        'exemplos' => [
                            'Uma pessoa que recebe R$ 1.800 por mês registra despesas com transporte, alimentação, contas e lazer antes de decidir quanto pode guardar.',
                            'Ao perceber que gasta muito com compras por impulso, alguém define um limite mensal para essa categoria e acompanha os resultados.',
                            'Uma família separa uma quantia possível todos os meses para formar uma reserva destinada a imprevistos.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'Qual é o primeiro passo para organizar um orçamento pessoal?',
                                'opcoes' => [
                                    'Registrar as receitas e as despesas.',
                                    'Fazer uma compra parcelada.',
                                    'Ignorar os gastos pequenos.',
                                    'Usar todo o dinheiro antes do fim do mês.',
                                ],
                                'resposta' => 0,
                                'explicacao' => 'Conhecer as entradas e saídas de dinheiro permite entender a situação financeira e planejar os próximos passos.',
                            ],
                            [
                                'pergunta' => 'Quando as despesas são maiores que as receitas, o orçamento apresenta:',
                                'opcoes' => [
                                    'Superávit.',
                                    'Equilíbrio.',
                                    'Déficit.',
                                    'Rendimento automático.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'Há déficit quando o total gasto supera o total recebido no período.',
                            ],
                            [
                                'pergunta' => 'Para que serve uma reserva de emergência?',
                                'opcoes' => [
                                    'Para aumentar os gastos fixos.',
                                    'Para cobrir despesas inesperadas e urgentes.',
                                    'Para substituir toda a renda mensal.',
                                    'Para eliminar a necessidade de planejamento.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'A reserva ajuda a lidar com imprevistos sem depender imediatamente de empréstimos ou de outras dívidas.',
                            ],
                        ],
                    ],
                ],
            ],
            'investimentos' => [
                'nome' => 'Investimentos',
                'descricao' => 'Juros compostos, renda fixa e primeiros passos para investir.',
                'bg' => '#e3e8f2',
                'fg' => '#2a5fa5',
                'icone' => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
                'conteudos' => [
                    [
                        'slug' => 'juros-compostos',
                        'titulo' => 'Juros compostos',
                        'resumo' => 'Entenda por que os juros sobre juros fazem o dinheiro crescer mais com o passar do tempo.',
                        'tempo' => '6 min',
                        'nivel' => 'Intermediário',
                        'conceito' => 'Juros compostos são calculados sobre o valor inicial acrescido dos juros acumulados nos períodos anteriores. Por isso, são conhecidos como juros sobre juros. O resultado depende do capital inicial, da taxa e do tempo. Esse mecanismo pode aumentar o saldo de um investimento, mas também pode fazer uma dívida crescer quando os juros incidem sobre valores já acrescidos.',
                        'exemplos' => [
                            'Um valor de R$ 1.000 aplicado a uma taxa hipotética de 10% por período passa a R$ 1.100 após o primeiro período.',
                            'No segundo período, os 10% incidem sobre R$ 1.100. O saldo passa a R$ 1.210, antes de impostos ou tarifas.',
                            'Em uma dívida, a incidência de juros compostos pode elevar o valor devido ao longo do tempo, especialmente quando não há pagamentos suficientes.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'Nos juros compostos, os juros de cada período são calculados sobre:',
                                'opcoes' => [
                                    'Apenas o valor dos juros do primeiro período.',
                                    'O capital inicial mais os juros acumulados.',
                                    'Somente os depósitos feitos no último dia.',
                                    'Um valor que nunca muda.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'A cada período, os juros são incorporados ao saldo e passam a compor a base de cálculo seguinte.',
                            ],
                            [
                                'pergunta' => 'Um investimento hipotético de R$ 1.000 rende 10% por período, com juros compostos. Qual será o saldo após dois períodos, sem taxas ou impostos?',
                                'opcoes' => [
                                    'R$ 1.100,00.',
                                    'R$ 1.200,00.',
                                    'R$ 1.210,00.',
                                    'R$ 1.220,00.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'Após o primeiro período: R$ 1.100. No segundo: R$ 1.100 × 1,10 = R$ 1.210.',
                            ],
                            [
                                'pergunta' => 'Antes de escolher um investimento, é importante avaliar:',
                                'opcoes' => [
                                    'Somente o nome da instituição.',
                                    'Apenas a possibilidade de ganhar muito em pouco tempo.',
                                    'Risco, liquidez, prazo e custos envolvidos.',
                                    'A opinião de uma única pessoa, sem pesquisar.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'Risco, liquidez, prazo e custos ajudam a avaliar se o investimento combina com o objetivo e a situação de quem investe.',
                            ],
                        ],
                    ],
                ],
            ],
            'credito-e-dividas' => [
                'nome' => 'Crédito e Dívidas',
                'descricao' => 'Cartão, empréstimos, juros e como sair do vermelho.',
                'bg' => '#f6e1e6',
                'fg' => '#b0345a',
                'icone' => '<rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="M2 10h20"/>',
                'conteudos' => [
                    [
                        'slug' => 'cartao-de-credito-e-rotativo',
                        'titulo' => 'Cartão de crédito e juros do rotativo',
                        'resumo' => 'Descubra como os juros do rotativo funcionam e como evitar que a dívida cresça.',
                        'tempo' => '5 min',
                        'nivel' => 'Básico',
                        'conceito' => 'O cartão de crédito permite realizar compras para pagamento em uma data futura. Quando a fatura não é paga integralmente, o valor que fica em aberto pode entrar em uma modalidade de financiamento, como o crédito rotativo, conforme as regras do produto. Como há cobrança de encargos, pagar apenas parte da fatura pode tornar a dívida mais cara. É importante conferir as condições, o custo efetivo total e as alternativas de parcelamento oferecidas.',
                        'exemplos' => [
                            'Uma fatura de R$ 500 é paga parcialmente. O saldo que ficou em aberto pode gerar juros e outros encargos até ser quitado.',
                            'Antes de contratar um parcelamento, a pessoa compara o valor total a pagar, as taxas e o número de parcelas.',
                            'Para evitar novas dívidas, alguém acompanha as compras durante o mês e verifica se o total cabe no orçamento.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'Quando o crédito rotativo pode ser utilizado?',
                                'opcoes' => [
                                    'Quando a fatura é paga integralmente até o vencimento.',
                                    'Quando parte do valor da fatura não é paga e fica financiada.',
                                    'Sempre que o cartão é usado para uma compra à vista.',
                                    'Quando a pessoa cancela o cartão antes do vencimento.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'O rotativo pode incidir sobre o saldo da fatura que não foi pago, conforme as condições do contrato e as regras vigentes.',
                            ],
                            [
                                'pergunta' => 'O que deve ser comparado antes de aceitar um parcelamento da fatura?',
                                'opcoes' => [
                                    'Somente o valor da primeira parcela.',
                                    'A cor do cartão e o limite disponível.',
                                    'O custo total, os encargos e a quantidade de parcelas.',
                                    'Apenas a data em que o cartão foi emitido.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'O custo total mostra quanto será pago ao final, considerando parcelas e encargos, e permite comparar alternativas.',
                            ],
                            [
                                'pergunta' => 'Qual hábito ajuda a evitar o crescimento de dívidas no cartão?',
                                'opcoes' => [
                                    'Acompanhar as compras e planejar o pagamento da fatura.',
                                    'Ignorar as compras parceladas.',
                                    'Usar o limite como se fosse renda extra.',
                                    'Pagar somente o mínimo todos os meses sem analisar custos.',
                                ],
                                'resposta' => 0,
                                'explicacao' => 'Acompanhar os gastos e planejar o pagamento integral da fatura, quando possível, reduz o risco de acumular encargos.',
                            ],
                        ],
                    ],
                ],
            ],
            'economia' => [
                'nome' => 'Economia',
                'descricao' => 'Inflação, Selic e os conceitos que movem o seu bolso.',
                'bg' => '#f4e8d4',
                'fg' => '#b07a00',
                'icone' => '<path d="M3 3v18h18"/><path d="M8 17v-5m4 5V8m4 9v-3"/>',
                'conteudos' => [
                    [
                        'slug' => 'o-que-e-inflacao',
                        'titulo' => 'O que é inflação',
                        'resumo' => 'Entenda por que os preços sobem e como o IPCA mede essa alta.',
                        'tempo' => '4 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Inflação é o aumento generalizado dos preços de bens e serviços ao longo do tempo. Quando os preços sobem, a mesma quantia de dinheiro tende a comprar uma quantidade menor de produtos e serviços, ou seja, o poder de compra diminui. No Brasil, o IPCA, calculado pelo IBGE, é o índice oficial usado como referência para a inflação ao consumidor.',
                        'exemplos' => [
                            'Se uma cesta de compras custava R$ 100 e passa a custar R$ 105, houve uma alta de 5% no preço dessa cesta.',
                            'Quando transporte, alimentação e moradia ficam mais caros, uma família pode precisar reorganizar o orçamento para manter as mesmas despesas.',
                            'Se a renda permanece igual enquanto os preços aumentam, o dinheiro disponível compra menos do que antes.',
                        ],
                        'quiz' => [
                            [
                                'pergunta' => 'O que caracteriza a inflação?',
                                'opcoes' => [
                                    'A queda contínua de todos os preços.',
                                    'O aumento generalizado dos preços ao longo do tempo.',
                                    'O aumento do salário de uma única pessoa.',
                                    'A redução da quantidade de dinheiro em uma carteira.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'A inflação representa o aumento generalizado dos preços de bens e serviços durante determinado período.',
                            ],
                            [
                                'pergunta' => 'Quando os preços aumentam e a renda não acompanha essa alta, o que tende a acontecer com o poder de compra?',
                                'opcoes' => [
                                    'Aumenta automaticamente.',
                                    'Permanece sempre igual.',
                                    'Diminui.',
                                    'Deixa de existir qualquer relação com a renda.',
                                ],
                                'resposta' => 2,
                                'explicacao' => 'Com a mesma renda, preços mais altos permitem comprar menos bens e serviços, reduzindo o poder de compra.',
                            ],
                            [
                                'pergunta' => 'Qual instituição calcula o IPCA no Brasil?',
                                'opcoes' => [
                                    'Banco Central do Brasil.',
                                    'Instituto Brasileiro de Geografia e Estatística (IBGE).',
                                    'Receita Federal.',
                                    'Tesouro Nacional.',
                                ],
                                'resposta' => 1,
                                'explicacao' => 'O IBGE calcula o IPCA, índice oficial de referência da inflação ao consumidor no Brasil.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
