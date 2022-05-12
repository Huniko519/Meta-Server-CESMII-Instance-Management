<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function organization() {
        return $this->belongsTo(Organization::class);
    }
    protected $fillable = [
        'name', 'email', 'phone', 'type', 'organization_id'
    ];
    public $timestamps = false;
}
