<?php
class AbsItem
{
    protected int $id;
    protected string $nome;
    protected string $descricao;

    public function getAtribute($atribute): mixed
    {
        return $this->$atribute;
    }
    public function setAtribute($atribute, $value): void
    {
        $this->$atribute = $value;
    }

    public function getAtributes(): array
    {
        return get_object_vars($this);
    }
}