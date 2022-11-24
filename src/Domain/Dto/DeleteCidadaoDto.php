<?php

namespace Domain\Dto;

class DeleteCidadaoDto
{
    private function __construct(
        private int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function fromArray(array $params): static
    {
        return new static(
            id: $params['id']
        );
    }
}
