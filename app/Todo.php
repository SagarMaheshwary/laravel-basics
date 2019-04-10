<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    /**
     * Table for this Model.
     * 
     * @var string
     */
    protected $table = 'todos'; // table for this model

    /**
     * Disable created_at and updated_at timestamp
     * columns.
     * 
     * @var boolean
     */
    public $timestamps = true;


    /**
     * Properties that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'title', 'body',
    ];

    /**
     * User model that owns all the Todos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

}
