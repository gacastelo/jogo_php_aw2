<?php

class Player extends AbsEntity
{
    private array $equipamento = ["cabeca" => null, "peitoral" => null, "botas" => null, "mao_principal" => null, "mao_secundaria" => null];
    private array $inventario = [];

    public function __construct(string $nome, string $link_imagem)
    {
        $this->nome = $nome;
        $this->vida_maxima = 100;
        $this->vida_atual = $this->vida_maxima;
        $this->velocidade = 0;
        $this->dano = 5;
        $this->chance_esquiva = 0;
        $this->link_imagem = $link_imagem;
    }


    public function guardarItem($item): void
    {
        $this->inventario[] = $item;
    }

    public function useItem($item): void
    {
        if ($item instanceof \Equipamento) {
            $this->equip($item);
        }
        if ($item instanceof \Consumivel) {
            $this->consume($item);
        }
    }

    public function equip(Equipamento $equip): void
    {
        $tipo = $equip->getAtribute("tipo");
        $equip->toggleEquipped();
        if (!isset($this->equipamento[$tipo])) {
            $this->equipamento[$tipo] = $equip;
        } else {
            $replace = $this->equipamento[$tipo];
            $this->equipamento[$tipo] = $equip;
            $replace->toggleEquipped();
            $this->guardarItem($replace);
        }
    }

    public function getEquipamento(): array
    {
        return $this->equipamento;
    }

    public function getInventario(): array
    {
        return $this->inventario;
    }

    public function heal(int $amount): void
    {
        if ($this->vida_atual + $amount > $this->vida_maxima) {
            $this->vida_atual = $this->vida_maxima;
        }
        else {
            $this->vida_atual += $amount;
        }
    }

    public function consume(Consumivel $consumivel): void
    {
        $efeito = $consumivel->getEfeito();
        $this->$efeito;
    }
}