<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'mt_salary';
    protected $primaryKey = 'salary_id';
    public $timestamps = false; // karena tidak ada created_at & updated_at

    protected $fillable = [
        'biodata_id',
        'company_id',
        'company_name',
        'dept_name',
        'basic_salary',
        'healthy_allowance',
        'positional_allowance',
        'pic_input',
        'input_time',
        'pic_edit',
        'edit_time',
    ];

    protected $casts = [
        'input_time' => 'datetime',
        'edit_time'  => 'datetime',
    ];


    public function history()
    {
        return $this->belongsTo(SalaryHistory::class, 'salary_history_id', 'salary_history_id');
    }
}
