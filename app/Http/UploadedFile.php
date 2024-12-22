<?php

namespace App\Http;

use App\Models\User;

class UploadedFile extends \Illuminate\Http\UploadedFile
{
    public User $user;

    public string $filename;
}
