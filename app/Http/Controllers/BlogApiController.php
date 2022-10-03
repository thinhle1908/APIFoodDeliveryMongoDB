<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BlogApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Only admin
        // if (Gate::allows('admin-only', auth()->user())) {
        // } else {
        //     abort(403);
        // }
        $blogs = Blog::all();
        return response()->json(['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('check-login', auth()->user())) {
            request()->validate([
                'blog_content' => 'required',
                'blog_status' => 'required',
                'blog_type' => 'required',
                'blog_like_count' => 'required',
                'blog_commnet_count' => 'required',
                'blog_has_article' => 'required',
                'article_title' => 'required',
                'article_content' => 'required'
            ]);
            $blog = new Blog();
            $blog->user_id =  auth()->user()->id;
            $blog->blog_content = $request->blog_content;
            $blog->blog_status = $request->blog_status;
            $blog->blog_type = $request->blog_type;
            $blog->blog_like_count = $request->blog_like_count;
            $blog->blog_commnet_count = $request->blog_commnet_count;
            $blog->blog_has_article = $request->blog_has_article;
            $blog->article_title = $request->article_title;
            $blog->article_content = $request->article_content;
            $blog->save();
            return response()->json(['message' => 'success']);
        } else {
            abort(403);
        }
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
        if (Gate::allows('check-login', auth()->user())) {
            $blog = Blog::find($id);
            if (!empty($blog)) {
                if ($blog->user_id == auth()->user()->id || Gate::allows('admin-only', auth()->user())) {
                    request()->validate([
                        'blog_content' => 'required',
                        'blog_status' => 'required',
                        'blog_type' => 'required',
                        'blog_like_count' => 'required',
                        'blog_commnet_count' => 'required',
                        'blog_has_article' => 'required',
                        'article_title' => 'required',
                        'article_content' => 'required'
                    ]);
                    $success = $blog->update([
                        'blog_content' => request('blog_content'),
                        'blog_status' => request('blog_status'),
                        'blog_type' => request('blog_type'),
                        'blog_like_count' => request('blog_like_count'),
                        'blog_commnet_count' => request('blog_has_article'),
                        'blog_has_article' => request('blog_has_article'),
                        'article_title' => request('article_title'),
                        'article_content' => request('article_content'),
                    ]);
                    return response()->json([
                        'message' => $success
                    ]);
                } else {
                    abort(403);
                }
            } else {
                return response()->json([
                    'message' => "Not found blog"
                ]);
            }
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('check-login', auth()->user())) {
            $blog = Blog::find($id);
            if (!empty($blog)) {
                if ($blog->user_id == auth()->user()->id || Gate::allows('admin-only', auth()->user())) {
                    $success = $blog->delete();
                    return response()->json([
                        'message' => $success
                    ]);
                } else {
                    abort(403);
                }
            } else {
                return response()->json([
                    'message' => "Not found blog"
                ]);
            }
        } else {
            abort(403);
        }
    }
}
