<?php

namespace Infrastructure\Utils;

class Validacao
{
    public static function cpf(mixed $params): bool
    {
        $cpf = preg_replace('/[^0-9]/', "", $params);

        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            return false;
        }

        $sum                = 0;
        $numberMultiplicate = 10;

        for ($index = 0; $index < 9; $index++) {
            $sum += $cpf[$index] * ($numberMultiplicate--);
        }

        $result = ($sum * 10) % 11;

        $numberQuantityToLoop = [9, 10];

        foreach ($numberQuantityToLoop as $item) {
            $sum                = 0;
            $numberMultiplicate = $item + 1;

            for ($index = 0; $index < $item; $index++) {
                $sum += $cpf[$index] * ($numberMultiplicate--);
            }

            $result = ($sum * 10) % 11;
        }

        if ($cpf[$item] != $result) {
            return false;
        }
        return true;
    }
}
