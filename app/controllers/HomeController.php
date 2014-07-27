<?php

class HomeController extends BaseController {

    //We use the master layout
    protected $layout = "layouts.master";

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function rateImagePage ($imageId)
    {
        $rating = Input::get("rating");
        if($rating > 0 && $rating < 6 && is_numeric($imageId))
        {
            Rate::create(array(
                "user_id" => Auth::user()->id,
                "score" => $rating,
                "image_id" => $imageId
            ));
            die();
        }
        else
        {
            return App::abort(400);
        }
        return;
    }

	public function homePage()
	{
		return View::make('home');
	}

    public function homePagePost()
    {
        $file = Input::file('upl');
        $destinationPath = public_path() . '/uploads';

        $filename =  time() . "_" . $file->getClientOriginalName() . "." . $file->getClientOriginalExtension();

        $upload_success = Input::file('upl')->move($destinationPath, $filename);

        if( $upload_success ) {

            $album = new Album();

            $album->name = Input::all()["lounge"];
            $album->user_id = Auth::user()->id;
            $album->image = $filename;

            $album->save();

            $insertedId = $album->id;

            $image = new Image();

            $image->name = Input::all()["lounge"];
            $image->album_id = $insertedId;
            $image->user_id = Auth::user()->id;
            $image->image = $filename;

            $image->save();

            return Response::json(array("success" => true, "albumId" => "$insertedId", "image" => false));
        } else {
            return Response::json(array("success" => false));
        }
    }

    public function albumPostPage($albumId)
    {
        $file = Input::file('upl');
        $destinationPath = public_path() . '/uploads';

        $filename =  time() . "_" . $file->getClientOriginalName() . "." . $file->getClientOriginalExtension();

        $upload_success = Input::file('upl')->move($destinationPath, $filename);

        if( $upload_success ) {

            $image = new Image();

            $image->name = Input::all()["lounge"];
            $image->album_id = $albumId;
            $image->user_id = Auth::user()->id;
            $image->image = $filename;

            $image->save();

            return Response::json(array("success" => true, "image" => true));
        } else {
            return Response::json(array("success" => false));
        }
    }

    public function imagePage($imageId)
    {
        $image = Image::findOrFail($imageId);
        $rate = new Rate();
        $rating = false;
        $hasRated = $rate->imageHasRatingFromUser(Auth::user()->id, $image->id);
        $ownImage = false;

        if($hasRated != FALSE)
        {
            $hasRated = $hasRated[0]->score;
        }

        if($image->user_id == Auth::user()->id)
        {
            $ownImage = true;
        }

        $rating = $image->getRating($image->id);
        if($rating[0]->rating != null)
        {
            $rating = $rating[0]->rating;
        }
        else
        {
            $rating = false;
        }


        return Response::json(
            array(
                "html" => View::make('imagePartial', array("image" => $image, "rating" => $rating, "hasRated" => $hasRated, "ownImage" => $ownImage)
                )->render())
        );
    }

    public function AlbumPage($albumId)
    {

        $filters = array(
            "newToOld" => "Newest to Oldest",
            "oldTonew" => "Oldest to Newest",
            "myUploads" => "My Images",
            "toBeRated" => "I need to Rate"
        );
        $album = Album::findOrFail($albumId);
        $imageModel = Image::where("album_id", "=", $albumId);

        if(Input::get("filter") != FALSE)
        {
            $filter = Input::get("filter");
            switch($filter)
            {
                case "newToOld":
                    $imageModel->orderBy("created_at", 'desc');
                    break;
                case "oldTonew":
                    $imageModel->orderBy("created_at");
                    break;
                case "myUploads":
                    $imageModel->orderBy("created_at", 'desc')->where("user_id", "=", Auth::user()->id);
                    break;
                case "toBeRated":
                    $imageModel->whereExists(function($query){
                        $query->select()
                            ->from('rates')
                            ->where('user_id', '=', Auth::user()->id);
                    });
                    break;
                default:
                    $imageModel->orderBy("created_at", 'desc');
                    break;
            }
        } else
        {
            $imageModel->orderBy("created_at", 'desc');
        }

        $images = $imageModel->get();
        $users = User::all();
        $inGroup = DB::select("SELECT user_id FROM user_album WHERE album_id = $albumId");
        $arrInGroup = array();
        foreach($inGroup as $userInGroup)
        {
            $arrInGroup[] = $userInGroup->user_id;
        }
        return View::make('album', array("album" => $album, "images" => $images, "filters" => $filters, "users" => $users, "inGroup" => $arrInGroup, "currentUser" => Auth::user()));
    }

    public function LoginPage($action = "")
    {
        // check URL segment
        if ($action == "auth") {
            // process authentication
            try {
                Hybrid_Endpoint::process();
            }
            catch (Exception $e) {
                // redirect back to http://URL/social/
                return Redirect::to('/social');
            }
            return;
        }
        try {

            // create a HybridAuth object
            $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
            // authenticate with Google
            $provider = $socialAuth->authenticate("Facebook");
            // fetch user profile
            $userProfile = $provider->getUserProfile();

            //$provider->logout();

            //var_dump($userProfile);die();

            $userEmails = User::where("fb_id", "=", $userProfile->identifier)->get();

            if(count($userEmails) == 0)
            {
                $user = new User();

                $user->fb_id = $userProfile->identifier;
                $user->name = $userProfile->firstName;
                $user->surname = $userProfile->lastName ;
                $user->email = $userProfile->email;
                $data = file_get_contents($userProfile->photoURL);
                $new  = public_path() . "/uploads/$userProfile->identifier.jpg";
                if(file_put_contents($new, $data) === false)
                {
                    App::abort(400);
                }

                $user->image = "$userProfile->identifier.jpg";
                $user->save();
            }
            else
            {
                $user = $userEmails[0];
            }


            Auth::login($user);

            $userCookie = Cookie::make("user", serialize($user), 3600);
            //Redirect to home page
            return Redirect::to("/")->withCookie($userCookie);
        }
        catch(Exception $e) {
            // exception codes can be found on HybBridAuth's web site
            return $e->getMessage();
        }
    }

    public function profilePage ()
    {
        return View::make('profile', array("user" => Auth::user()));
    }

    public function profilePagePost ()
    {
        $user = Auth::user();
        $file = Input::file('image');
        if($file != null)
        {
            $destinationPath = public_path() . '/uploads';
            $filename =  time() . "_" . $file->getClientOriginalName() . "." . $file->getClientOriginalExtension();
            $upload_success = $file->move($destinationPath, $filename);
            if($upload_success)
            {
                $user->image = $filename;
            }
        }


        $user->email = Input::all()["email"];
        $user->name = Input::all()["name"];
        $user->surname = Input::all()["surname"];

        $user->save();
        return Redirect::to("/profile")->with("message", "Saved!");
    }

    public function addUserPage($albumId)
    {
        $userId = Input::get("userId");
        $albumUser = new UserAlbum();
        $albumUser->user_id = $userId;
        $albumUser->album_id = $albumId;
        $albumUser->save();
        return Response::json(array("success" => true));
    }
}
