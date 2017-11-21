<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\DoctrineExtensions\QuoteStrategy;
use Application\Util\MensagemUtil;
use Application\View\ContatoForm;
use Application\View\Helper\AcoesGridProcessoHelper;
use Application\View\Helper\MenuHelper;
use Application\View\Helper\DataSolicitacaoHelper;
use Doctrine\ORM\Entitymanager;
use Zend\Authentication\AuthenticationService;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\Http\Response;
use Zend\Log\Logger;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\Session\Container;

class Module
{
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();

        // Registering a listener at default priority, 1, which will trigger
        // after the ConfigListener merges config.
        $events->attach(ModuleEvent::EVENT_MERGE_CONFIG, [$this, 'onMergeConfig']);
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getViewHelperConfig()
    {
        return [
            FACTORIES => [
                'menuHelper' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    return new MenuHelper($locator->get('Request'), $sm);
                },
                'dataSolicitacaoHelper' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    return new DataSolicitacaoHelper($locator->get('Request'), $locator);
                },
                'acoesGridProcessoHelper' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    return new AcoesGridProcessoHelper($locator->get('Request'), $locator);
                }

            ]
        ];
    }
    public function getServiceConfig()
    {
        return [
            FACTORIES => [
                LOG_AUDIT => function ($sm) {
                    $config = $sm->get(CONFIG);
                    $db = $sm->get(Entitymanager::class);

                    $logger = new Logger();
                    $writer = new AuditWriter($db, $config[USER_IDENTIFY]);
                    $logger->addWriter($writer);

                    return $logger;
                },
                'utilityService' => function () {
                    return new ServiceUtility();
                },
                'auditoriaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AuditoriaService($sm, $em, $log);
                },
                'testeService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TesteService($sm, $em, $log);
                },
                'usuarioService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UsuarioService($sm, $em, $log);
                },
                INSTITUICAO_ESTRANGEIRA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\InstituicaoEstrangeiraService($sm, $em, $log);
                },
                'contatoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ContatoService($sm, $em, $log);
                },
                'UsuarioContatoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ContatoService($sm, $em, $log);
                },
                'funcaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\FuncaoService($sm, $em, $log);
                },
                USUARIO_FUNCAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UsuarioFuncaoService($sm, $em, $log);
                },
                CONVITE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ConviteService($sm, $em, $log);
                },
                'termoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TermoService($sm, $em, $log);
                },
                REAVALIACAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ReavaliacaoService($sm, $em, $log);
                },
                EDITAL_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\EditalService($sm, $em, $log);
                },
                'cursoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\CursoService($sm, $em, $log);
                },


//                'cursoEditalService' => function ($sm) {
//                    $em = $sm->get(Entitymanager::class);
//                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
//                    $log = $sm->get(LOG_AUDIT);
//                    return new Service\CursoEditalService($sm, $em, $log);
//                },


                'adesaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AdesaoService($sm, $em, $log);
                },
                'situacaoAdesaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\SituacaoAdesaoService($sm, $em, $log);
                },
                TEXTO_PARAM_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TextoParamService($sm, $em, $log);
                },
                PACOTE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\PacoteService($sm, $em, $log);
                },
                'funcionalidadePacoteService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\FuncionalidadePacoteService($sm, $em, $log);
                },
                PARAM_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ParamService($sm, $em, $log);
                },
                USUARIO_FUNC_PAC_FUNC_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UsuarioFuncPacFuncService($sm, $em, $log);
                },
                ETAPA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\EtapaService($sm, $em, $log);
                },
                DIPLOMADO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DiplomadoService($sm, $em, $log);
                },
                IES_BRASILEIRA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\InstituicaoBrasileiraService($sm, $em, $log);
                },
                SITUACAO_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = null;
                    return new Service\SituacaoProcessoService($sm, $em, $log);
                },
                DIPLOMADO_CURSO_EST_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DiplomadoCursoEstService($sm, $em, $log);
                },
                PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ProcessoService($sm, $em, $log);
                },
                DOCUMENTO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DocumentoService($sm, $em, $log);
                },
                ESTAGIO_ANALISE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\EstagioAnaliseService($sm, $em, $log);
                },
