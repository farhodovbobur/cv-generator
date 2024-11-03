<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class SocialNetworkDTO extends DataTransferObject
{
    public int    $id;
    public string $name;
    public string $url;
    public string $created_at;

    public function __serialize(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'url'        => $this->url,
            'created_at' => $this->created_at,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id         = $data['id'];
        $this->name       = $data['name'];
        $this->url        = $data['url'];
        $this->created_at = $data['created_at'];
    }
}