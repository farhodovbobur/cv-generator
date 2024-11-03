<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class SkillDTO extends DataTransferObject
{
    public int    $id;
    public string $name;

    public function __serialize(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id         = $data['id'];
        $this->name       = $data['name'];
    }
}