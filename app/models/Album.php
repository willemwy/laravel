<?php

class Album extends Eloquent {

    protected $fillable = array('id', 'name', "image", 'user_id');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'albums';
}