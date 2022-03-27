<?php
namespace View; 

class ViewConsulta
{
    
    private \Controller\ControllerConsulta $Controller;
    
    public function __construct($oController) {
        $this->setController($oController);
    }
    
    public function __toString() {
        $sHtml = '';
        $sHtml .= $this->getHtml();
        return $sHtml;
    }
    
    /**
     * Retorna o HTML da view.
     * @return string
     */
    private function getHtml() 
    {
        $sHtml = '

            <!DOCTYPE html> 
            <html lang="pt-BR"> 
            <head> 
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Produtos</title> 
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link rel="stylesheet" href="http://localhost/template_html_php/sistem/style/style.css">    <script src="https://kit.fontawesome.com/49a857d31a.js" crossorigin="anonymous"></script>   </head> 
            <body> 

            <h1 class="titulo_principal mt-5">Consulta de Produtos</h1> 
            
        ';
        
        $sHtml .= $this->getTabela();

        $sHtml .= '
            </body>
            </html>
        ';
        
        return $sHtml;
    }
    
    /**
     * Retorna o html da tabela.
     * @return string
     */
    private function getTabela() 
    {
        $sTable = '<table class="table table-hover table-sm w-75 p-3 mx-auto">';
        
        $sTable .='
            <div class="w-75 mx-auto">
              <a class="btn btn-success btn-sm mb-2" href="http://localhost/produto_txt/?'.\Enum\EnumSistema::ACAO.'='.\Enum\EnumAcoes::ACAO_INCLUIR.'&'.\Enum\EnumSistema::METODO.'='.\Enum\EnumSistema::MONTA_TELA.'" >Incluir</a>
            </div>
        ';
        
        $aRegistros = $this->getController()->getRegistros();
        
        $aProduto = \Model\ModelProduto::getModelList($aRegistros);
        
        $sTable .= '<tbody>';
        
        $this->addTableHeader($sTable);
        
        foreach($aProduto as $oRegistro) {
            $sTable .= '<tr>';
            
            $sTable .= '<td>';
            $sTable .= $oRegistro->getCodigo();
            $sTable .= '</td>';
            $sTable .= '<td>';
            $sTable .= $oRegistro->getNome();
            $sTable .= '</td>';
            $sTable .= '<td>';
            $sTable .= $oRegistro->getValor();
            $sTable .= '</td>';
            $sTable .= '<td>';
            $sTable .= $oRegistro->getQuantidadeEstoque();
            $sTable .= '</td>';
            $sTable .= '<td>
                            <a class="btn btn-danger btn-sm" href="http://localhost/produto_txt/?'.\Enum\EnumSistema::ACAO.'='.\Enum\EnumAcoes::ACAO_ALTERAR.'&'.\Enum\EnumSistema::METODO.'='.\Enum\EnumSistema::MONTA_TELA.'&id='.$oRegistro->getCodigo().'" >
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a class="botao_excluir btn btn-success btn-sm" href="http://localhost/produto_txt/?'.\Enum\EnumSistema::ACAO.'='.\Enum\EnumAcoes::ACAO_EXCLUIR.'&'.\Enum\EnumSistema::METODO.'='.\Enum\EnumSistema::PROCESSA_DADOS.'&id='.$oRegistro->getCodigo().'" >
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>';
            
            $sTable .= '</tr>';
        }
        
        $sTable .= '</tbody>';
        $sTable .= '</table>';
        return $sTable;
    }
    
    /**
     * Adiciona o cabeçalho da tabela.
     * @param String $sTable
     */
    private function addTableHeader(& $sTable) : void
    {
        
        $sTable .= '<tr>';
            
        $sTable .= '<td>';
        $sTable .= 'Código';
        $sTable .= '</td>';
        $sTable .= '<td>';
        $sTable .= 'Nome';
        $sTable .= '</td>';
        $sTable .= '<td>';
        $sTable .= 'Valor';
        $sTable .= '</td>';
        $sTable .= '<td>';
        $sTable .= 'Estoque';
        $sTable .= '</td>';
        $sTable .= '<td>';
        $sTable .= 'Ações';
        $sTable .= '</td>';

        $sTable .= '</tr>';
    }
    
    public function getController(): \Controller\ControllerConsulta 
    {
        return $this->Controller;
    }

    public function setController(\Controller\ControllerConsulta $Controller): self 
    {
        $this->Controller = $Controller;
        
        return $this;
    }
    
}