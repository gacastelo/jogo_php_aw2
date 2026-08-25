<?php

require_once "../AbsModel/AbsItem.php";
require_once "../Model/Itens/Consumivel.php";
class ConsumivelService
{
    private function getTabelaLv1(): array
    {
        return [
            new Consumivel("Poçao de Cura Mínima", "Cura 10 de vida", "heal(10)"),
            new Consumivel("Poçao de Cura Menor", "Cura 25 de vida", "heal(25)")
        ];
    }
    private function getTabelaLv2(): array
    {
        return [
            new Consumivel("Poçao de Cura", "Cura 35 de vida", "heal(35)"),
            new Consumivel("Poçao de Cura Maior", "Cura 50 de vida", "heal(50)")
        ];
    }
    private function getTabelaLv3(): array
    {
        return [
            new Consumivel("Poçao de Cura Superior", "Cura 75 de vida", "heal(75)"),
            new Consumivel("Poçao de Cura Suprema", "Cura 100 de vida", "heal(100)")
        ];
    }

    public function gerarConsumivel(string $level): \Consumivel
    {
        if ($level != "1" || $level != "2" || $level != "3") {
            $level = strval(rand(1,3));
        }

        $get = "getTabelaLv". $level;
        $table = $this->$get();
        return $table[array_rand($table)];
    }
}