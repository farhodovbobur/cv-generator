<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class StudentDTO extends DataTransferObject
{
    public int $id;
    public ?string $nt_id;
    public string $first_name;
    public string $last_name;
    public ?string $middle_name; // Nullable
    public ?string $gender;
    public ?string $date_of_birth;
    public ?string $phone;
    public ?string $email;
    public ?string $bio;
    public ?string $image;
    public string $created_at;

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'nt_id' => $this->nt_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'phone' => $this->phone,
            'email' => $this->email,
            'bio' => $this->bio,
            'image' => $this->image,
            'created_at' => $this->created_at,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->nt_id = $data['nt_id'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->middle_name = $data['middle_name'];
        $this->gender = $data['gender'];
        $this->date_of_birth = $data['date_of_birth'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->bio = $data['bio'];
        $this->image = $data['image'];
        $this->created_at = $data['created_at'];
    }
}