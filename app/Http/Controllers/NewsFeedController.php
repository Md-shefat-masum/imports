<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsFeed;

class NewsFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsFeeds = NewsFeed::all();
        return view('admin.pages.footer.news_feed', compact('newsFeeds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $requestData = $request->all();

        NewsFeed::create($requestData);

        $request->session()->flash('success', 'Successfully created!');

        return redirect()->route('news-feed.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = NewsFeed::findOrFail($id);

        return view('admin.pages.footer.news_feed_edit', compact('partner'));
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
        $requestData = $request->all();

        $partner = NewsFeed::findOrFail($id);
        $partner->update($requestData);

        $request->session()->flash('success', 'Successfully Updated!');

        return redirect()->route('news-feed.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $partner = NewsFeed::find($id);
        $partner->delete();

        $request->session()->flash('danger', 'Successfully deleted!');

        return redirect()->route('news-feed.index');
    }
}
