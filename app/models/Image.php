<?php

class Image extends Eloquent {

    protected $fillable = array('id', 'name', "album_id", "user_id");

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';
}