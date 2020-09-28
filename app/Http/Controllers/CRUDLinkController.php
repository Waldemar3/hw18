<?php


namespace App\Http\Controllers;


use App\Link;
use App\Statistic;
use Illuminate\Support\Facades\Request;

class CRUDLinkController
{
    public function create()
    {
        $createLink = request()->get('createLink');

        $validator = \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            [
                'createLink' => 'required|min:6|max:255',
            ]
        );

        if($validator->fails()){
            return redirect('/links')->withErrors($validator->errors());
        }

        if(is_null(Link::where('regular_link', request()->get('createLink'))->get()->first())){
            $link = new Link();
            $link->regular_link = $createLink;
            $link->short_link = 'http://localhost/'.str_random(5);
            auth()->user()->link()->save($link);

            return redirect('/links')->with("success", "Link \"{$createLink}\" was successfully created");
        }

        return redirect('/links')->with('success', "Link \"{$createLink}\" already exists");
    }

    public function show(){
        $link = Link::where('id', request()->id)->first();
        $statistic = Statistic::where('link_id', $link->id);

        return view('showLink', ['link' => $link, 'statistic' => $statistic]);
    }

    public function edit(){
        $link = Link::where('id', request()->id)->first();
        if(auth()->user()->can('update', $link)){
            if(Request::method() === "POST"){
                $link->regular_link = request()->get('updateLink');
                auth()->user()->link()->save($link);

                return redirect('/links')->with('success', "Link \"{$link->regular_link}\" was successfully updated");
            }
            return view('editLink', ['link' => $link]);
        }
        return redirect('/links');
    }

    public function delete(){
        $link = Link::where('id', request()->id)->first();
        $statistics = Statistic::where('link_id', $link->id);

        if(auth()->user()->can('delete', $link)){
            $statistics->delete();
            $link->delete();
            return redirect('/links')->with("success", "Link \"{$link->regular_link}\" was successfully deleted");
        }
        return redirect('/links');
    }
}
