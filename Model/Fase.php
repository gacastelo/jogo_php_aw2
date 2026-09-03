<?php

class Fase
{
    public int $id;
    public string $nome;
    public int $x;
    public int $y;
    public array $conexoes;
    public bool $bloqueada;

    public function __construct(int $id, string $nome, int $x, int $y,array $conexoes, bool $bloqueada = true)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->x = $x;
        $this->y = $y;
        $this->conexoes = $conexoes;
        $this->bloqueada = $bloqueada;
    }

    public function unlock():void
    {
        $this->bloqueada = false;
    }

    public function getConexoes(): array
    {
        return $this->conexoes;
    }
}