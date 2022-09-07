<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\UserVideo;
use Illuminate\Support\Carbon;
use App\Http\Resources\V1\VideoResource;

class DashbaordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userPermissions(Request $request)
    {
        $user = User::find($request->id);
        $videos = Video::limit(4)->inRandomOrder()->get();
        $userVideos = $user->videos()->where('created_at', '>=', Carbon::now()->subdays(7))->get();
        $videoViews = [
            'today' => [],
            'yesterday' => [],
            'days2' => [],
            'days3' => [],
            'days4' => [],
            'days5' => [],
        ];

        $videoViewUserType = [
            'vip' => [],
            'normal' => [],
            'none' => [],  
        ];

        foreach($userVideos as $video)
        {
            // set video views
            array_push($videoViews['today'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::today())->get());
            array_push($videoViews['yesterday'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::yesterday())->get());
            array_push($videoViews['days2'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::now()->subDays( 2 ) )->get());
            array_push($videoViews['days3'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::now()->subDays( 3 ) )->get());
            array_push($videoViews['days4'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::now()->subDays( 4 ) )->get());
            array_push($videoViews['days5'], UserVideo::where('video_id', $video->id)->whereDate('created_at', Carbon::now()->subDays( 5 ) )->get());

            $videoViewUserType['none'] = count(UserVideo::where('video_id', $video->id)->where('user_id', 0)->get());
            $videoViewUserType['vip'] = count(UserVideo::where('video_id', $video->id)->whereNot('user_id', 0)->get()->pluck('user')->flatten()->where('is_vip', 1)->pluck('id'));
            $videoViewUserType['normal'] = count(UserVideo::where('video_id', $video->id)->whereNot('user_id', 0)->get()->pluck('user')->flatten()->where('is_vip', 0)->pluck('id'));
        }

        return ['user' => $user, 'userVideos' => $user->videos, 'randomVideos' => $videos, 'videoView' => $videoViews, 'watcher_type' => $videoViewUserType];
    }


    // return user watch history
    public function userHistory(Request $request)
    {
        $user = User::find($request->id);

        return VideoResource::collection($user->viewViews()->latest()->get());
    }
}
