<?php

namespace ValidationCPF\Validate;

use Illuminate\Container\Container;

/**
 * Class CpfValidation
 * @package ValidationCPF\Validate
 */
class CpfValidation
{
    /**
     * @var mixed
     */
    private $app;

    /**
     * @var
     */
    private $value;

    /**
     * CpfValidation constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->app = $this->app();
        $this->value =  $value;
    }

    /**
     * @return mixed
     */
    private function app()
    {
        return Container::getInstance()->make('config');
    }

    /**
     * @param $digits
     * @param int $positions
     * @param int $sumDigits
     *
     * @return string
     */
    private function calculateDigitsPositions($digits, $positions = 10, $sumDigits = 0)
    {
        for ($i = 0; $i < strlen($digits); $i++) {
            $sumDigits = $sumDigits + ($digits[$i] * $positions);
            $positions--;
            if ($positions < 2) {
                $positions = 9;
            }
        }
        $sumDigits = $sumDigits % 11;

        if ($sumDigits < 2) {
            $sumDigits = 0;
        } else {
            $sumDigits = 11 - $sumDigits;
        }
        $cpf = $digits . $sumDigits;
        return $cpf;
    }

    /**
     * @param $value
     * @return bool
     */
    private function checkEquals($value)
    {
        $caracter = str_split($value);
        $allEquals = true;
        $lastVal = $caracter[0];
        foreach ($caracter as $val) {
            if ($lastVal != $val) {
                $allEquals = false;
            }
            $lastVal = $val;
        }
        return $allEquals;
    }

    /**
     * @param $value
     * @return mixed
     */
    private function removeCaracter($value){
        return str_replace(['.', '-'], '', $value);
    }

    /**
     * @return bool
     */
    public function validateCpf()
    {
        $value = $this->removeCaracter($this->value);
        $digits = substr($value, 0, 9);
        $newCpf = $this->calculateDigitsPositions($digits);
        $newCpf = $this->calculateDigitsPositions($newCpf, 11);

        if ($this->checkEquals($value)) {
            return false;
        }

        if ($newCpf === $value) {
            return true;
        }
        return false;
    }

}
