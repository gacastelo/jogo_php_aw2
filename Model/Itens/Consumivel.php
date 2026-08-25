<?php
class Consumivel extends AbsItem
{
    private string $efeito;

    public function __construct($nome, $descricao, $efeito)
    {
        $this->id = uniqid("con");
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->efeito = $efeito;
        $this->tipo = "Consumivel";
    }

    public function getEfeito(): string
    {
        return $this->efeito;
    }

    public function getHtml(): string
    {
        return "
        <tr>
            <td>".$this->nome."</td>
            <td>".$this->descricao."</td>
            <td><a href='?item=".$this->id."'>Usar</a></td>
        </tr>
        ";
    }
}