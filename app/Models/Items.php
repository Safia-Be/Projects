<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'selected',
    ];

    public function markAsSelected()
    {
        $this->selected = true;
    }

    public function markAsUnSelected()
    {
        $this->selected = false;
    }
}
