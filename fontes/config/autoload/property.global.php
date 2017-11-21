<?php
return array(
    'st_autorizacao_usuario' => array(
        'A' => 'Ativo',
        'P' => 'Inativo',
        'B' => 'Recusado'
    ),
    'id_situacoes_usuario' => array( /* TB_SNR_SITUACAO_USU_FUNCAO */
        'ativo'     => 1,
        'pendente'  => 2,
        'rejeitada' => 3,
        'inativo'   => 4
    ),
	'id_estagios'=>array(
    	'complementacao' => 2,
    	'em_andamento' => 3,
    	'finalizado' => 1
    ),
    'id_pacotes' => array(
        'diplomado' => 8
    ),
    'id_situacoes_processo' => array( /* TB_SNR_SITUACAO_PROCESSO */
    	'solicitacao_requerente' => 1,

    ),
    'id_tipo_documento' => array( /* TB_SNR_TIPO_DOCUMENTO */
        'cpf' => 1,
        'rne' => 2,
        'comprovante_endereco' => 3,
        'certidao_nascimento' => 4,
        'outros' => 5,
        'diploma' => 6,
        'historico_escolar' => 7,
        'conteudo_programatico' => 8,
        'outros_academico' => 9,
    	'analise_documental'=>10,
    	'parecer_final'=>11,
    	'complementacao'=>12
    ),
    'id_parametros'=>array( /* TB_SNR_PARAM */
		'termo_de_adesao' => 1,
		'informativo' => 2,
        'gerenciar_edital' => 3,
        'gerenciar_norma_reconhecimento' => 3, //gerenciar edital mudou o nome para gerenciar norma
        'reavaliacao' => 4,
		'recurso' => 5,
		'recurso_cne' => 6,
		'solicitar_acesso' => 7,
		'solicitar_pedido_de_revalidacao' => 8,
		'modelo_termo_de_adesao'=>9,
		'termo_adesao_reconhecimento' => 12,

		'modelo_termo_adesao_revalidacao' => 9,
		'modelo_termo_adesao_reconhecimento' => 11,
		'gerenciar_norma_revalidacao' => 13,

		'revalidacao'=>9,
		'reconhecimento'=>11,
		
		
		
    ),
    'id_etapa'=>array( /* TB_SNR_ETAPA */
        'pedido_revalidacao' => 1,
        'analise_processo' => 2,
        'recurso' => 3,
        'reavaliacao' => 4,
        'recurso_cne' => 5,

		'solicitacao_iniciada' => 6,
		'solicitacao_finalizada' => 7,
		'solicitacao_cancelada' => 8,
		'solicitacao_aguardando_reenvio' => 9,
    ),
	'id_funcoes' => array( /* TB_SNR_FUNCAO */
		'gestor_mec'          => 1,
		'usuario_mec'         => 2,
		'cne'                 => 3,
		'reitor'              => 4,
		'gestor_instituicao'  => 5,
		'usuario_instituicao' => 6,
	    'diplomado'           => 8,
	    'usuario_externo'     => 10,
        'reitor_nao_aderente'     => 11
	),
    'ds_funcoes' => array(
        1 => 'gestor_mec',
        2 => 'usuario_mec',
        3 => 'cne',
        4 => 'reitor',
        5 => 'gestor_instituicao',
        6 => 'usuario_instituicao',
        8 => 'diplomado',
        10 => 'usuario_externo',
        11 => 'reitor_nao_aderente'
    ),
	'id_pais' => array(
		'brasil' => 31
	),
	'id_uf' => array(
		'AC' => 'AC',
		'AL' => 'AL',
		'AM' => 'AM',
		'AP' => 'AP',
		'BA' => 'BA',
		'CE' => 'CE',
		'DF' => 'DF',
		'ES' => 'ES',
		'GO' => 'GO',
		'MA' => 'MA',
		'MG' => 'MG',
		'MS' => 'MS',
		'MT' => 'MT',
		'PA' => 'PA',
		'PB' => 'PB',
		'PE' => 'PE',
		'PI' => 'PI',
		'PR' => 'PR',
		'RJ' => 'RJ',
		'RN' => 'RN',
		'RO' => 'RO',
		'RR' => 'RR',
		'RS' => 'RS',
		'SC' => 'SC',
		'SE' => 'SE',
		'SP' => 'SP',
		'TO' => 'TO'
	),
	'id_situacao_adesao' => array( /* TB_SNR_SITUACAO_ADESAO */
		'ativo'   => 1,
		'inativo' => 2,
		'pendente'=> 3
	),
    'tp_contato' => array( /* TB_SNR_USUARIO_CONTATO */
	    'telefone' => 't',
        'email' => 'e',
        'fax' => 'f'
	),
    'st_convite' => array( /* TB_SNR_CONVITE */
        'A' => 'Aceito',
        'P' => 'Pendente',
        'N' => 'Não Aceito'
    ),
    'st_envio' => array( /* TB_SNR_CONVITE */
        'E' => 'Enviado',
        'R' => 'Reenviado'
    ),
    'tp_error_convite' => array( /* CONVITE */
        '1' => 'error',
        '2' => 'errorConfirm'
    ),
    'tp_hierarquia_convite' => array( /* CONVITE */
        'usuario_mec' => array( 2 ),
        'gestor_mec' => array( 1, 2 ),
        'reitor' => array( 5, 6 ),
        'gestor_instituicao' => array( 5, 6 ),
        'usuario_instituicao' => array( 6 ),
    ),
    'tp_funcao' => array(
        'revalidacao' => 'RV',
        'reconhecimento' => 'RC',
        'revalidacao_reconhecimento' => 'RR'
    ),
    'ds_tp_funcao' => array(
        'RV' => 'Revalidação',
        'RC' => 'Reconhecimento',
        'RR' => 'Revalidação Reconhecimento'
    ),
    'ds_sexo' => array(
        'M' => 'Masculino',
        'F' => 'Feminino',
        'O' => 'Outro',
    ),

    'id_tipo_solicitacao' => array(
        'G' => 1, //graduação
        'M' => 2, //mestrado
        'D' => 3, //doutorado
    ),


);