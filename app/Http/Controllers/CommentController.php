<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comment = new Comment();
        $comment->text = 'wat maak ik mee en wat beleef ik, godnondeju.';

        return view('comments.index', ['comment' => $comment]);
    }
}
