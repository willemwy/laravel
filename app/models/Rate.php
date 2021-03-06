<?php

class Rate extends Eloquent {

    protected $fillable = array('id', 'image_id', "user_id", 'score');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rates';

    public function imageHasRatingFromUser($userId, $imageId)
    {
        return DB::select("
            SELECT score FROM rates WHERE user_id = $userId AND image_id = $imageId
        ");
    }
}