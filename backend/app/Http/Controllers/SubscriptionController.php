<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Channel $channel)
    {

        if(!auth()->check()){
            return response()->json(["statusCode" => Response::HTTP_FORBIDDEN, "message"=>'You are not login, please login first to subscribe']);
        }

        if($channel->user_id == auth()->user()->id){
            return response()->json(["statusCode" => Response::HTTP_OK, "message"=>'You are the owner of channel, can\'t subscribe to channel']);
        }

        
         $channel->subscriptions()->create([
            'user_id' => auth()->user()->id
        ]);

        return response()->json(["statusCode" => Response::HTTP_OK, "message"=>'You have subscribed to channel']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel, Subscription $subscription)
    {
        $subscription->delete();

        
        return response()->json(["statusCode" => Response::HTTP_OK, "message"=>'You have unsubscribed to channel']);
    }
}
