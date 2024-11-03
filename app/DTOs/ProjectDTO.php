<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class ProjectDTO extends DataTransferObject
{
    public int    $id;
    public int    $student_id;
    public string $name;
    public ?string $description;
    public ?string $source_link;
    public ?string $demo_link;
    public string $created_at;

    public function __serialize(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'source_link' => $this->source_link,
            'demo_link'   => $this->demo_link,
            'created_at'  => $this->created_at,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id          = $data['id'];
        $this->name        = $data['name'];
        $this->description = $data['description'];
        $this->source_link = $data['source_link'];
        $this->demo_link   = $data['demo_link'];
        $this->created_at  = $data['created_at'];
    }
}