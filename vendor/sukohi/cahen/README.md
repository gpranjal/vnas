Cahen
=====

A PHP package mainly developed for Laravel to manage sort values of DB table automatically.  
(This is for Laravel 5+. [For Laravel 4.2](https://github.com/SUKOHI/Cahen/tree/1.0))

Installation
====

Add this package name in composer.json

    "require": {
      "sukohi/cahen": "2.*"
    }

Execute composer command.

    composer update

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        Sukohi\Cahen\CahenServiceProvider::class,
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'Cahen'   => Sukohi\Cahen\Facades\Cahen::class
    ]

Usage
====

**Basic**

    $model = YourModel::find(1);
    \Cahen::move($model)->to('your-column-name', 5);

**Up**

    \Cahen::move($model)->up('your-column-name');

**Down**

    \Cahen::move($model)->down('your-column-name');
		
**to First**

    \Cahen::move($model)->first('your-column-name');

**to Last**

    \Cahen::move($model)->last('your-column-name');
    
**with Transaction**

    \DB::beginTransaction();
    
    if(!\Cahen::move($model)->to('your-column-name', 5)) {
    	
	    \DB::rollback();
	
    }
    
    \DB::commit();
    
    
**with Where Clause**

You can use `where` clause to sort within specific record(s).

    $model = YourModel::find(1);
    \Cahen::move($model)
            ->where('column_1', '=', 'value')
            ->where('column_2', 'LIKE', '%value%')
            ->to('your-column-name', 5);

**Set data**

You can sort within specific record(s) by setting model object.

    $moving_id = 1;
    $model = YourModel::find($moving_id);
    $models = YourModel::where('id', '<', 5)
                ->where('id', '<>', $moving_id)
                ->get();
    \Cahen::move($model)
            ->data($models)
            ->to('your-column-name', 3);

* Note: You can not include a record that has ID is $moving_id in $models.

**Alignment**

    $model = YourModel::orderBy('id', 'ASC')->get();
    \Cahen::align($model, 'your-column-name');


**About Sort Number**

The sort value starts from 0.

License
====

This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh
