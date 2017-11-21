<?php

return [
    'resource_private' => [
        1 => [/* Gerenciar Usuário */
              'application\controller\usuario\gerenciarusuario',
              'application\controller\usuario\buscarusuario',
              'application\controller\usuario\excluirsolicitacaoacesso',
              'application\controller\funcionalidade\getfuncionalidadesbypacote',
              'application\controller\usuario\validarusuario',
              'application\controller\usuariofuncpacfunc\excluirpacoteusuario',
              'application\controller\usuariofuncpacfunc\incluiusuariofuncpacfunc',
              'application\controller\usuariofuncpacfunc\listarfuncionalidadespacotes',
              'application\controller\usuariofuncpacfunc\listarpacotescadastrados',
              'application\controller\usuario\buscarpontofocal'
        ],
        2 => [/* Validar Instituição Estrangeira */
              'application\controller\iesestrangeira\buscaiesestrangeira',
              'application\controller\iesestrangeira\validariesestrangeira'
        ],
        3 => [/* Alterar Texto Sistema */
              'application\controller\texto\alterartextoparam',
              'application\controller\texto\buscartextoparam',
              'application\controller\texto\index',
              'application\controller\texto\novotextoparam',
              'application\controller\texto\visualizartextoparam'
        ],
        35 => [/* Alterar Termo de Adesão Revalidacao */
               'application\controller\termorevalidacao\index',
               'application\controller\termorevalidacao\editar',
               'application\controller\termorevalidacao\criar',
               'application\controller\termorevalidacao\update',
               'application\controller\termorevalidacao\assinaram',
               'application\controller\termorevalidacao\nao-assinaram'
        ],
        36 => [/* Alterar Termo de Adesão Reconhecimento */
               'application\controller\termoreconhecimento\index',
               'application\controller\termoreconhecimento\editar',
               'application\controller\termoreconhecimento\criar',
               'application\controller\termoreconhecimento\update',
               'application\controller\termoreconhecimento\assinaram',
               'application\controller\termoreconhecimento\nao-assinaram'
        ],
        37 => [/* Aderir ao termo de Revalidação */
               'application\controller\aderir\revalidacao',
               'application\controller\aderir\informativo',
               'application\controller\aderir\aceitartermo',
        ],
        38 => [/* Aderir ao termo de Reconhecimento */
               'application\controller\aderir\reconhecimento',
               'application\controller\aderir\informativo',
               'application\controller\aderir\aceitartermo',
        ],
        6 => [/* Gerenciar Convite */
              'application\controller\convite\buscarconvites',
              'application\controller\convite\gerenciarconvite',
              'application\controller\convite\novoconvite',
              'application\controller\convite\reenviarconvite',
              'application\controller\convite\visualizarconvite',
              'application\controller\convite\excluirconvite',
              'application\controller\convite\getdadospessoaconvitebycpf',
              'application\controller\convite\addconviteusuario'
        ],
        7 => [/* Aderir ao SINARD */
              'application\controller\aderir\aceitarsave',
              'application\controller\aderir\index',
              'application\controller\aderir\termo',
              'application\controller\aderir\aceitartermo',
              'application\controller\aderir\salvartermo'
        ],
        8 => [/* Imprimir Informativo */
              'application\controller\report\informativo'
        ],
        9 => [/* Imprimir Termo de Adesão */
              'application\controller\report\termopdf'
        ],
        10 => [/* Consultar Diplomado */
               'application\controller\diplomado\index',
               'application\controller\diplomado\consultadiplomado',
               'application\controller\diplomado\detalhe'
        ],
        11 => [/* Solicitar Pedido de Revalidação */
               'application\controller\processo\index',
               'application\controller\iesestrangeira\buscariesestrangeira',
               'application\controller\iesestrangeira\buscardadosies',
               'application\controller\iesestrangeira\adicionariesestrangeira',
               'application\controller\processo\consultardadoscursosolicitado',
               'application\controller\processo\upload',
               'application\controller\dmlocalizacao\getestadosbypais',
               'application\controller\processo\cancelar',
               'application\processo\resultado-busca-processos-diplomados',
               'application\controller\processo\removearquivo',

               'application\controller\processo\identificar-curso',
               'application\controller\processo\incluir-documentacao',
               'application\controller\processo\cancelar-solicitacao',
               'application\controller\processo\oferta-vaga',
               'application\controller\ofertavaga\grid-demostrativo-vaga',
               'application\controller\ofertavaga\grid-demonstrativo-vaga-reconhecimento',

               'application\controller\norma\detalhar-instituicao',
               'application\controller\processo\resumo-requerimento',
               'application\controller\processo\imprimir-resumo-requerimento',

               //download das normas
               'application\controller\norma\download-arquivo',

               'application\controller\processo\valida-processo-curso',
               'application\controller\arquivo\upload',
               'application\controller\arquivo\download',
               'application\controller\arquivo\delete'
        ],
        12 => [/* Adicionar Universidade Estrangeira */
               'application\controller\iesestrangeira\index',
               'application\controller\iesestrangeira\adicionaruniversidadeestrangeira'
        ],
        13 => [/* Realizar Aceite Documental */
               'application\controller\aceitedocumento\index',
               'application\controller\aceitedocumento\buscaraceitedocumento',
               'application\controller\aceitedocumento\aceite',
               'application\controller\aceitedocumento\validaformulario',
               'application\controller\aceitedocumento\save',
               'application\controller\report\comprovantepdf',
               'application\controller\index\download',
               'application\controller\aceitedocumento\downloadpdfanaliseprocesso'
        ],
        14 => [/* Realizar Análise digital */
               'application\controller\analise\pre-analise',
               'application\controller\analise\analisar-documentacao-processo',
               'application\controller\analise\grid-historico-observacao',
               'application\controller\analise\salvar-analise-documental',

               'application\controller\arquivo\download',
               'application\controller\arquivo\download-all-files',

               'application\controller\analise\cancelar-solicitacao-pela-ies',

        ],
        15 => [/* Reenviar  Documentação */
               'application\controller\reenviodocumentacao\index',
               'application\controller\reenviodocumentacao\salvar-reenvio-documentacao',

               'application\controller\arquivo\upload',
               'application\controller\arquivo\download',
               'application\controller\arquivo\delete',

                'application\controller\reenviodocumentacao\grid-historico-observacao'

               //'application\controller\processo\reenviodocumento',
               //'application\controller\processo\postreenviardocumento'
        ],
        16 => [/* Imprimir_Requerimento */
               'application\controller\analiseprocesso\imprimirrequerimento',
        ],
        17 => [/* Manter Processo */
               'application\controller\processo\consultar',
               'application\controller\processo\excluir-solicitacao',

                'application\controller\recesso\grid-consultar-recessos',

               //quando usuario precisar alterar a IES estrangeira do processo
               'application\controller\processo\troca-ies-estrangeira-processo',

               'application\controller\iesestrangeira\novo',
               'application\controller\iesestrangeira\consultar-ies-estrangeira'
        ],
        18 => [/* Gerenciar Edital */
               'application\controller\edital\gerenciaredital',
               'application\controller\edital\buscaedital',
               'application\controller\edital\editalporcurso',
               'application\controller\edital\editaredital',
               'application\controller\edital\getcursos',
               'application\controller\edital\getinstrucoes',
               'application\controller\edital\novoedital',
               'application\controller\edital\posteditaredital',
               'application\controller\edital\prorrogaredital',
               'application\controller\edital\postprorrogaredital'
        ],
        19 => [/* Realizar Tramitação do Processo */
               'application\controller\analiseprocesso\busca',
               'application\controller\analiseprocesso\uploaddocumentocomplementacao',
               'application\controller\analiseprocesso\removearquivo',
               'application\controller\analiseprocesso\tramitaparecerfinal',
               'application\controller\analiseprocesso\complementacao',
               'application\controller\analiseprocesso\buscarprocesso',
               'application\controller\analiseprocesso\documentacaodigital',
               'application\controller\analiseprocesso\alterarinstituicao',
               'application\controller\analiseprocesso\updateuniversidadeestrangeira',
               'application\controller\analiseprocesso\analiseprocessual',
               'application\controller\analiseprocesso\uploaddocumento',
               'application\controller\analiseprocesso\saveanaliseprocessual',
               'application\controller\analiseprocesso\parecerfinal',
               'application\controller\processo\saveparecerfinal',
               'application\controller\analiseprocesso\saveparecerfinal',
               'application\controller\analiseprocesso\savecomplementacao',
               'application\controller\analiseprocesso\tramitacomplementacao',
               'application\controller\analiseprocesso\parecerfinal',
               'application\controller\processo\saveparecerfinal',
               'application\controller\analiseprocesso\tramitaanaliseprocessual',
               'application\controller\analiseprocesso\alterarinstituicaoestrangeira',
               'application\controller\iesestrangeira\alteraruniversidadeestrangeira',
               'application\controller\analiseprocesso\tramitaanaliseprocessual',
               'application\controller\analiseprocesso\removeupload',
               'application\controller\dmlocalizacao\getestadosbypais',
        ],
        20 => [/* Publicar Processo */
               'application\controller\processo\consultarprocessopublicacao',
               'application\controller\processo\publicarprocesso'
        ],
        21 => [/* Visualizar Recurso */
               'application\controller\recurso\visualizar'
        ],
        22 => [/* Solicitar Recurso (Requerente) */
            'application\controller\recurso\solicitar',
            'application\controller\recurso\salvar-solicitacao',
            'application\controller\recurso\excluir-solicitacao',
        ],
        23 => [/* Analisar Admissibilidade (Gestor Responsável) */
            'application\controller\recurso\analisar-admissibilidade',
            'application\controller\recurso\salvar-analise-admissibilidade'
        ],
        24 => [/* Analisar Recurso (Gestor Conselho/Câmara)  */
            'application\controller\recurso\analisar',
            'application\controller\recurso\salvar-analise',
        ],
        25 => [/* Solicitar Reavaliação */
               'application\controller\reavaliacao\visualizarreavaliacao',
               'application\controller\processo\download',
               'application\controller\index\download',
               'application\controller\reavaliacao\getinstituicaoporcocursoedital',
               'application\controller\reavaliacao\uploaddocumentorecurso',
               'application\controller\reavaliacao\removeuploadrecurso',
               'application\controller\reavaliacao\validarreavaliacao',
               'application\controller\reavaliacao\savereavaliacao'
        ],
        26 => [/* Analisar Reavaliação */
               'application\controller\reavaliacao\visualizaranaliseii',
               'application\controller\processo\download',
               'application\controller\index\download',
               'application\controller\reavaliacao\uploaddocumentorecurso',
               'application\controller\reavaliacao\download',
               'application\controller\reavaliacao\removeuploadrecurso',
               'application\controller\reavaliacao\saveanaliseii',
               'application\controller\reavaliacao\tramitaranaliseii'
        ],
        27 => [/* Imprimir_Reavaliação */
               'application\controller\reavaliacao\imprimirreavaliacao'
        ],
        28 => [/* Solicitar Recurso CNE */
               'application\controller\recurso\index',
               'application\controller\reavaliacao\visualizarrecursocne',
               'application\controller\processo\download',
               'application\controller\index\download',
               'application\controller\reavaliacao\uploaddocumentorecurso',
               'application\controller\reavaliacao\download',
               'application\controller\reavaliacao\removeuploadrecurso',
               'application\controller\reavaliacao\saverecursocne'
        ],
        29 => [/* Analisar Recurso CNE */
               'application\controller\reavaliacao\visualizaranalisecne',
               'application\controller\processo\download',
               'application\controller\index\download',
               'application\controller\reavaliacao\uploaddocumentorecurso',
               'application\controller\reavaliacao\download',
               'application\controller\reavaliacao\index',
               'application\controller\reavaliacao\saveanalisecne',
               'application\controller\reavaliacao\removeuploadrecurso',
               'application\controller\reavaliacao\removearquivo',
        ],
        30 => [/* Consultar Publicação */
               'application\controller\reavaliacao\consultarpublicacao',
               'application\controller\processo\download',
               'application\controller\index\download',
               'application\controller\reavaliacao\uploaddocumentorecurso',
               'application\controller\reavaliacao\download',
               'application\controller\reavaliacao\removeuploadrecurso',
               'application\controller\reavaliacao\saveanalisecne'
        ],
        31 => [/* Publicar Recurso */
               'application\controller\reavaliacao\busca',
               'application\controller\reavaliacao\buscarprocesso',
               'application\controller\reavaliacao\visualizarpublicar',
               'application\controller\reavaliacao\savepublicar',
               'application\controller\index\download',
        ],
        32 => [/* Emitir Relatório */
               'application\controller\report\consultarelatorio',
               'application\controller\report\postrelatorio',
               'application\controller\report\getsituacoesbyetapa',
               'application\controller\report\getmunicipiosbyuf',
               'application\controller\iesestrangeira\buscarieestrangeiraconsultarelatorio',
               'application\controller\iesestrangeira\buscardadosiesconsultarelatorio',
               'application\controller\instituicaobrasileira\buscariesbrasileiraconsultarelatorio',
               'application\controller\instituicaobrasileira\buscardadosiesbrasileiraconsultarelatorio',
               'application\controller\report\limparform'
        ],
        33 => [/* Manter Pacotes */
               'application\controller\pacote\alterarpacote',
               'application\controller\pacote\consultarpacote',
               'application\controller\pacote\manterpacote',
               'application\controller\pacote\incluirpacote',
               'application\controller\pacote\salvarpacote',
               'application\controller\pacote\validarnomepacote'

        ],

        39 => [/* Manter Normas Reconhecimento */
               'application\controller\norma\reconhecimento',
               'application\controller\norma\grid-normas',
               'application\controller\ofertavaga\reconhecimento',
               'application\controller\norma\upload-norma',
               'application\controller\norma\remove-arquivo',
               'application\controller\norma\desativa-norma',
               'application\controller\norma\download-arquivo',
               'application\controller\norma\verificar-normas',
        ],
        40 => [/* Manter Normas Revalidação */
               'application\controller\norma\revalidacao',
               'application\controller\norma\grid-normas',

               'application\controller\ofertavaga\revalidacao',
               'application\controller\norma\upload-norma',
               'application\controller\norma\remove-arquivo',
               'application\controller\norma\desativa-norma',
               'application\controller\norma\download-arquivo',

               'application\controller\norma\verificar-normas',
        ],
        41 => [ /* Documentação de Pagamento */
            'application\controller\documentacaopagamento\consultar',
            'application\controller\documentacaopagamento\cadastrar-documento',
            'application\controller\documentacaopagamento\salvar-documentacao-pagamento',
            'application\controller\analise\grid-historico-observacao',
            'application\controller\arquivo\upload',
            'application\controller\arquivo\download',
            'application\controller\arquivo\delete',
        ],

        42 => [ /* Manter Comprovantes de Pagamentos */
            'application\controller\documentacaopagamento\consultar',
            'application\controller\documentacaopagamento\homologar-comprovante',
            'application\controller\documentacaopagamento\salvar-homologacao-comprovante',
            'application\controller\analise\grid-historico-observacao',
            'application\controller\processo\arquivar-solicitacao',
        ],
        43 => [ /* Anexar Comprovante de Pagamento */
            'application\controller\comprovantepagamento\index',
            'application\controller\comprovantepagamento\salvar-comprovante-pagamento',
            'application\controller\arquivo\upload',
            'application\controller\arquivo\download',
            'application\controller\arquivo\delete',
            'application\controller\arquivo\download-all-files',
        ],
        44 => [ /* Gerenciar Processos */
            'application\controller\processo\gerenciar',
            'application\controller\arquivo\download-all-files',
        ],
        45 => [ /* Gerenciar Calendário de Recessos */
            'application\controller\recesso\consultar',
            'application\controller\recesso\cadastrar',
            'application\controller\recesso\editar',
            'application\controller\recesso\inativar',
        ],
        46 => [ /* Gerenciar Gestor / Responsável */
            'application\controller\organograma\gerenciar-rep-conselho-central',
            'application\controller\organograma\validar-convite-rep-conselho-central',
            'application\controller\organograma\enviar-convite-rep-conselho-central',
        ],
        47 => [ /* Gerenciar Unidades */
            'application\controller\organograma\gerenciar-unidades',
            'application\controller\organograma\grid-unidades',
            'application\controller\organograma\adicionar-unidade',
            'application\controller\organograma\editar-unidade',
            'application\controller\organograma\buscar-dados-usuario-by-cpf',
            'application\controller\organograma\salvar-unidade',
            'application\controller\organograma\buscar-unidades-pai',
            'application\controller\organograma\buscar-dados-rep-conselho-central',
        ],
        48 => [ /* Distribuir Processo */
            'application\controller\distribuicaoprocesso\distribuir',
            'application\controller\distribuicaoprocesso\buscar-dados-hierarquia-unidade',
            'application\controller\distribuicaoprocesso\salvar',
        ],
        49 => [ /* Gerenciar Comissões */
            'application\controller\comissao\gerenciar',
            'application\controller\comissao\compor-comissao',
            'application\controller\comissao\cadastrar-comissao',
            'application\controller\comissao\editar-comissao',
            'application\controller\comissao\inativar-comissao',
            'application\controller\comissao\grid-comissoes',
            'application\controller\comissao\get-usuario-by-cpf',
            'application\controller\arquivo\upload',
            'application\controller\arquivo\download',
            'application\controller\arquivo\delete',
            'application\controller\comissao\salvar-comissao',
            'application\controller\comissao\visualizar-comissao',
            'application\controller\comissao\vincular-processo',
            'application\controller\comissao\dados-hierarquia-unidade',
        ],
        50 => [ /* Analisar Processo - Presidente da Comissão */
            'application\controller\analisesubstantiva\analisar',
            'application\controller\analisesubstantiva\salvar-analise',
            'application\controller\analisesubstantiva\analisar-dados-complementares',
            'application\controller\analisesubstantiva\salvar-analise-dados-complementares',
            'application\controller\parecercomissao\elaborar-parecer',
            'application\controller\parecercomissao\salvar-parecer',
        ],
        51 => [ /* Enviar Informações Complementares - Requerente */
            'application\controller\analisesubstantiva\complementar-informacoes',
            'application\controller\analisesubstantiva\salvar-dados-complementares',
            'application\controller\processo\suspender',
            'application\controller\processo\reativar',
        ],
        52 => [ /* Gerenciar Representante do Conselho/Câmara - Reitor */
            'application\controller\conselho\gerenciar-representante',
            'application\controller\conselho\validar-convite-representante',
            'application\controller\conselho\enviar-convite-representante',
        ],
        53 => [ /* Gerenciar  Conselho/Câmara - Representante Instituição */
            'application\controller\integranteconselho\gerenciar',
            'application\controller\integranteconselho\grid-integrantes-conselho',
            'application\controller\integranteconselho\cadastrar-integrante',
            'application\controller\integranteconselho\get-usuario-by-cpf',
            'application\controller\integranteconselho\valida-add-integrante',
            'application\controller\integranteconselho\salvar-integrantes',
            'application\controller\integranteconselho\excluir-integrante',
            'application\controller\integranteconselho\visualizar-integrante',
        ],
        54 => [ /* Selecionar Relator (Conselho / Câmara) para um determinado processo  */
            'application\controller\relatorprocesso\selecionar-relator',
            'application\controller\relatorprocesso\buscar-processos-vinculados',
            'application\controller\relatorprocesso\grid-processos-vinculados',
            'application\controller\relatorprocesso\salvar-relator-processo',
            'application\controller\relatorprocesso\atender-convite',
            'application\controller\arquivo\download',
        ],
        55 => [ /* Elaborar Parecer Final (Decisão Final) - Rep Conselho / Câmara*/
            'application\controller\parecerfinal\elaborar-parecer',
            'application\controller\parecerfinal\salvar-parecer',
        ],
        56 => [ /* Elaborar Parecer do Relator - Relator Conselho / Câmara*/
            'application\controller\parecerrelator\elaborar-parecer',
            'application\controller\parecerrelator\salvar-parecer'
        ],
        57 => [ /* Validar Tramitação Simplificada - Gestor Responsável */
            'application\controller\processo\validar-tramitacao-simplificada',
            'application\controller\processo\salvar-validacao-tram-simplificada',
        ],
        58 => [ /* Gerenciar Processos Externos (Reitor/Gestor/Usuário Ies + Usuário Externo) */
            'application\controller\processoexterno\gerenciar',
            'application\controller\processoexterno\incluir',
            'application\controller\processoexterno\carregar-arvore-curso-area',
            'application\controller\processoexterno\carregar-curso-arcu-sul',
            'application\controller\processoexterno\salvar',
            'application\controller\processoexterno\editar',
            'application\controller\processoexterno\listar-processos',
            'application\controller\processoexterno\detalhar',
            'application\controller\processoexterno\excluir',
            'application\controller\pessoa\get-pessoa-fisica-by-cpf',
            'application\controller\dmlocalizacao\get-estados-by-pais',
            'application\controller\dmlocalizacao\getestadosbypais',
            'application\controller\iesestrangeira\buscariesestrangeira',
            'application\controller\iesestrangeira\buscardadosies',
            'application\controller\iesestrangeira\adicionariesestrangeira',
        ],
        59 =>[/* Gerenciar Processos Externos (Gestor/Usuário MEC ) */
            'application\controller\processoexterno\gerenciar-processo-externo-mec',
        ],
        60 => [
            'application\controller\processoexterno\designar-responsavel',
            'application\controller\pessoa\get-pessoa-fisica-by-cpf',
            'application\controller\processoexterno\convite-designar-responsavel',
            'application\controller\processoexterno\add-convite-usuario-responsavel',
            'application\controller\processoexterno\buscar-convites-usuario-externo',
            'application\controller\convite\excluir-convite'
        ],
        61 => [
            'application\controller\processo\aba-pre-analise'
        ],
        62 => [
            'application\controller\processo\aba-pagamento'
        ],
    ],
];
