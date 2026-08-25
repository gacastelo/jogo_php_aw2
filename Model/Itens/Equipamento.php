<?php
class Equipamento extends AbsItem
{
    private int $vida_max_modifier;
    private int $velocidade_modifier;
    private int $dano_modifier;
    private bool $is_equipped;

    public function __construct($id, $nome, $tipo, $descricao, $vida_max_modifier, $velocidade_modifier, $dano_modifier ,$is_equipped)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->vida_max_modifier = $vida_max_modifier;
        $this->velocidade_modifier = $velocidade_modifier;
        $this->dano_modifier = $dano_modifier;
        $this->is_equipped = $is_equipped;
    }

    public function getStats(): array
    {
        return ["vida_max" => $this->vida_max_modifier, "velocidade" => $this->velocidade_modifier, "dano" => $this->dano_modifier];
    }

    public function toggleEquipped(): void
    {
        $this->is_equipped = !$this->is_equipped;
    }
}