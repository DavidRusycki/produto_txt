<?php
namespace Enum;

/**
 * Enum de ações do sistema
 */
class EnumAcoes
{
    
    const ACAO_CONSULTAR = 1;
    const ACAO_ALTERAR = 2;
    const ACAO_INCLUIR = 3;
    const ACAO_EXCLUIR = 4;
    
    /**
     * Retorna um array com as Ações do sistema.
     * @return type
     */
    public static function getAcoes()
    {
        $o = new \ReflectionClass(new self);
        return $o->getConstants();
    }
    
}
