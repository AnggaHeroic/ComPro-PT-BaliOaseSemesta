<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Sengaja tidak memakai trait LogsActivity agar pencatatan tidak rekursif.
class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'subject_type', 'subject_id', 'changes'];

    protected function casts(): array
    {
        return ['changes' => 'array'];
    }
}
