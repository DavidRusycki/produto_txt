<?php
namespace Controller;

use \Enum\EnumSistema;
use \Enum\EnumAcoes;
use \Exception;

/**
 * Controller Base do sistema
 */
class ControllerBase
{
    
    /*
     * Retorna uma instância da classe.
     */
    public static function getInstance() : self
    {
        return new self();
    }
    
    /**
     * Inicia o sistema.
     * @return void
     */
    public static function init() : void
    {
        $oController = self::getInstance();
        $oController->processaDados();
    }
    
    /**
     * Processa os dados da requisição
     * @return bool
     */
    public function processaDados() : bool
    {
        $this->validaParametros();
        return true;
    }
    
    /**
     * Valida os parametros da requisição.
     */
    public function validaParametros() 
    {
        if ($this->validaAcao()) 
        {
            $this->callController();
        }
    }
    
    /**
     * Chama o controller para a requisição de acordo com os parametros.
     */
    private function callController()
    {
        if ($this->getMetodo() == EnumSistema::MONTA_TELA) {
            switch ($this->getAcao()) {
            case \Enum\EnumAcoes::ACAO_ALTERAR:
                $this->getControllerManutencao()->montaTelaAlteracao();
                break;
            case \Enum\EnumAcoes::ACAO_INCLUIR:
                $this->getControllerManutencao()->montaTelaInclusao();
                break;
            
            default:
                $this->getControllerConsulta()->montaConsulta();
                break;
            }
        }
        else if ($this->getMetodo() == EnumSistema::PROCESSA_DADOS)
        {
            switch ($this->getAcao()) {

            case \Enum\EnumAcoes::ACAO_ALTERAR:
                $this->getControllerManutencao()->processaAlteracao();
                break;
            case \Enum\EnumAcoes::ACAO_INCLUIR:
                $this->getControllerManutencao()->processaInclusao();
                break;
            case \Enum\EnumAcoes::ACAO_EXCLUIR:
                $this->getControllerManutencao()->processaExclusao();
                break;
            }
            
            $this->getControllerConsulta()->montaConsulta();
        }
    }
    
    /**
     * @return \Controller\ControllerConsulta
     */
    private function getControllerConsulta() 
    {
        return new \Controller\ControllerConsulta();
    }
    
    /**
     * @return \Controller\ControllerManutencao
     */
    private function getControllerManutencao() 
    {
        return new \Controller\ControllerManutencao();
    }
    
    /**
     * Valida se existe ação para executar.
     * @throws Exception
     */
    private function validaAcao()
    {
        if (!isset($_GET[EnumSistema::ACAO])) 
        {
            $_GET[EnumSistema::ACAO] = \Enum\EnumAcoes::ACAO_CONSULTAR;
        }
        if (!in_array($this->getAcao(), EnumAcoes::getAcoes()))
        {
            throw new Exception('A ação informada não existe');
        }
        if ($this->getAcao() == EnumAcoes::ACAO_ALTERAR) {
            if (!isset($_GET[EnumSistema::ID])) 
            {
                throw new Exception('Necessário um ID informado');
            }
        }
        return true;
    }
    
    /**
     * Retorna a ação.
     * @return int
     */
    private function getAcao() : int
    {
        return filter_var($_GET[EnumSistema::ACAO], FILTER_SANITIZE_NUMBER_INT);
    }
    
    /**
     * Retorna o método da requisição.
     * @return int
     */
    private function getMetodo() : int
    {
        $iMetodo = EnumSistema::MONTA_TELA;
        if (isset($_GET[EnumSistema::METODO])) {
            $iMetodo = filter_var($_GET[EnumSistema::METODO], FILTER_SANITIZE_NUMBER_INT);
        }
        return $iMetodo;
    }
    
}