//                'docAnaliseProcessoService' => function ($sm) {
//                    $em = $sm->get(Entitymanager::class);
//                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
//                    $log = $sm->get(LOG_AUDIT);
//                    return new Service\DocAnaliseProcessoService($sm, $em, $log);
//                },
                'tipoDocumentoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoDocumentoService($sm, $em, $log);
                },
                MAIL_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\MailService($sm, $em, $log);
                },
                ANALISE_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AnaliseProcessoService($sm, $em, $log);
                },
                DIPLOMADO_CURSO_EST_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DiplomadoCursoEstService($sm, $em, $log);
                },
                CONTATO_IES_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ContatoIesService($sm, $em, $log);
                },
//                'reportService' => function ($sm) {
//                    $em = $sm->get(Entitymanager::class);
//                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
//                    $log = $sm->get(LOG_AUDIT);
//                    return new Service\ReportService($sm, $em, $log);
//                },
                'diasAssinaturaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DiasAssinaturaService($sm, $em, $log);
                },
                'dmIesEstrangeiraService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmIesEstrangeiraService($sm, $em, $log);
                },
                'dmCursoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmCursoService($sm, $em, $log);
                },
                'dmCorreiosCepService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmCorreiosCepService($sm, $em, $log);
                },
                'dmLocalizacaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmLocalizacaoService($sm, $em, $log);
                },
                'dmIesService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmIesService($sm, $em, $log);
                },
                DMA_IES_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmaIesService($sm, $em, $log);
                },
                OFERTA_VAGA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\OfertaVagaService($sm, $em, $log);
                },
                'dmPaisService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmPaisService($sm, $em, $log);
                },
                /* @TODO REMOVER ESTE  */
                'dmaPaisService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmaPaisService($sm, $em, $log);
                },
                'paisService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\PaisService($sm, $em, $log);
                },
                'dmaMantenedoraService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmaMantenedoraService($sm, $em, $log);
                },
                'situacaoUsuFuncaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\SituacaoUsuFuncaoService($sm, $em, $log);
                },
                'dmOcdeService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmOcdeService($sm, $em, $log);
                },
                'dmCatalogoCursoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmCatalogoCursoService($sm, $em, $log);
                },

                /*
                 * ESTE SERVIÇO DEVE SER REMOVIDO
                 */
                'dmUfEstrangeiraService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmUfEstrangeiraService($sm, $em, $log);
                },

                UF_ESTRANGEIRA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UfEstrangeiraService($sm, $em, $log);
                },

                /*
                 * ESTE SERVIÇO DEVE SER REMOVIDO
                 */
                'dmMunicipioEstrangeiroService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DmMunicipioEstrangeiroService($sm, $em, $log);
                },

                MUNICIPIO_ESTRANGEIRO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\MunicipioEstrangeiroService($sm, $em, $log);
                },

