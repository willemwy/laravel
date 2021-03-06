<?php

class UserAlbum extends Eloquent {

    protected $fillable = array('id', 'user_id', "album_id", "removed");

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_album';
}