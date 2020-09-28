<?php


namespace App\Http\Controllers;


use App\Link;
use App\Statistic;

class FollowTheLinkController
{
    public function __invoke()
    {
        $link = Link::where('short_link', 'http://localhost/'.request()->link)->get()->first();
        $statistic = Statistic::where('link_id', $link->id);

        if(is_null($statistic->where([['ip', $_SERVER['REMOTE_ADDR']], ['user_agent', $_SERVER['HTTP_USER_AGENT']]])->first())){
            dispatch(new \App\Jobs\Statistic($link, auth()->user(), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']))->onQueue('default');
        }

        return redirect()->to($link->regular_link);
    }
}
