<?php
namespace Model;

/**
 * Modelo de produto.
 */
class ModelProduto
{
    
    private $codigo;
    private $nome;
    private $valor;
    private $quantidadeEstoque;
    
    /**
     * Retorna o modelo de acordo com o código
     * Caso não tenha nenhum produto com esse código retorna FALSE
     * Caso tenha produto com esse código retorna o modelo
     * @param type $iCodigo
     * @return self
     */
    public static function getModelFromCodigo($iCodigo) : self
    {
        $aProdutos = self::getRegistros();
        
        if (!isset($aProdutos[$iCodigo])) {
            $oModel = false;
        }
        else {
            $oModel = new self();
            $oModel->setCodigo($aProdutos[$iCodigo]['codigo']);        
            $oModel->setNome($aProdutos[$iCodigo]['nome']);        
            $oModel->setValor($aProdutos[$iCodigo]['valor']);        
            $oModel->setQuantidadeEstoque($aProdutos[$iCodigo]['quantidadeEstoque']);        
        }
        
        return $oModel;
    }
    
    /**
     * Salva os dados na dataBase
     * @param type $aProduto
     * @return type
     */
    public static function write($aProduto)
    {
        $sData = json_encode($aProduto);
        return (bool) file_put_contents(__DIR__.'/../../database.txt', $sData);
    }
    
    /**
     * Retorna um array com os Produtos em forma de modelo.
     * @param Array $aProduto
     * @return \Self
     */
    public static function getModelList(array $aProduto) : array
    {
        $aProdutos = [];
        foreach($aProduto as $aItem) 
        {
            $oNewModel = new Self();
            
            $oNewModel->setCodigo($aItem['codigo']);
            $oNewModel->setNome($aItem['nome']);
            $oNewModel->setValor($aItem['valor']);
            $oNewModel->setQuantidadeEstoque($aItem['quantidadeEstoque']);
            
            $aProdutos[] = $oNewModel;
        }
        
        return $aProdutos;
    }
    
    /**
     * Retorna o modelo com as informações do post
     * @return \Self
     */
    public static function getModelFromPost()
    {
        if (!isset($_POST['nome']) && !isset($_POST['valor']) && !isset($_POST['estoque'])) 
        {
            throw new \Exception('Não possui informações');
        }
        
        $oModel = new Self();
        
        if (isset($_POST['codigo'])) 
        {
            $oModel->setCodigo($_POST['codigo']);
        }
        
        $oModel->setNome($_POST['nome']);
        $oModel->setValor($_POST['valor']);
        $oModel->setQuantidadeEstoque($_POST['estoque']);
        
        return $oModel;
    }
    
    /**
     * Retorna os registros da Database
     * @return Array
     */
    public static function getRegistros() : array
    {
        $aData = json_decode(file_get_contents(__DIR__.'/../../database.txt'), true);
        return $aData;
    }
    
    /**
     * Retorna o maior código do array.
     * @param array $aRegistros
     * @return int
     */
    public static function getMaiorCodigo($aRegistros) : int
    {
        $iMaior = null;
        foreach($aRegistros as $sIndice => $aProduto)
        {
            if (is_null($iMaior) || $iMaior < (int) $sIndice)
            {
                $iMaior = (int) $sIndice;
            }
        }
        
        return $iMaior;
    }
    
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo): self
    {
        $this->codigo = $codigo;
        
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome): self
    {
        $this->nome = $nome;
        
        return $this;
    }
    
    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor): self
    {
        $this->valor = $valor;
        
        return $this;
    }

    public function getQuantidadeEstoque()
    {
        return $this->quantidadeEstoque;
    }

    public function setQuantidadeEstoque($quantidadeEstoque): self
    {
        $this->quantidadeEstoque = $quantidadeEstoque;
        
        return $this;
    }
    
}