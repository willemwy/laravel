<?php

class LandingController extends BaseController {

    //We use the master layout
    protected $layout = "layouts.empty";

    public function landingPage ()
    {
        return View::make('landing', array());
    }

    public function termsPage ()
    {
        return View::make('terms', array());
    }

    public function conditionsPage ()
    {
        return View::make('users', array());
    }
}
