<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Видимо не удалось распознать соглашение наименований моделей и таблиц.
    // Поэтому указание на таблицу происходит явно.
    // protected $table = 'users_data';
}
