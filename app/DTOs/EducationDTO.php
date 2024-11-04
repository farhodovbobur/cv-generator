<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class EducationDTO extends DataTransferObject
{
    public int     $id;
    public int     $student_id;
    public ?string $name;
    public ?string $description;
    public ?string $start_date;
    public ?string $end_date;
    public string  $created_at;

    public function __serialize(): array
    {
        return [
            'id'          => $this->id,
            'student_id'  => $this->student_id,
            'name'        => $this->name,
            'description' => $this->description,
            'start_date'  => $this->start_date,
            'end_date'    => $this->end_date,
            'created_at'  => $this->created_at,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id          = $data['id'];
        $this->student_id  = $data['student_id'];
        $this->name        = $data['name'];
        $this->description = $data['description'];
        $this->start_date  = $data['start_date'];
        $this->end_date    = $data['end_date'];
        $this->created_at  = $data['created_at'];
    }
}