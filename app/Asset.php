<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    Use Uuid;

    protected $table = 'assets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'file_name','file_size','original_file_name','absolute_path','relative_path','description','status'
    ];
       
    public $incrementing = false;

    protected $keyType = 'uuid';
}
