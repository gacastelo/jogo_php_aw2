<?php

class Consumivel extends AbsItem
{
    private string $efeito;

    public function __construct($id, $nome, $descricao, $efeito)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->efeito = $efeito;
    }

    public function getEfeito(): string
    {
        return $this->efeito;
    }
}