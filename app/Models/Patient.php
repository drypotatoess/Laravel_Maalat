<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Patient extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'gender',
        'blood_type',
        'contact',
        'address',
        'diagnosis',
        'doctor',
        'date_of_visit',
        'status',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}