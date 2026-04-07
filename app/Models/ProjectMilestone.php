<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    protected $fillable = ['project_id', 'nama', 'icon', 'urutan', 'status', 'tanggal_target', 'tanggal_selesai', 'catatan'];

    protected $casts = [
        'tanggal_target' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
