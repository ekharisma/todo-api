<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TodoTable extends Model
{
    protected $table = "todo_table";

    protected $fillable = [
        'activity', 'description'
    ];

    protected $hidden = [];
}
