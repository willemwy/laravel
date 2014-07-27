<?php

class Image extends Eloquent {

    protected $fillable = array('id', 'name', "album_id", "user_id");

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    public function getRating($imageId)
    {
        return DB::select("
            SELECT (SUM(score) / COUNT(id)) AS rating
            FROM rates
            WHERE image_id = $imageId
        ");
    }
}