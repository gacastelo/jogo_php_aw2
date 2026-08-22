<?php

class Dados
{
    public function rolarDados(): int
    {
        return rand(1, 20);
    }

    public function testeCD($CD, $modificador = 0): bool
    {
        $resultado = $this->rolarDados() + $modificador;
        return $resultado >= $CD;
    }
}