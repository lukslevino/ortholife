<?php
/**
 * Created by PhpStorm.
 * User: lazevedol
 * Date: 20/11/2017
 * Time: 23:42
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public function solicitarAcessoAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;

    }
}