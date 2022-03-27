<?php
namespace Controller;

use \Enum\EnumSistema;
use \View\ViewConsulta;
use \Model\ModelProduto;

/**
 * Controller cosulta do sistema
 */
class ControllerConsulta
{
    
    /**
     * Monta a consulta
     */
    public function montaConsulta()
    {
        echo new ViewConsulta($this);
    }
    
    /**
     * Monta a inclusão
     */
    public function montaTelaInclusao()
    {
        
    }
    
    /**
     * Monta a alteração
     */
    public function montaTelaAlteracao()
    {
        
    }
    
    /**
     * Retorna os registros do sistema.
     * @return Array
     */
    public function getRegistros()
    {
        return ModelProduto::getRegistros();
    }
    
}