<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactValid extends Eloquent
{
    public static $table = 'contacts';

    public static $rules = array(


    	'FullName' => ,
    	'Email' => , 
    	'PhoneNumber' => , 
    	'UserName' => ,  

    	);
}
            $table->string('UserName');
            $table->string('FullName');
            $table->string('Email');
            $table->integer('PhoneNumber');
            $table->string('Address');
            