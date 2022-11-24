<?php

namespace Domain\Dto;

class CriarContatoDto
{
    private string $email;
    private string $celular;

    private function __construct()
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCelular(): string
    {
        return $this->celular;
    }

    public static function fromArray(array $array): self
    {
        $instance          = new self();
        $instance->email   = $array['email'];
        $instance->celular = $array['celular'];

        return $instance;
    }
}
