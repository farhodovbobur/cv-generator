<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class ExperienceDTO extends DataTransferObject
{
    public int     $id;
    public int     $student_id;
    public ?string $company;
    public ?string $position;
    public ?string $description;
    public ?string $start_date;
    public ?string $end_date;
    public string  $created_at;

    public function __serialize(): array
    {
        return [
            'id'          => $this->id,
            'student_id'  => $this->student_id,
            'company'     => $this->company,
            'position'    => $this->position,
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
        $this->company     = $data['company'];
        $this->position    = $data['position'];
        $this->description = $data['description'];
        $this->start_date  = $data['start_date'];
        $this->end_date    = $data['end_date'];
        $this->created_at  = $data['created_at'];
    }
}