//                'Zend\Log\FirePhp' => function () {
//                    $writer_firebug = new \Zend\Log\Writer\FirePhp();
//                    $logger = new \Zend\Log\Logger();
//                    $logger->addWriter($writer_firebug);
//                    return $logger;
//                },
                SOLICITAR_ACESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\SolicitarAcessoService($sm, $em, $log);
                },
                CURSO_ARCUSUL_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\CursoArcusulService($sm, $em, $log);
                },
                'getPermissoesUsuario' => function ($sm) {
                    $authService = $sm->get(AUTH_SERVICE);
                    $config = $sm->get(CONFIG);

                    $permissions = [];
                    $coUsuarioFuncao = $authService->getIdentity()->coUsuarioFuncao;

                    $permissions[] = $authService->getIdentity()->roles;
                    $usuarioFuncPacFunService = $sm->get(USUARIO_FUNC_PAC_FUNC_SERVICE);

                    $usuarioFuncaoFuncionalidades = $usuarioFuncPacFunService->findBy([
                        CO_USUARIO_FUNCAO => $coUsuarioFuncao
                    ]);

                    // Carrega as permissões privadas
                    foreach ($usuarioFuncaoFuncionalidades as $usuFuncPacFunc) {
                        $coFuncionalidade = $usuFuncPacFunc->getCoFuncionalidadePacote()
                            ->getCoFuncionalidade()
                            ->getCoFuncionalidade();
                        $resourcesByFuncionalidade = $config['resource_private'][$coFuncionalidade];
                        foreach ($resourcesByFuncionalidade as $resource) {
                            $config['acl'][PERMISSOES] = array_merge([
                                $resource => [
                                    $authService->getIdentity()->roles
                                ]
                            ], $config['acl'][PERMISSOES]);
                        }
                    }

                    return $config['acl'][PERMISSOES];
                },
                'enderecoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\EnderecoService($sm, $em, $log);
                },
                'loginService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\LoginService($sm, $em, $log);
                },
                'captchaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\CaptchaService($sm, $em, $log);
                },
                'receitaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ReceitaService($sm, $em, $log);
                },
                'tipoSolicitacaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoSolicitacaoService($sm, $em, $log);
                },
                NORMA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\NormaService($sm, $em, $log);
                },
                'descricaoNormaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DescricaoNormaService($sm, $em, $log);
                },
                COMPLEMENTO_NORMA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ComplementoNormaService($sm, $em, $log);
                },
                'classificacaoTipoDocService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ClassificacaoTipoDocService($sm, $em, $log);
                },
                'tipoClassificacaoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoClassificacaoService($sm, $em, $log);
                },
                'arquivoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ArquivoService($sm, $em, $log);
                },
                'arquivoDocumentoService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ArquivoDocumentoService($sm, $em, $log);
                },
                'ofertaService' => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\OfertaService($sm, $em, $log);
                },
                PROCESSO_OFERTA_VAGA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ProcessoOfertaVagaService($sm, $em, $log);
                },
                OBSERVACAO_ANALISE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ObservacaoAnaliseService($sm, $em, $log);
                },
                HIST_INTEGRACAO_CAPES_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\HistIntegracaoCapesService($sm, $em, $log);
                },
                HIST_ETAPA_SITUACAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\HistEtapaSituacaoService($sm, $em, $log);
                },
                RECESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\RecessoService($sm, $em, $log);
                },
                TIPO_UNIDADE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoUnidadeService($sm, $em, $log);
                },
                UNIDADE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UnidadeService($sm, $em, $log);
                },
                DISTRIBUICAO_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\DistribuicaoProcessoService($sm, $em, $log);
                },
                COMISSAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ComissaoService($sm, $em, $log);
                },
                ARQUIVO_COMISSAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ArquivoComissaoService($sm, $em, $log);
                },
                COMISSAO_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ComissaoProcessoService($sm, $em, $log);
                },
                INTEGRANTE_EXTERNO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\IntegranteExternoService($sm, $em, $log);
                },
                INTEGRANTE_COMISSAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\IntegranteComissaoService($sm, $em, $log);
                },
                INT_EXT_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\IntExtProcessoService($sm, $em, $log);
                },
                ANALISE_SUBSTANTIVA_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AnaliseSubstantivaService($sm, $em, $log);
                },
                CONSELHO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ConselhoService($sm, $em, $log);
                },
                INTEGRANTE_CONSELHO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\IntegranteConselhoService($sm, $em, $log);
                },
                ARQUIVO_PARECER_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ArquivoParecerService($sm, $em, $log);
                },
                PARECER_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ParecerService($sm, $em, $log);
                },
                TIPO_ATIVIDADE_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoAtividadeService($sm, $em, $log);
                },
                ATIVIDADE_PARECER_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AtividadeParecerService($sm, $em, $log);
                },
                RELATOR_PROCESSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\RelatorProcessoService($sm, $em, $log);
                },
                USUARIO_EXCECAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\UsuarioExcecaoService($sm, $em, $log);
                },
                TIPO_EXCECAO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\TipoExcecaoService($sm, $em, $log);
                },
                PROCESSO_EXTERNO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ProcessoExternoService($sm, $em, $log);
                },
                RECURSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\RecursoService($sm, $em, $log);
                },
                ARQUIVO_RECURSO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\ArquivoRecursoService($sm, $em, $log);
                },
                CATEGORIA_FALE_CONOSCO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\CategoriaFaleConoscoService($sm, $em, $log);
                },
                ASSUNTO_FALE_CONOSCO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\AssuntoFaleConoscoService($sm, $em, $log);
                },
                FALE_CONOSCO_SERVICE => function ($sm) {
                    $em = $sm->get(Entitymanager::class);
                    $em->getConfiguration()->setQuoteStrategy(new QuoteStrategy());
                    $log = $sm->get(LOG_AUDIT);
                    return new Service\FaleConoscoService($sm, $em, $log);
                },
            ]
        ];
    }
    public function customRedirect($event, $route, $action = '', $statusCode = Response::STATUS_CODE_302)
    {
        $url = $event->getRouter()->assemble(array('action' => $action), array('name' => $route));

        $response = $event->getResponse();
        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode($statusCode);
        $response->sendHeaders();
        return;
    }

    public function loadConfiguration(MvcEvent $e)
    {
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        $sharedManager = $application->getEventManager()->getSharedManager();

        $router = $sm->get('router');
        $request = $sm->get('request');

        $matchedRoute = $router->match($request);
        if (null !== $matchedRoute) {

            $authService = $sm->get(AUTH_SERVICE);
            $config = $sm->get(CONFIG);

            $controllerPluginManager = $sm->get('ControllerPluginManager');
            $flashMessenger = $controllerPluginManager->get('FlashMessenger');

            $permissions = [];
            if ($authService->hasIdentity() && !empty($authService->getIdentity()->coUsuarioFuncao)) {

                $this->verifyReitorInvitation( $e, $authService, $matchedRoute );

                $permissions[] = $authService->getIdentity()->roles;
                $coUsuarioFuncao = $authService->getIdentity()->coUsuarioFuncao;
                $usuarioFuncPacFunService = $sm->get(USUARIO_FUNC_PAC_FUNC_SERVICE);

                $usuarioFuncaoFuncionalidades = $usuarioFuncPacFunService->findBy([
                    CO_USUARIO_FUNCAO => $coUsuarioFuncao
                ]);
                // Carrega as permissões privadas
                foreach ($usuarioFuncaoFuncionalidades as $usuFuncPacFunc) {
                    $coFuncionalidade = $usuFuncPacFunc->getCoFuncionalidadePacote()
                        ->getCoFuncionalidade()
                        ->getCoFuncionalidade();
                    $resourcesByFuncionalidade = $config['resource_private'][$coFuncionalidade];
                    foreach ($resourcesByFuncionalidade as $resource) {
                        $config['acl'][PERMISSOES] = array_merge([
                            $resource => [
                                $authService->getIdentity()->roles
                            ]
                        ], $config['acl'][PERMISSOES]);
                    }
                }
            } else {

                $controller = $e->getTarget();

                $namespace = $matchedRoute->getParam("__NAMESPACE__");

                if ($namespace) {
                    $noController = $namespace . '\\' . $matchedRoute->getParam('controller');
                } else {
                    $noController = $matchedRoute->getParam('controller');
                }
                $resource = strtolower($noController . '\\' . $matchedRoute->getParam(ACTION));

                if (!in_array($resource, array_keys($config['acl'][PERMISSOES]))) {

                    if ($controller->getRequest()->isXmlHttpRequest()) {

                        //verificação nas configurações anonimas
                        $authService->clearIdentity();
                        $flashMessenger->addErrorMessage(MensagemUtil::getMensagem(MSG076));
                        $controller->getResponse()->setStatusCode(Response::STATUS_CODE_401);
                        return;

                    } else {

                        if( $authService->hasIdentity() && empty($authService->getIdentity()->coUsuarioFuncao) ){
                            $flashMessenger->addErrorMessage(MensagemUtil::getMensagem(MSG083));
                        } else {
                            $flashMessenger->addErrorMessage(MensagemUtil::getMensagem(MSG076));
                        }

                        return $this->customRedirect(
                            $e,
                            'acesso',
                            '',
                            Response::STATUS_CODE_302
                        );

                    }

                }

            }

            $permissions[] = 'anonimo';

            $sharedManager->attach(
                'Zend\Mvc\Controller\AbstractActionController',
                'dispatch',
                function ($e) use ($sm, $permissions, $authService, $config) {

                    $controller = $e->getTarget();
                    $route = $controller->getEvent()
                        ->getRouteMatch()
                        ->getParams();
                    $resource = strtolower($route['controller'] . '\\' . $route[ACTION]);

                    if (!in_array($resource, array_keys($config['acl'][PERMISSOES]))) {

                        if ($controller->getRequest()->isXmlHttpRequest()) {

                            $controllerPluginManager = $sm->get('ControllerPluginManager');
                            $flashMessenger = $controllerPluginManager->get('FlashMessenger');
                            $flashMessenger->addErrorMessage(MensagemUtil::getMensagem(MSG083));

                            $response = $e->getResponse();
                            $response->setStatusCode(Response::STATUS_CODE_302);
                            return $response;
                        }

                        $url = $e->getRouter()
                            ->assemble([], [
                                'name' => 'home'
                            ]);
                        $response = $e->getResponse();
                        $response->getHeaders()
                            ->addHeaderLine('Location', $url);
                        $response->setStatusCode(Response::STATUS_CODE_302);
                        $response->sendHeaders();
                        $stopCallBack = function ($event) use ($response) {
                            $event->stopPropagation();
                            return $response;
                        };
                        $e->getApplication()
                            ->getEventManager()
                            ->attach(MvcEvent::EVENT_ROUTE, $stopCallBack, -10000);
                        return $response;
                    }

                    $sm->get('ControllerPluginManager')
                        ->get('AclPlugin')
                        ->loadAcl($config['acl'], $permissions)
                        ->doAuthorization($e, $permissions, $authService);
                },
                2
            );

            $sharedManager->attach(
                'Zend\Mvc\Controller\AbstractActionController',
                'dispatch',
                function () use ($permissions, $config) {
                    $session = new Container('Menu');
                    $menu_permissoes = [];
                    foreach ($config['acl'][PERMISSOES] as $resource => $roles) {
                        $possuiAcesso = (count(array_intersect($roles, $permissions)) > 0);
                        $existeMenu = isset($config['menu'][$resource]);
                        if ($possuiAcesso && $existeMenu) {
                            $menu_permissoes[] = $resource;
                        }
                    }

                    $menu_local = $config['menu'];
                    $menu = [];
                    foreach ($menu_local as $resource_i => $dados_resource) {
                        if (in_array($resource_i, $menu_permissoes)) {
                            $menu[$config['menu'][$resource_i]['modulo']]
                            [$config['menu'][$resource_i]['tela']] = $config['menu'][$resource_i]['url'];
                        }
                    }
                    $session->menu = $menu;
                },
                2
            );
        }
    }
    /**
     * Recupera código do usuário da sessão
     * Modify the configuration; here, we'll remove a specific key
     * Pass the changed configuration back to the listener
     *
     * @param ModuleEvent $e
     */
    public function onMergeConfig(ModuleEvent $e)
    {
        $auth = new AuthenticationService();

        $coUsuario = null;
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $coUsuario = $identity->coUsuario;
        }

        $remote = new RemoteAddress();
        $ip = $remote->getIpAddress();

        $configListener = $e->getConfigListener();
        $config = $configListener->getMergedConfig(false);
        $config[USER_IDENTIFY]['co_usuario'] = $coUsuario;
        $config[USER_IDENTIFY]['ip_usuario'] = $ip;
        $configListener->setMergedConfig($config);
    }

    public function getFormElementConfig()
    {
        return [
            FACTORIES => [
                'ContatoForm' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $em = $locator->get('doctrine.entitymanager.orm_default');
                    return new ContatoForm($em);
                }
            ]
        ];
    }

}
