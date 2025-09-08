<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MtMenu extends Model
{
    // Nama tabel
    protected $table = 'mt_menu';

    // Primary key
    protected $primaryKey = 'menu_id';

    // Tidak pakai created_at dan updated_at default
    public $timestamps = false;

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'icon',
        'order',
        'is_active',
        'pic_input',
        'input_time',
        'pic_edit',
        'edit_time',
    ];

    // Relasi ke parent menu
    public function parent()
    {
        return $this->belongsTo(MtMenu::class, 'parent_id', 'menu_id');
    }

    // Relasi ke child menu
    public function children()
    {
        return $this->hasMany(MtMenu::class, 'parent_id', 'menu_id');
    }
}