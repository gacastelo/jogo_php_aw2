<?php
class AbsItem
{
    protected string $id;
    protected string $nome;
    protected string $descricao;
    protected string $tipo;

    public function getAtribute($atribute): mixed
    {
        return $this->$atribute;
    }
    public function setAtribute($atribute, $value): void
    {
        $this->$atribute = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTipo() : string
    {
        return $this->tipo;
    }

    public function getAtributes(): array
    {
        return get_object_vars($this);
    }
}