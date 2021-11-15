<?php

namespace App\Models;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentModel extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'id', 'name', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
}
