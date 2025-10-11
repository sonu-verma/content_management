<?php

namespace App\Http\Controllers;

use App\Http\Requests\Channels\UpdateChannleRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Channel $channel)
    {

        $isSubscribed = $channel?->isSubscribed ? 'Unsubscribed' : 'Subscribed';
       
        if($channel->user_id == auth()->user()->id){
            $isSubscribed  = 'Subscriptions';
        }
        $actionUrl = $channel?->isSubscribed
            ? url('channels/'.$channel->id.'/subscriptions/'.$channel->isSubscribed->id)
            : url('channels/'.$channel->id.'/subscriptions');


        $subscriptionButton = '<div class="form-group" style="text-align:center !important"><button
                            type="button" 
                            id="checkSubscriptionAction"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 text-white border border-1 rounded-md transition ease-in-out duration-150 hover:bg-red-400" 
                            data-type="'.$isSubscribed.'" data-url="'.$actionUrl.'">'
                                .$isSubscribed.' '.$channel->totalSubscriptions().'+
                        </button>
                        </div>';
        return view('channels.show', compact('channel','subscriptionButton'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChannleRequest $request, Channel $channel)
    {
    
        if($request->hasFile('channel_image')){
            $channel->clearMediaCollection('channel_images');
            $channel->addMediaFromRequest('channel_image')->toMediaCollection('channel_images');
        }


        $channel->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
