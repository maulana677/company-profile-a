<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyKeypoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['company_about_id', 'keypoint'];

    // Relasi ke CompanyAbout
    public function companyAbout()
    {
        return $this->belongsTo(CompanyAbout::class);
    }
}
