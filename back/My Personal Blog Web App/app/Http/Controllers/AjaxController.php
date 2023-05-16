<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // when click like button in post detail
    public function like(Request $request)
    {
        $isExitst = LikeDislike::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        if ($isExitst) {
            if ($isExitst->type == 'dislike') {
                LikeDislike::where('id', $isExitst->id)->update([
                    'type' => 'like',
                ]);

                $response = [
                    'status' => 'dislike to like',
                ];

                return response()->json($response, 200);
            }
        } else {
            LikeDislike::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'type' => 'like',
            ]);

            $response = [
                'status' => 'like success',
            ];

            return response()->json($response, 200);
        }
    }

    // when click dislike button in post detail
    public function dislike(Request $request)
    {
        $isExitst = LikeDislike::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();

        if ($isExitst) {
            if ($isExitst->type == 'like') {
                LikeDislike::where('id', $isExitst->id)->update([
                    'type' => 'dislike',
                ]);

                $response = ['status' => 'like to dislike'];
                return response()->json($response, 200);
            }
        } else {
            LikeDislike::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'type' => 'dislike',
            ]);

            $response = [
                'status' => 'dislike success',
            ];

            return response()->json($response, 200);
        }
    }

    // to create comments
    public function comment(Request $request)
    {
        // logger($request);
        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::user()->id,
            'text' => $request->text,
        ]);

        $user = User::find(auth()->user()->id);

        return response()->json([
            'user' => $user,
            'comment'  => $comment
        ]);
    }
}
