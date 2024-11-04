<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class LanguageDTO extends DataTransferObject
{
    public int    $id;
    public string $language;

    public function __serialize(): array
    {
        return [
            'id'       => $this->id,
            'language' => $this->language
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id       = $data['id'];
        $this->language = $data['language'];
    }
}