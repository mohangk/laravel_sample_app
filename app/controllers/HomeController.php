<?php

class HomeController extends BaseController {

  public function index() {

    $users = App::make('User')->all();
    $uniqueVisitorsByDate = App::make('Metric')->uniqueVisitors();
    $pageviewsByDate = App::make('Metric')->pageViews();

    return View::make('home', ['users' => $users,
                               'uniqueVisitorsByDate' => $uniqueVisitorsByDate,
                               'pageviewsByDate' => $pageviewsByDate
                              ]);

	}

}
