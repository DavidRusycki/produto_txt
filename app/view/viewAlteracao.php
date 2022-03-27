<?php
namespace View; 

class ViewAlteracao
{
    private $Model;
    
    public function __construct($oModel) {
        $this->setModel($oModel);
    }
    
    /**
     * Retorna a string da tela.
     * @return string
     */
    public function __toString() {
        
        $sString = '
            
            <!DOCTYPE html> 
            <html lang="pt-BR"> 
            <head> 
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Produtos</title> 
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link rel="stylesheet" href="http://localhost/template_html_php/sistem/style/style.css">    <script src="https://kit.fontawesome.com/49a857d31a.js" crossorigin="anonymous"></script>   </head> 
            <body> 

            <img id="loading" class="fixed-top" style="display:none;margin:auto;margin-top:21%;width:2%" src="http://localhost/produto_txt/app/view/loading.gif">
            <script>
                
                function loading() {
                    document.getElementById(\'loading\').style.setProperty(\'display\', \'inherit\');
                }

            </script>

                <h1 class="mt-5 titulo_principal">Alteração de Produto</h1> 

                <div class="container mt-5">

                <form action="?'.\Enum\EnumSistema::ACAO.'='.\Enum\EnumAcoes::ACAO_ALTERAR.'&'.\Enum\EnumSistema::METODO.'='.\Enum\EnumSistema::PROCESSA_DADOS.'&'.\Enum\EnumSistema::ID.'='.$this->getModel()->getCodigo().'" METHOD="POST">
                    
                    <div class="container col-6">

                    <input type="text" class="form-control" style="display:none" name="codigo" placeholder="Codigo" value="'.$this->getModel()->getCodigo().'">
                    <input type="text" class="form-control" name="nome" placeholder="Nome" value="'.$this->getModel()->getNome().'">
                    <br>
                    <input type="text" class="form-control" name="valor" placeholder="Valor" value="'.$this->getModel()->getValor().'">
                    <br>
                    <input type="number" class="form-control" name="estoque" placeholder="Estoque" value="'.$this->getModel()->getQuantidadeEstoque().'">
                    <br>

                    <button onClick="loading()" type="submit" class="btn btn-success">Alterar</button>
                    <a onClick="loading()" href="http://localhost/produto_txt/?'.\Enum\EnumSistema::ACAO.'='.\Enum\EnumAcoes::ACAO_CONSULTAR.'&'.\Enum\EnumSistema::METODO.'='.\Enum\EnumSistema::MONTA_TELA.'" class="btn btn-danger">Voltar</button>

                    <div>

                </form>
                
                </div>

            </body> 
            </html> 
            
        ';
        
        return $sString;
    }
    
    public function getModel() 
    {
        return $this->Model;
    }

    public function setModel($Model): self 
    {
        $this->Model = $Model;
        
        return $this;
    }
    
}