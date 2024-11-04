<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class LevelDTO extends DataTransferObject
{
    public int    $id;
    public string $level;

    public function __serialize(): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->level
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id    = $data['id'];
        $this->level = $data['level'];
    }
}