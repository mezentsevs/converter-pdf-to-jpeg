<?php

namespace App\Dtos;

use App\Interfaces\Dto;
use App\Models\User;

class DocumentCreateDto implements Dto
{
    public User $user;

    public string $filename;

    public string $type;

    public int $size;

    public function toArray(): array
    {
        return [
            'user' => $this->user,
            'filename' => $this->filename,
            'type' => $this->type,
            'size' => $this->size,
        ];
    }
}
