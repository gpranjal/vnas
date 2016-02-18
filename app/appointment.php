<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class appointment extends Model {

	//
    protected $fillable = [

        'title',
        'date',
        'time',
        'duration',
        'comments',
        'vnas_user_id',

    ];
}
