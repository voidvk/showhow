<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Models\EventPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class EventPostController extends BaseEventController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EventPost::all();
        return Response()->json($items, 200);
    }


    public function create(Request $request)
    {
        $data = $request->input();
        if(empty($data['slug']))
        {
            $data['slug'] = Str::slug($data['title']);
        }
        $post = new EventPost($data);
        $post->save();
        return Response()->json($post,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
        $item = EventPost::find($id);
        $creator = User::find($item['creator_id']);
        $item['creator_id'] = $creator;
        return Response()->json($item,200, $headers ,JSON_UNESCAPED_UNICODE);
    }

    public function count()
    {
        return Response()->json(EventPost::all()->count());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
