<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'address1', 'address2', 'city', 'state', 'postal_code', 'url',
        'partner_type', 'partner_id', 
    ];

    protected static $rules = [
        'name' => 'required|string|max:255|unique:organizations',
        'address1' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
        'url' => 'required|string|max:255',
        'partner_type' => 'in:Customer,Partner,Integrator',
        'contact_technical_name' => 'required|string|max:255',
        'contact_technical_email' => 'required|email|max:255',
        'contact_commercial_name' => 'required|string|max:255',
        'contact_commercial_email' => 'required|email|max:255',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    // Parent Organization
    public function partner() {
        return $this->belongsTo(Organization::class, 'partner_id');
    }

    public function children() {
        return $this->hasMany(Organization::class, 'partner_id');
    }

    public static function validator($input) {
        return Validator::make($input, self::$rules);
    }

    public static function updateValidator($input, $id) {
        $rule = self::$rules;
        $rule['name'] = $rule['name'] . ',name,' . $id;
        return Validator::make($input, $rule);
    }
    
}
