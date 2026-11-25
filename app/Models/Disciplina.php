<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Disciplinas e aulas do EducaFin.
 * Cada aula possui conceito, exemplos e 10 questões de múltipla escolha.
 */
class Disciplina
{
    public static function all(): array
    {
        $out = [];

        foreach (self::dados() as $slug => $disciplina) {
            $out[$slug] = ['slug' => $slug] + $disciplina;
        }

        return $out;
    }

    public static function find(string $slug): ?array
    {
        return self::all()[$slug] ?? null;
    }

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

    /**
     * Mantém o formato que a página do quiz já utiliza.
     * Cada questão deve ter: pergunta, opções, índice da resposta e explicação.
     */
    private static function questoes(array $itens): array
    {
        $questoes = [];

        foreach ($itens as $item) {
            $questoes[] = [
                'pergunta' => $item[0],
                'opcoes' => $item[1],
                'resposta' => $item[2],
                'explicacao' => $item[3],
            ];
        }

        return $questoes;
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
                        'resumo' => 'Entenda a relação entre tributos, serviços públicos e participação cidadã.',
                        'tempo' => '8 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Educação Fiscal é o processo de aprendizagem que ajuda as pessoas a compreenderem como os tributos são arrecadados, por que são cobrados e como os recursos públicos devem ser utilizados. Ela mostra que o dinheiro público está relacionado à vida de toda a população, pois pode financiar serviços como escolas, hospitais, iluminação, transporte e saneamento.\n\nA Educação Fiscal também ensina que pagar tributos não é a única responsabilidade do cidadão. É importante conhecer os direitos, exigir documentos fiscais, acompanhar as decisões do governo e observar se os recursos estão sendo aplicados corretamente. Essa participação é chamada de controle social.\n\nQuando a população entende o funcionamento da arrecadação e do orçamento público, consegue participar de forma mais consciente das decisões coletivas e cobrar transparência dos governantes.',
                        'exemplos' => [
                            'Ao comprar um produto, pedir a nota fiscal ajuda a registrar a operação e permite comprovar a compra.',
                            'Quando uma pessoa consulta o portal da transparência da prefeitura, pode acompanhar informações sobre despesas e investimentos públicos.',
                            'A comunidade pode participar de reuniões e audiências públicas para discutir melhorias para o bairro, como iluminação, transporte e escolas.',
                            'Se uma rua está precisando de reparos, os moradores podem registrar a solicitação nos canais oficiais e acompanhar a resposta do poder público.',
                            'Ao conversar sobre a importância dos serviços públicos e dos tributos, estudantes também ajudam a divulgar informações sobre cidadania fiscal.',
                        ],
                        'quiz' => self::questoes([
                            ['O que é Educação Fiscal?', [
                                'Aprender apenas a calcular o salário.',
                                'Compreender a relação entre tributos, recursos públicos e cidadania.',
                                'Estudar somente como abrir uma empresa.',
                                'Aprender a evitar todos os pagamentos obrigatórios.',
                            ], 1, 'A Educação Fiscal ajuda a entender a arrecadação, o uso do dinheiro público e a participação da sociedade.'],
                            ['Qual atitude representa o exercício da cidadania fiscal?', [
                                'Ignorar como o governo utiliza os recursos.',
                                'Evitar pedir documentos fiscais.',
                                'Acompanhar a aplicação do dinheiro público.',
                                'Acreditar que o orçamento não deve ser conhecido.',
                            ], 2, 'Acompanhar os gastos públicos e cobrar transparência são formas de participação cidadã.'],
                            ['Para que serve a nota fiscal?', [
                                'Registrar uma compra ou prestação de serviço.',
                                'Definir o salário de todos os trabalhadores.',
                                'Substituir o documento de identidade.',
                                'Garantir que nenhum produto apresente defeito.',
                            ], 0, 'A nota fiscal registra a operação e contém informações importantes sobre a compra ou serviço.'],
                            ['O que é controle social?', [
                                'A proibição de a população conhecer o orçamento.',
                                'A participação da sociedade no acompanhamento das ações públicas.',
                                'O controle das compras feitas em lojas privadas.',
                                'A substituição de todos os órgãos públicos por empresas.',
                            ], 1, 'Controle social é a participação da população no acompanhamento e na fiscalização das políticas e dos gastos públicos.'],
                            ['Qual área pode receber recursos do orçamento público?', [
                                'Somente lojas particulares.',
                                'Apenas festas privadas.',
                                'Somente contas pessoais dos governantes.',
                                'Saúde, educação, transporte e saneamento.',
                            ], 3, 'O orçamento público pode financiar serviços e políticas que atendem à população.'],
                            ['O que é transparência pública?', [
                                'Disponibilizar informações sobre ações e gastos do poder público.',
                                'Manter todas as despesas escondidas.',
                                'Divulgar apenas informações sem importância.',
                                'Impedir que cidadãos façam perguntas.',
                            ], 0, 'A transparência permite que a sociedade conheça informações e acompanhe a administração pública.'],
                            ['Qual é uma forma de acompanhar os gastos de uma prefeitura?', [
                                'Consultar somente comentários sem fonte.',
                                'Acessar o portal da transparência e informações oficiais.',
                                'Esperar que outra pessoa faça tudo.',
                                'Compartilhar valores sem verificar.',
                            ], 1, 'Portais oficiais de transparência disponibilizam informações sobre receitas, despesas e contratos.'],
                            ['Por que os tributos são importantes para a sociedade?', [
                                'Porque substituem toda a renda das famílias.',
                                'Porque são usados exclusivamente em publicidade.',
                                'Porque ajudam a financiar serviços e políticas públicas.',
                                'Porque eliminam todos os problemas sociais automaticamente.',
                            ], 2, 'Os tributos compõem parte dos recursos usados para financiar serviços e ações públicas.'],
                            ['O que uma pessoa pode fazer ao perceber um problema em um serviço público?', [
                                'Registrar a solicitação em um canal oficial e acompanhar a resposta.',
                                'Destruir equipamentos públicos.',
                                'Espalhar informações sem verificar.',
                                'Deixar de participar da comunidade.',
                            ], 0, 'Utilizar canais oficiais ajuda a registrar demandas e permite acompanhar as providências.'],
                            ['A Educação Fiscal deve ser praticada por:', [
                                'Somente profissionais da contabilidade.',
                                'Apenas pessoas que trabalham no governo.',
                                'Somente empresários.',
                                'Toda a sociedade, com informação e participação.',
                            ], 3, 'A Educação Fiscal é importante para todos, pois os tributos e os serviços públicos fazem parte da vida coletiva.'],
                        ]),
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
                        'resumo' => 'Aprenda o que são tributos e entenda as diferenças entre impostos, taxas e contribuições.',
                        'tempo' => '8 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Tributos são pagamentos obrigatórios instituídos por lei e cobrados pelo poder público. Eles ajudam a financiar atividades do Estado e serviços oferecidos à população. No Brasil, a palavra tributo é uma categoria ampla que inclui impostos, taxas e contribuições, entre outras espécies previstas na legislação.\n\nO imposto não depende de um serviço específico prestado diretamente à pessoa que paga. A taxa, por sua vez, está relacionada ao exercício do poder de polícia ou a um serviço público específico e divisível, conforme as regras legais. As contribuições possuem finalidades determinadas pela Constituição e pelas leis.\n\nÉ importante lembrar que tributos não são a mesma coisa que preços de produtos ou serviços comprados em uma loja. A cobrança de cada tributo precisa ter fundamento legal e seguir as regras aplicáveis.',
                        'exemplos' => [
                            'IPTU: imposto municipal relacionado à propriedade de imóvel urbano.',
                            'IPVA: imposto estadual relacionado à propriedade de veículos automotores.',
                            'ICMS: imposto estadual que incide sobre determinadas operações relativas à circulação de mercadorias e serviços previstos em lei.',
                            'Taxa de coleta de resíduos: pode estar vinculada a um serviço público específico e divisível, conforme a legislação.',
                            'Contribuição previdenciária: contribuição social relacionada ao financiamento da seguridade social.',
                        ],
                        'quiz' => self::questoes([
                            ['O que é um tributo?', [
                                'Um pagamento sempre voluntário feito a uma loja.',
                                'Um pagamento obrigatório instituído por lei.',
                                'Uma doação feita a qualquer pessoa.',
                                'Um desconto escolhido pelo consumidor.',
                            ], 1, 'Tributo é uma obrigação prevista em lei e cobrada pelo poder público.'],
                            ['Qual alternativa apresenta espécies de tributos?', [
                                'Salário, comissão e gorjeta.',
                                'Aluguel, parcela e prestação.',
                                'Impostos, taxas e contribuições.',
                                'Desconto, promoção e lucro.',
                            ], 2, 'Impostos, taxas e contribuições são espécies de tributos.'],
                            ['Qual é uma característica do imposto?', [
                                'Não está vinculado a um serviço específico prestado diretamente ao contribuinte.',
                                'É sempre uma cobrança voluntária.',
                                'É cobrado apenas por lojas.',
                                'É sempre devolvido ao contribuinte no mesmo mês.',
                            ], 0, 'O imposto não exige uma contraprestação estatal específica e direta para quem paga.'],
                            ['O IPTU está relacionado principalmente:', [
                                'À compra de alimentos.',
                                'À propriedade de imóvel urbano.',
                                'Ao uso de transporte aéreo.',
                                'À matrícula em escola particular.',
                            ], 1, 'O IPTU é um imposto municipal relacionado à propriedade de imóvel urbano.'],
                            ['O IPVA é um imposto relacionado:', [
                                'À propriedade de veículos automotores.',
                                'À compra de material escolar.',
                                'À conta de água de uma residência.',
                                'À contratação de internet.',
                            ], 0, 'O IPVA é um imposto estadual relacionado à propriedade de veículos automotores.'],
                            ['Uma taxa pode estar relacionada:', [
                                'A qualquer compra em supermercado.',
                                'Ao pagamento de salário.',
                                'A um serviço público específico e divisível, conforme a lei.',
                                'À escolha de uma marca de roupa.',
                            ], 2, 'A taxa pode decorrer de serviço público específico e divisível ou do exercício do poder de polícia.'],
                            ['A contribuição previdenciária é relacionada:', [
                                'Ao financiamento da seguridade social.',
                                'Ao pagamento de compras em lojas.',
                                'À compra de imóveis urbanos exclusivamente.',
                                'À cobrança de mensalidade escolar privada.',
                            ], 0, 'A contribuição previdenciária integra as contribuições sociais ligadas à seguridade social.'],
                            ['Quem pode instituir tributos?', [
                                'Qualquer pessoa física, sem regras.',
                                'Somente empresas privadas.',
                                'Os entes públicos competentes, respeitando a Constituição e as leis.',
                                'Qualquer loja que queira aumentar o preço.',
                            ], 2, 'A instituição e a cobrança de tributos dependem da competência prevista na Constituição e das regras legais.'],
                            ['Tributo e preço de um produto são a mesma coisa?', [
                                'Sim, todos os pagamentos são tributos.',
                                'Não. O preço é pago pela compra de um bem ou serviço; tributo é uma obrigação legal.',
                                'Sim, desde que o pagamento seja em dinheiro.',
                                'Não, porque produtos não podem ter preço.',
                            ], 1, 'O preço remunera uma compra ou serviço privado; o tributo decorre de uma obrigação prevista em lei.'],
                            ['Por que é importante conhecer os tributos?', [
                                'Para deixar de acompanhar os gastos.',
                                'Para confundir impostos com compras.',
                                'Para compreender obrigações, direitos e o financiamento das políticas públicas.',
                                'Para evitar qualquer participação cidadã.',
                            ], 2, 'Conhecer os tributos ajuda a entender a arrecadação e sua relação com o financiamento do Estado.'],
                        ]),
                    ],
                ],
            ],

            'orcamento-pessoal' => [
                'nome' => 'Orçamento Pessoal',
                'descricao' => 'Planejamento, controle de gastos e organização financeira.',
                'bg' => '#e1ece4',
                'fg' => '#1f7a4a',
                'icone' => '<path d="M19 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0 0 4h14a1 1 0 0 1 1 1v3m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5"/><path d="M20 11h-3a2 2 0 0 0 0 4h3z"/>',
                'conteudos' => [
                    [
                        'slug' => 'como-montar-orcamento-pessoal',
                        'titulo' => 'Como montar um orçamento pessoal',
                        'resumo' => 'Aprenda a organizar receitas, despesas, prioridades e objetivos.',
                        'tempo' => '8 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Orçamento pessoal é uma ferramenta que ajuda a organizar o dinheiro que entra e o dinheiro que sai durante determinado período. As receitas são os valores recebidos, como salário, mesada ou renda de um trabalho. As despesas são os gastos, como alimentação, transporte, contas, estudos e lazer.\n\nPara montar um orçamento, primeiro é importante registrar todas as receitas e despesas. Depois, os gastos podem ser separados por categorias e comparados com o total recebido. Isso ajuda a identificar excessos, planejar compras e definir objetivos possíveis.\n\nO orçamento precisa ser acompanhado e atualizado. Uma reserva para imprevistos pode ajudar a lidar com despesas inesperadas. O objetivo não é deixar de aproveitar a vida, mas tomar decisões conscientes e evitar gastar mais do que se pode.',
                        'exemplos' => [
                            'Uma pessoa anota quanto recebe e quanto gasta com transporte, alimentação, estudos e lazer durante o mês.',
                            'Ao perceber que está gastando muito com lanches fora de casa, alguém define um limite para esse tipo de despesa.',
                            'Uma família compara o valor das contas fixas com a renda antes de assumir uma nova parcela.',
                            'Um estudante que recebe mesada separa uma parte para um objetivo, como comprar um livro ou material escolar.',
                            'Uma reserva financeira pode ajudar a pagar um conserto inesperado sem comprometer todas as despesas do mês.',
                        ],
                        'quiz' => self::questoes([
                            ['O que é orçamento pessoal?', [
                                'Uma lista de desejos sem relação com dinheiro.',
                                'Uma ferramenta para organizar receitas e despesas.',
                                'Um empréstimo feito pelo banco.',
                                'Um documento usado somente por empresas grandes.',
                            ], 1, 'O orçamento organiza o dinheiro recebido e os gastos de um período.'],
                            ['Qual alternativa é um exemplo de receita?', [
                                'Conta de energia.',
                                'Compra de roupas.',
                                'Salário ou mesada recebida.',
                                'Pagamento do transporte.',
                            ], 2, 'Receita é o dinheiro que entra, como salário, mesada ou pagamento por um trabalho.'],
                            ['Qual alternativa é uma despesa?', [
                                'Dinheiro recebido por um trabalho.',
                                'Mesada recebida.',
                                'Presente em dinheiro.',
                                'Pagamento da conta de internet.',
                            ], 3, 'Despesa é um gasto, como contas, alimentação, transporte ou lazer.'],
                            ['O que deve ser feito primeiro para organizar o orçamento?', [
                                'Registrar as receitas e as despesas.',
                                'Fazer compras sem planejamento.',
                                'Ignorar os gastos pequenos.',
                                'Contratar um empréstimo.',
                            ], 0, 'Registrar entradas e saídas permite conhecer a situação financeira.'],
                            ['Quando as despesas superam as receitas, ocorre:', [
                                'Superávit.',
                                'Déficit.',
                                'Lucro garantido.',
                                'Rendimento fixo.',
                            ], 1, 'Déficit acontece quando se gasta mais do que se recebe.'],
                            ['Qual é a função de uma reserva de emergência?', [
                                'Aumentar as compras por impulso.',
                                'Substituir todo o planejamento.',
                                'Ajudar a lidar com imprevistos financeiros.',
                                'Garantir que nunca haverá despesas.',
                            ], 2, 'A reserva pode ser usada em situações inesperadas, como um conserto urgente.'],
                            ['Por que separar despesas por categorias?', [
                                'Para dificultar o controle.',
                                'Para não saber onde o dinheiro é gasto.',
                                'Para aumentar automaticamente a renda.',
                                'Para identificar onde estão concentrados os gastos.',
                            ], 3, 'As categorias ajudam a perceber quais áreas consomem mais dinheiro.'],
                            ['O que é uma despesa fixa?', [
                                'Um gasto que costuma se repetir e ter valor previsível, como aluguel.',
                                'Uma compra que acontece uma única vez.',
                                'Um dinheiro recebido inesperadamente.',
                                'Um investimento que sempre dá lucro.',
                            ], 0, 'Despesas fixas costumam se repetir, embora seus valores possam variar em alguns casos.'],
                            ['Antes de comprar algo parcelado, é importante:', [
                                'Olhar somente o valor da primeira parcela.',
                                'Avaliar o valor total, as parcelas e se cabem no orçamento.',
                                'Ignorar as outras contas.',
                                'Considerar o limite do cartão como renda.',
                            ], 1, 'É importante verificar o custo total e se as parcelas cabem na renda e nas despesas.'],
                            ['Por que o orçamento deve ser revisado?', [
                                'Porque receitas e despesas podem mudar com o tempo.',
                                'Porque ele não pode ser usado por mais de um mês.',
                                'Porque os gastos não precisam ser registrados.',
                                'Porque revisar elimina todas as contas.',
                            ], 0, 'A revisão permite adaptar o planejamento às mudanças na renda, nos gastos e nos objetivos.'],
                        ]),
                    ],
                ],
            ],

            'investimentos' => [
                'nome' => 'Investimentos',
                'descricao' => 'Juros compostos, renda fixa, riscos e planejamento.',
                'bg' => '#e3e8f2',
                'fg' => '#2a5fa5',
                'icone' => '<path d="m3 17 6-6 4 4 8-8"/><path d="M15 7h6v6"/>',
                'conteudos' => [
                    [
                        'slug' => 'juros-compostos',
                        'titulo' => 'Juros compostos',
                        'resumo' => 'Entenda os juros sobre juros e conheça cuidados básicos antes de investir.',
                        'tempo' => '8 min',
                        'nivel' => 'Intermediário',
                        'conceito' => 'Investir significa aplicar recursos em busca de um resultado futuro, considerando que existem riscos e condições diferentes em cada modalidade. Antes de investir, é importante definir um objetivo, conhecer o prazo em que o dinheiro poderá ficar aplicado e entender quanto risco é possível assumir.\n\nJuros compostos são calculados sobre o valor inicial acrescido dos juros acumulados nos períodos anteriores. Por isso, são conhecidos como juros sobre juros. O resultado depende do valor aplicado, da taxa, do tempo e das condições do investimento.\n\nA renda fixa possui regras de remuneração conhecidas ou vinculadas a indicadores, mas isso não significa que todo produto seja livre de riscos. A liquidez indica a facilidade e o prazo para resgatar o dinheiro. Também é importante verificar taxas, impostos, garantias aplicáveis e a instituição responsável.',
                        'exemplos' => [
                            'Em um exemplo hipotético, R$ 1.000 com rendimento de 10% em um período passa a R$ 1.100.',
                            'No período seguinte, os 10% incidem sobre R$ 1.100, e o saldo chega a R$ 1.210, antes de taxas e impostos.',
                            'Uma pessoa que pretende usar o dinheiro em poucos meses precisa observar a liquidez do investimento.',
                            'Antes de aplicar, alguém compara prazo, riscos, custos e regras de resgate de diferentes produtos.',
                            'Uma promessa de retorno muito alto e garantido deve ser analisada com cuidado, pois todo investimento envolve condições e riscos.',
                        ],
                        'quiz' => self::questoes([
                            ['O que são juros compostos?', [
                                'Juros calculados somente uma vez e nunca mais atualizados.',
                                'Juros calculados sobre o capital inicial mais os juros acumulados.',
                                'Um desconto aplicado em todas as compras.',
                                'Um valor que não depende do tempo.',
                            ], 1, 'Nos juros compostos, os juros acumulados são incorporados ao saldo e entram nos cálculos seguintes.'],
                            ['Por que os juros compostos são chamados de juros sobre juros?', [
                                'Porque os juros acumulados também passam a render juros.',
                                'Porque são cobrados apenas em compras à vista.',
                                'Porque não dependem de uma taxa.',
                                'Porque diminuem obrigatoriamente a cada período.',
                            ], 0, 'A cada período, o saldo atualizado se torna a base para o cálculo dos juros seguintes.'],
                            ['Um valor hipotético de R$ 1.000 rende 10% em cada período. Qual o saldo após dois períodos, com juros compostos e sem custos?', [
                                'R$ 1.100.',
                                'R$ 1.200.',
                                'R$ 1.210.',
                                'R$ 1.300.',
                            ], 2, 'Primeiro período: R$ 1.100. Segundo período: R$ 1.100 × 1,10 = R$ 1.210.'],
                            ['O que significa liquidez de um investimento?', [
                                'A possibilidade e o prazo para transformar o investimento em dinheiro disponível.',
                                'A quantidade de propagandas sobre o produto.',
                                'A certeza de que nunca haverá perdas.',
                                'O valor do salário de quem investe.',
                            ], 0, 'Liquidez está relacionada à facilidade e ao prazo para resgatar o dinheiro.'],
                            ['O que deve ser avaliado antes de investir?', [
                                'Somente a propaganda.',
                                'Risco, prazo, liquidez e custos.',
                                'Apenas o nome do investimento.',
                                'Somente a opinião de amigos.',
                            ], 1, 'Esses fatores ajudam a verificar se o produto combina com os objetivos e as condições de quem investe.'],
                            ['O que é renda fixa?', [
                                'Um investimento cujo retorno segue regras ou indicadores definidos previamente.',
                                'Um investimento sem nenhuma regra.',
                                'Uma modalidade que sempre rende o mesmo valor em qualquer situação.',
                                'Uma compra parcelada no cartão.',
                            ], 0, 'Na renda fixa, a forma de remuneração é definida por regras, taxas ou indicadores, embora existam riscos.'],
                            ['Um investimento com maior possibilidade de retorno pode também apresentar:', [
                                'Ausência total de riscos.',
                                'Risco maior.',
                                'Garantia de lucro diário.',
                                'Resgate sempre imediato.',
                            ], 1, 'Em geral, a possibilidade de retorno maior pode vir acompanhada de riscos maiores.'],
                            ['Por que é importante desconfiar de promessas de lucro alto e garantido?', [
                                'Porque todo investimento é proibido.',
                                'Porque nenhuma aplicação pode render.',
                                'Porque promessas desse tipo podem esconder riscos ou golpes.',
                                'Porque o dinheiro não pode ser guardado.',
                            ], 2, 'Promessas de retorno alto e garantido merecem cuidado e verificação das informações e da instituição.'],
                            ['O que é diversificação?', [
                                'Colocar todos os recursos em uma única opção.',
                                'Distribuir os recursos entre diferentes investimentos.',
                                'Investir sem conhecer o produto.',
                                'Resgatar todo o dinheiro diariamente.',
                            ], 1, 'Diversificar distribui os recursos e pode reduzir a concentração em um único tipo de investimento.'],
                            ['Qual atitude é mais adequada para quem está começando a estudar investimentos?', [
                                'Investir sem pesquisar.',
                                'Escolher apenas pelo retorno prometido.',
                                'Pedir dinheiro emprestado para investir sem planejamento.',
                                'Estudar os produtos, entender os riscos e definir objetivos.',
                            ], 3, 'Conhecimento, planejamento e avaliação de riscos são passos importantes antes de investir.'],
                        ]),
                    ],
                ],
            ],

            'credito-e-dividas' => [
                'nome' => 'Crédito e Dívidas',
                'descricao' => 'Cartão de crédito, empréstimos, juros e consumo consciente.',
                'bg' => '#f6e1e6',
                'fg' => '#b0345a',
                'icone' => '<rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="M2 10h20"/>',
                'conteudos' => [
                    [
                        'slug' => 'cartao-de-credito-e-rotativo',
                        'titulo' => 'Cartão de crédito e juros do rotativo',
                        'resumo' => 'Entenda como funciona o crédito, o cartão e os cuidados para evitar dívidas.',
                        'tempo' => '8 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Crédito é a possibilidade de utilizar um valor ou comprar algo agora e realizar o pagamento depois, de acordo com as condições combinadas. Cartões de crédito, empréstimos e financiamentos são exemplos de operações de crédito. Eles podem ajudar em determinadas situações, mas precisam ser utilizados com planejamento.\n\nQuando a fatura do cartão não é paga integralmente, o valor que fica em aberto pode entrar em uma modalidade de financiamento, como o crédito rotativo, conforme as regras do produto. Essa operação pode gerar juros e outros encargos. Por isso, pagar apenas uma parte da fatura pode aumentar o custo da dívida.\n\nAntes de contratar crédito, é importante comparar taxas, prazo, parcelas e Custo Efetivo Total (CET). Também é necessário avaliar se os pagamentos cabem no orçamento. O limite do cartão não é dinheiro extra: é um valor que poderá precisar ser pago depois.',
                        'exemplos' => [
                            'Uma pessoa recebe a fatura do cartão e confere todas as compras antes do vencimento.',
                            'Se não puder pagar o valor total, ela verifica as opções oferecidas e compara o custo total antes de decidir.',
                            'Antes de fazer um empréstimo, alguém compara o CET, a quantidade de parcelas e o total que será pago.',
                            'Um estudante evita tratar o limite disponível do cartão como se fosse parte da renda mensal.',
                            'Uma família organiza as parcelas já existentes antes de assumir uma nova compra financiada.',
                        ],
                        'quiz' => self::questoes([
                            ['O que é crédito?', [
                                'Dinheiro que não precisa ser devolvido em nenhuma situação.',
                                'A possibilidade de utilizar recursos agora e pagar depois, conforme condições combinadas.',
                                'Um desconto obrigatório em todas as compras.',
                                'Uma forma de eliminar despesas.',
                            ], 1, 'Crédito permite antecipar o uso de recursos, mas cria uma obrigação de pagamento conforme o contrato.'],
                            ['O limite do cartão de crédito deve ser entendido como:', [
                                'Renda extra que pertence ao consumidor.',
                                'Dinheiro que não precisa ser pago.',
                                'Um valor disponibilizado para compras e que deverá ser pago conforme a fatura.',
                                'Uma poupança automática.',
                            ], 2, 'O limite não é renda: as compras realizadas geram uma fatura que precisa ser paga.'],
                            ['O que pode acontecer quando a fatura não é paga integralmente?', [
                                'O saldo em aberto pode ser financiado e gerar encargos.',
                                'A dívida desaparece automaticamente.',
                                'O banco é obrigado a cancelar todas as compras.',
                                'O limite vira dinheiro gratuito.',
                            ], 0, 'O saldo não pago pode entrar em uma modalidade de financiamento, com juros e encargos.'],
                            ['O que significa CET?', [
                                'Cadastro Especial de Tarifas.',
                                'Custo Efetivo Total de uma operação de crédito.',
                                'Crédito Extra Temporário.',
                                'Controle de Entrada de Trabalho.',
                            ], 1, 'O CET reúne os custos de uma operação de crédito e ajuda a comparar propostas.'],
                            ['Antes de contratar um empréstimo, é importante comparar:', [
                                'Somente a cor do cartão.',
                                'Apenas o valor da primeira parcela.',
                                'Taxas, CET, prazo e valor total a pagar.',
                                'Somente o nome da instituição.',
                            ], 2, 'Comparar o custo total e as condições ajuda a escolher com mais informação.'],
                            ['O que é crédito rotativo?', [
                                'Uma modalidade que pode financiar o saldo não pago da fatura do cartão.',
                                'Um desconto dado em compras à vista.',
                                'Uma conta de poupança.',
                                'Um tipo de salário.',
                            ], 0, 'O crédito rotativo pode incidir sobre parte da fatura que não foi paga, conforme as regras vigentes.'],
                            ['Qual atitude ajuda a evitar dívidas no cartão?', [
                                'Ignorar as compras parceladas.',
                                'Acompanhar os gastos e planejar o pagamento da fatura.',
                                'Usar todo o limite disponível.',
                                'Deixar todas as faturas vencerem.',
                            ], 1, 'Acompanhar as compras e planejar os pagamentos reduz o risco de acumular dívidas.'],
                            ['O que é uma compra parcelada?', [
                                'Uma compra sem preço definido.',
                                'Uma compra paga em várias prestações.',
                                'Uma compra que não aparece na fatura.',
                                'Uma compra que nunca precisa ser quitada.',
                            ], 1, 'No parcelamento, o pagamento é dividido em prestações, que devem ser consideradas no orçamento.'],
                            ['Por que é importante conferir a fatura do cartão?', [
                                'Para identificar compras, valores e possíveis cobranças incorretas.',
                                'Para aumentar automaticamente o limite.',
                                'Para evitar conhecer os gastos.',
                                'Para transformar crédito em renda.',
                            ], 0, 'Conferir a fatura ajuda a acompanhar os gastos e identificar eventuais erros ou cobranças desconhecidas.'],
                            ['Qual comportamento demonstra uso consciente do crédito?', [
                                'Contratar empréstimos sem conhecer as condições.',
                                'Fazer compras sem verificar a renda.',
                                'Comparar custos e assumir parcelas que cabem no orçamento.',
                                'Considerar que toda dívida é sempre vantajosa.',
                            ], 2, 'O uso consciente exige conhecer as condições e avaliar a capacidade de pagamento.'],
                        ]),
                    ],
                ],
            ],

            'economia' => [
                'nome' => 'Economia',
                'descricao' => 'Inflação, IPCA, Selic e conceitos que influenciam o dia a dia.',
                'bg' => '#f4e8d4',
                'fg' => '#b07a00',
                'icone' => '<path d="M3 3v18h18"/><path d="M8 17v-5m4 5V8m4 9v-3"/>',
                'conteudos' => [
                    [
                        'slug' => 'o-que-e-inflacao',
                        'titulo' => 'O que é inflação',
                        'resumo' => 'Entenda por que os preços mudam e como isso afeta o poder de compra.',
                        'tempo' => '8 min',
                        'nivel' => 'Básico',
                        'conceito' => 'Inflação é o aumento generalizado dos preços de bens e serviços ao longo do tempo. Quando os preços sobem, a mesma quantia de dinheiro tende a comprar menos produtos e serviços. Isso significa uma redução do poder de compra quando a renda não acompanha a alta dos preços.\n\nNo Brasil, o Índice Nacional de Preços ao Consumidor Amplo (IPCA), calculado pelo IBGE, é a principal referência para acompanhar a inflação ao consumidor. O índice considera uma cesta de produtos e serviços consumidos pelas famílias, como alimentação, transporte, habitação e saúde.\n\nA taxa Selic é a taxa básica de juros da economia, definida pelo Comitê de Política Monetária do Banco Central. Ela influencia outras taxas de juros e as condições de crédito e investimentos. Inflação, juros e atividade econômica estão relacionados, mas não são a mesma coisa.',
                        'exemplos' => [
                            'Se um conjunto de produtos custava R$ 100 e passa a custar R$ 105, o preço desse conjunto aumentou 5%.',
                            'Quando alimentos e transporte ficam mais caros, uma família pode precisar reorganizar as despesas do mês.',
                            'Se a renda permanece igual enquanto os preços aumentam, o dinheiro compra menos do que antes.',
                            'Uma pessoa pode comparar preços e planejar as compras para entender melhor como as mudanças afetam seu orçamento.',
                            'Mudanças na taxa Selic podem influenciar os juros de empréstimos, financiamentos e algumas aplicações financeiras.',
                        ],
                        'quiz' => self::questoes([
                            ['O que é inflação?', [
                                'A queda de todos os preços durante um dia.',
                                'O aumento generalizado dos preços ao longo do tempo.',
                                'O aumento do salário de uma única pessoa.',
                                'A quantidade de dinheiro guardada em casa.',
                            ], 1, 'Inflação é o aumento generalizado dos preços de bens e serviços em determinado período.'],
                            ['O que tende a acontecer com o poder de compra quando os preços sobem e a renda não acompanha?', [
                                'Aumenta automaticamente.',
                                'Permanece sempre igual.',
                                'Diminui.',
                                'Não tem nenhuma relação com os preços.',
                            ], 2, 'Com a mesma renda e preços mais altos, é possível comprar menos bens e serviços.'],
                            ['Qual instituição calcula o IPCA?', [
                                'IBGE.',
                                'Receita Federal.',
                                'Banco do Brasil.',
                                'Câmara dos Deputados.',
                            ], 0, 'O Instituto Brasileiro de Geografia e Estatística (IBGE) calcula o IPCA.'],
                            ['O que o IPCA mede?', [
                                'A quantidade de empregos em uma empresa.',
                                'A variação de preços de uma cesta de bens e serviços consumidos pelas famílias.',
                                'O valor de todos os imóveis do país.',
                                'A taxa de aprovação nas escolas.',
                            ], 1, 'O IPCA acompanha a variação de preços de uma cesta de produtos e serviços consumidos pelas famílias.'],
                            ['O que é a taxa Selic?', [
                                'Um imposto municipal.',
                                'O preço médio dos alimentos.',
                                'A taxa básica de juros da economia brasileira.',
                                'Uma tarifa de transporte público.',
                            ], 2, 'A Selic é a taxa básica de juros definida pelo Comitê de Política Monetária do Banco Central.'],
                            ['Quem define a meta para a taxa Selic?', [
                                'O Comitê de Política Monetária do Banco Central.',
                                'Cada supermercado individualmente.',
                                'As escolas públicas.',
                                'Os consumidores em votação mensal.',
                            ], 0, 'O Copom, órgão do Banco Central, decide a meta para a taxa Selic.'],
                            ['Se os preços sobem e a renda não muda, o que acontece com o dinheiro?', [
                                'Passa a comprar mais produtos.',
                                'Mantém sempre o mesmo poder de compra.',
                                'Pode comprar menos produtos e serviços.',
                                'Deixa de existir.',
                            ], 2, 'A alta dos preços reduz o poder de compra quando a renda não acompanha essa variação.'],
                            ['Qual é um exemplo de item que pode fazer parte dos gastos acompanhados pela inflação?', [
                                'Alimentação.',
                                'Número de curtidas em uma rede social.',
                                'Quantidade de páginas de um livro escolar.',
                                'Cor de um automóvel.',
                            ], 0, 'Alimentação é uma das categorias de consumo consideradas nos índices de preços ao consumidor.'],
                            ['Como a alta dos juros pode afetar o crédito?', [
                                'Pode tornar empréstimos e financiamentos mais caros.',
                                'Faz todas as dívidas desaparecerem.',
                                'Garante que todo empréstimo seja gratuito.',
                                'Impede qualquer compra à vista.',
                            ], 0, 'A taxa básica influencia outras taxas da economia e pode afetar o custo do crédito.'],
                            ['Qual atitude ajuda a lidar com aumentos de preços no dia a dia?', [
                                'Comprar sem comparar valores.',
                                'Ignorar o orçamento.',
                                'Planejar as compras e comparar preços.',
                                'Assumir dívidas sem avaliar os custos.',
                            ], 2, 'Comparar preços e planejar as despesas ajuda a adaptar o orçamento às mudanças.'],
                        ]),
                    ],
                ],
            ],
        ];
    }
}
