<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    use HasFactory;

    protected $table = 'mt_salary_history';
    protected $primaryKey = 'salary_history_id';
    public $timestamps = false;

    protected $fillable = [
        'biodata_id',
        'old_value',
        'new_value',
        'effect_date',
        'pic_input',
        'input_time',
    ];

    protected $casts = [
        'effect_date' => 'date',
        'input_time'  => 'datetime',
    ];

    /**
     * Relasi ke Salary
     */
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'salary_history_id', 'salary_history_id');
    }
}
