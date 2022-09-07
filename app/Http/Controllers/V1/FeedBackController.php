<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreFeedBackRequest;
use App\Models\FeedBack;
use App\Http\Resources\V1\FeedBackResource;

class FeedBackController extends Controller
{
    public function store(StoreFeedBackRequest $request)
    {
        FeedBack::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'feedback' => $request->feedback,
            'issue' => $request->issue,
            'phone' => $request->phone,
        ]);
    }

    public function index()
    {
        $feedbacks = FeedBack::latest()->get();
        return FeedBackResource::collection($feedbacks);
    }

    public function editStatus(FeedBack $feedback, Request $request)
    {
        $feedback->update([
            'type' => $request->type,
        ]);
    }

    public function delete($id)
    {
        // delete feedback
        $feedBack = FeedBack::find($id);
        $feedBack->delete();

        // return all the feedbacks
        $feedbacks = FeedBack::all();
        return FeedBackResource::collection($feedbacks);
    }
}
