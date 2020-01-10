<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reply;
use App\Discussion;

use App\Http\Requests\CreateReplyRequest;

use App\Notifications\NewReplyAdded;

class RepliesController extends Controller
{

    public function __construct() {

        $this->middleware('auth')->only([ 'create', 'store' ]);

    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReplyRequest $request, Discussion $discussion)
    {

        auth()->user()->replies()->create([

            'content' => $request->content,
            'discussion_id' => $discussion->id

        ]);

        $discussion->author->notify(new NewReplyAdded($discussion));

        session()->flash('success','Reply added') ;

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
