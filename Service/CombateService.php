<?php

class CombateService
{
    private function getTabelaLv1(): array
    {
        return [
            new Inimigo("Goblin", 50, 2, 5, 5, [], ""),
            new Inimigo("Goblin", 50, 2, 5, 5, [], "")
        ];
    }
    private function getTabelaLv2(): array
    {
        return [
            new Inimigo("Goblin", 50, 2, 5, 5, [], ""),
            new Inimigo("Goblin", 50, 2, 5, 5, [], "")
        ];
    }
    private function getTabelaLv3(): array
    {
        return [
            new Inimigo("Goblin", 50, 2, 5, 5, [], ""),
            new Inimigo("Goblin", 50, 2, 5, 5, [], "")
        ];
    }

    public function gerarInimigo(string $level = "1"): \Inimigo
    {
        if ($level != "1" || $level != "2" || $level != "3") {
            $level = strval(rand(1,3));
        }

        $get = "getTabelaLv". $level;
        $table = $this->$get();
        return $table[array_rand($table)];
    }

    public function initCombate(string $level): void
    {
        $inimigo = $this->gerarInimigo($level);

        session_start();
        $_SESSION["inimigo"] = $inimigo;
        header("Location: ../public/combate.php");
        exit();
    }

    public function check_resultado(): void
    {
        session_start();
        if ($_SESSION["inimigo"]->is_dead()) {
            $loot = $_SESSION["inimigo"]->get_loot();
            foreach ($loot as $item) {
                $_SESSION["player"]->guardarItem($item);
            }
            //TODO: Proxima tela(mapa principal)
        }
        if ($_SESSION["player"]->is_dead()) {
            $this->telaDerrota();
        }
    }

    public function telaDerrota(): void
    {
        header("location: ../public/derrota.php");
        exit();
    }
}