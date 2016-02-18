<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class vnas_user extends Model {

	//

    protected $fillable = [
        'patient_id',
        'name',
        'email',
        'patient_phone',
        'patient_address',

    ];
}
