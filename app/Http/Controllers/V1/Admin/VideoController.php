<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Http\Requests\V1\StoreVideoRequest;
use App\Http\Requests\V1\UpdateVideoRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\V1\VideoResource;
use App\Models\Actor;
use App\Models\Writer;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $videos = Video::where('user_id', $user->id)->paginate(10);
        
        return VideoResource::collection($videos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {

        // save the document
        $relativeVideoPath = $this->saveDocument($request->justification);
        $justification = $relativeVideoPath;

        // save the document
        $relativeVideoPath = $this->saveImage($request->poster);
        $image = $relativeVideoPath;

        // save video teaser
        $relativeTeaserPath = $this->saveVideo($request->teaser, 'teaser');
        $teaser = $relativeTeaserPath;

        // save video
        $relativeVideoPath = $this->saveVideo($request->video, 'video');
        $video = $relativeVideoPath;

        $user = User::find($request->user_id);

        $film = $user->videos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'poster' => $image,
            'video' => $video,
            'teaser' => $teaser,
            'director' => $request->director,
            'genre' => $request->genre,
            'justification' => $justification,
            'country' => $request->country,
            'release' => $request->release,
            'price' => $request->price,
            'discountFromUser' => $request->discountFromUser,
            'discountFromProgram' => $request->discountFromProgram,
        ]);

        // store writers
        if($request->writers)
        {
            foreach($request->writers as $actor)
            {
                $film->writers()->create([
                    'name' => $actor['name'],
                ]);
            }
        }

        // store actors
        if($request->actors)
        {
            foreach($request->actors as $actor)
            {
                $film->actors()->create([
                    'name' => $actor['name'],
                ]);
            }
        }

        return $film;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVideoRequest  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        // save video poster
        $image = $video->poster;
        if($request->poster)
        {
            if(File::exists(public_path($video->poster))){
                File::delete(public_path($video->poster));
            }
            $relativePath = $this->saveImage($request->poster);
            $image = $relativePath;
        }

        $teaser = $video->teaser;
        // save video teaser
        if($request->teaser)
        {
            if(File::exists(public_path($video->teaser))){
                File::delete(public_path($video->teaser));
            }
            $relativeTeaserPath = $this->saveVideo($request->teaser, 'teaser');
            $teaser = $relativeTeaserPath;
        }

        $film = $video->video;
        // save video
        if($request->video)
        {
            if(File::exists(public_path($video->video))){
                File::delete(public_path($video->video));
            }
            $relativeVideoPath = $this->saveVideo($request->video, 'video');
            $video = $relativeVideoPath;
        }

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'poster' => $image,
            'video' => $film,
            'teaser' => $teaser,
            'director' => $request->director,
            'genre' => $request->genre,
            'country' => $request->country,
            'release' => $request->release,
            'price' => $request->price,
            'discountFromUser' => $request->discountFromUser,
            'discountFromProgram' => $request->discountFromProgram,
        ]);

        // store writers
        if($request->writers)
        {
            // delete previos writers
            foreach(Writer::where('video_id', $video->id)->get() as $writer)
            {
                $writer->delete();
            }

            // save new writers
            foreach($request->writers as $actor)
            {
                $video->writers()->create([
                    'name' => $actor['name'],
                ]);
            }
        }

        // store actors
        if($request->actors)
        {
            // delete previos actors
            foreach(Actor::where('video_id', $video->id)->get() as $actor)
            {
                $actor->delete();
            }

            // save new actor
            foreach($request->actors as $actor)
            {
                $video->actors()->create([
                    'name' => $actor['name'],
                ]);
            }
        }

        return new VideoResource($video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        // delete poster
        if(File::exists(public_path($video->poster)))
        {
            File::delete(public_path($video->poster));   
        }

        // delete teaser
        if(File::exists(public_path($video->teaser)))
        {
            File::delete(public_path($video->teaser));   
        }

        // delete video
        if(File::exists(public_path($video->video)))
        {
            File::delete(public_path($video->video));   
        }

        // delete video from database
        $video->delete();
    }



    private function saveImage($image)
    {
        if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)){
            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);

            if(!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])){
                throw new \Exception('invalid image type');
            }

            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if($image == false){
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception("didn' match data URL with image data");
        }

        $dir = 'assets/images/posters/';
        $file = Str::random() . '.' .$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)){
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    private function saveVideo($video, $videType)
    {
        if(preg_match('/^data:video\/(\w+);base64,/', $video, $type)){
            $video = substr($video, strpos($video, ',') + 1);

            $type = strtolower($type[1]);

            if(!in_array($type, ['mp4', 'ogg', 'mov'])){
                throw new \Exception('invalid image type');
            }

            $video = str_replace(' ', '+', $video);
            $video = base64_decode($video);

            if($video == false){
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception("didn' match data URL with video data");
        }

        if($videType == 'teaser')
        {
            $dir = 'assets/videos/teasers/';
        }else {
            $dir = 'assets/videos/films/';
        }
        $file = Str::random() . '.' .$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)){
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $video);

        return $relativePath;
    }

    private function saveDocument($document)
    {
        preg_match('/^data:application\/(\w+);base64,/', $document, $type);
        $document = substr($document, strpos($document, ',') + 1);

        $document = str_replace(' ', '+', $document);
        $document = base64_decode($document);

        if($document == false){
            return response([ 'errors' => ['justification' => 'لطفا یک فایل معتبر وارد کنید'], 'message' => 'لطفا یک فایل معتبر وارد کنید' ], 422);
        }

        $dir = 'assets/documents/videos-documents/';

        $file = Str::random() . '.pdf';
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)){
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $document);

        return $relativePath;
    }
}
