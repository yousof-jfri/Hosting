<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Http\Resources\V1\CinemaVideoResource;
use App\Models\UserVideo;
use App\Models\User;

class CinemaController extends Controller
{
    public function index()
    {
        $videos = Video::query();

        $videos = $videos->latest()->paginate(30);

        return CinemaVideoResource::collection($videos);
    }

    public function show(Video $video, $id)
    {

        if($userId = User::find($id))
        {
            $userId = $userId->id;
        }else {
            $userId = 0;
        }

        //update view view 
        $view = $video->views + 1;
        $video->update([
            'views' => $view,
        ]);

        // 
        UserVideo::create(['user_id' => $userId, 'video_id' => $video->id]);

        // return $video;
        return new CinemaVideoResource($video);
    }
}
