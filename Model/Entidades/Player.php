<?php
require "../AbsModel/AbsEntity.php";
require "../Model/Itens/Consumivel.php";
class Player extends AbsEntity
{
    private array $equipamento = ["cabeca" => null, "peitoral" => null, "botas" => null, "mao_principal" => null, "mao_secundaria" => null];
    private array $inventario = [];

    private array $buffs = ["dano" => ["value" => 0, "duration" => 0], "velocidade" => ["value" => 0, "duration" => 0], "chance_esquiva" => ["value" => 0, "duration" => 0]];

    public function __construct(string $nome = "Héroi", string $link_imagem = "./img/default_hero.gif")
    {
        $this->nome = $nome;
        $this->vida_maxima = 100;
        $this->vida_atual = $this->vida_maxima;
        $this->velocidade = 0;
        $this->dano = 5;
        $this->chance_esquiva = 0;
        $this->link_imagem = $link_imagem;
        $this->guardarItem(new Consumivel("Poçao de Cura Mínima", "Cura 10 de vida", ["metodo" => "heal", "args" => [10]]));
    }

    public function guardarItem($item): void
    {
        $this->inventario[$item->getId()] = $item;
    }

    public function useItem($itemId): void
    {
        $item = $this->inventario[$itemId];
        if ($item instanceof \Equipamento) {
            $this->equip($item);
        }
        if ($item instanceof \Consumivel) {
            $this->consume($item->getId());
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
        public function buff(string $type,int $value, int $duration): void
        {
            $this->buffs[$type] = ["value" => $value, "duration" => $duration];
        }

    public function getBuffs(): array
    {
        return $this->buffs;
    }

    public function decreaseBuffDuration(): void
    {
        foreach ($this->buffs as $type => &$buff) {
            if ($buff["duration"] > 0) {
                $buff["duration"]--;
            }

            if ($buff["duration"] === 0) {
                $buff["value"] = 0;
            }
        }

        unset($buff);
    }

    public function decreaseAttacksCooldown(): void
    {
    //TODO: if make differents attacks make they cooldown here
    }

    public function consume(string $id): void
    {
        $consumivel = $this->inventario[$id];
        $efeito = $consumivel->getEfeito();
        $metodo = $efeito['metodo'];
        $args = $efeito['args'];
        $this->$metodo(...$args);
        unset($this->inventario[$id]);
        header("Location: combate.php");
        exit();
    }
}