<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    // Nama tabel
    protected $table = 'menu_permission';

    // Primary key
    protected $primaryKey = 'permission_id';

    // Tidak pakai created_at dan updated_at bawaan Laravel
    public $timestamps = false;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'user_id',
        'menu_id',
        'name',
        'description',
        'pic_input',
        'input_time',
        'pic_edit',
        'edit_time',
    ];

    /**
     * Relasi ke User (many-to-one)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relasi ke MtMenu (many-to-one)
     */
    public function menu()
    {
        return $this->belongsTo(MtMenu::class, 'menu_id', 'menu_id');
    }
}