<?php
namespace Controller;

use \Enum\EnumSistema;
use \View\ViewInclusao;

/**
 * Controller manutencao do sistema.
 */
class ControllerManutencao
{
    
    /**
     * Monta a tela de inclusão de registros
     */
    public function montaTelaInclusao()
    {
        echo new ViewInclusao();
    }
    
    /**
     * Monta a tela de inclusão de registros
     */
    public function montaTelaAlteracao()
    {
        $oModel = \Model\ModelProduto::getModelFromCodigo($_GET['id']);
        if (!$oModel) {
            throw new Exception('Não existe produto com o código solicitado.');
        };
        
        echo new \View\ViewAlteracao($oModel);
    }
 
    /**
     * Processa a exclusao do registro
     */
    public function processaExclusao() 
    {
        if (!isset($_GET['id'])) {
            throw new \Exception('Não existe produto com o código solicitado.');
        };
        $oModel = \Model\ModelProduto::getModelFromCodigo($_GET['id']);
        
        $aProdutos = \Model\ModelProduto::getRegistros();
        unset($aProdutos[$oModel->getCodigo()]);
        
        return \Model\ModelProduto::write($aProdutos);
    }
    
    /**
     * Processa a inclusão do registro
     */
    public function processaInclusao() : bool
    {
        $aProdutos = \Model\ModelProduto::getRegistros();
        $oModel = \Model\ModelProduto::getModelFromPost();
        $iCodigo = \Model\ModelProduto::getMaiorCodigo($aProdutos);
        
        $oModel->setCodigo(++$iCodigo);
        
        $aProdutos[$oModel->getCodigo()] = [
            'codigo'=> $oModel->getCodigo()
            ,'nome'=> $oModel->getNome()
            ,'valor'=> $oModel->getValor()
            ,'quantidadeEstoque'=> $oModel->getQuantidadeEstoque()
        ];
        
        return \Model\ModelProduto::write($aProdutos);
    }
    
    /**
     * Processa a alteração
     */
    public function processaAlteracao() 
    {
        $oModel = \Model\ModelProduto::getModelFromPost();
        
        $aProdutos = \Model\ModelProduto::getRegistros();
        
        $aProdutos[$oModel->getCodigo()]['nome'] = $oModel->getNome();
        $aProdutos[$oModel->getCodigo()]['valor'] = $oModel->getValor();
        $aProdutos[$oModel->getCodigo()]['quantidadeEstoque'] = $oModel->getQuantidadeEstoque();
        
        return \Model\ModelProduto::write($aProdutos);
    }
    
}