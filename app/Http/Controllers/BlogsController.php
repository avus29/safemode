<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Blog;
use Carbon\Carbon;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:expert',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get posts from database from the recent and paginate by 10's
        $blogs = Blog::where('visible','=',1)->orderBy('id','desc')->with(['comments','expert'])->paginate(10);
        return view('blogs.index')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'blog'=>'required'
            // 'cover_image'=>'image|nullable|max:1990'
        ]);
        //Handle file upload
        // if($request->hasFile('cover_image')){
        //     //Get filename with the extension
        //     $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        //     //Get just file name
        //     $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //     //Get just ext
        //     $extension = $request->file('cover_image')->getClientOriginalExtension();
        //     //Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     //Upload Image
        //     $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        // }else{
        //     $fileNameToStore = 'noimage.jpg';
        // }

       //Create Gist
       $blog = new Blog;
       $blog->title = $request->input('title');
       $blog->blog = $request->input('blog');
       $blog->author_id = auth('expert')->user()->id;
    //    $post->cover_image = $fileNameToStore;
       $blog->save();

       return redirect('/blogs')->with('success','Post Created'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Find gist
        $blog = Blog::find($id);
        //Find Answers associated with gist
        $comments = $blog->comments()->get();
        //Display the gist and their respective answers
        return view('blogs.show')->with(['blog'=>$blog,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        // //Check for correct user
        // if(auth()->user()->id!==$post->user_id){
        //   return redirect('/posts')->with('error','Unauthorized page');
        // }
               
        return view('blogs.edit')->with('blog',$blog);
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
        $this->validate($request,[
            'title'=>'required',
            'blog'=>'required'
            // 'cover_image'=>'image|nullable|max:1990'
        ]);
        //Handle file upload
        // if($request->hasFile('cover_image')){
        //     //Get filename with the extension
        //     $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        //     //Get just file name
        //     $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        //     //Get just ext
        //     $extension = $request->file('cover_image')->getClientOriginalExtension();
        //     //Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //     //Upload Image
        //     $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        // }else{
        //     $fileNameToStore = 'noimage.jpg';
        // }

       //Create Gist
       $blog = Blog::find($id);
       $blog->title = $request->input('title');
       $blog->blog = $request->input('blog');
    //    $post->user_id = auth()->user()->id;
    //    $post->cover_image = $fileNameToStore;
       $blog->save();

       return redirect('/blogs')->with('success','Post Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        //  //Check for correct user
        // if(auth()->user()->id!==$post->user_id){
        // return redirect('/posts')->with('error','Unauthorized page');
        // }
        // if($post->cover_image !='noimage.jpg'){
        //     //Delete Image
        //     Storage::delete('public/cover_images/'.$post->cover_img);
        // }

        //Set as non-visible rather than delete!
        $blog->visible = 0;
        $blog->save();
        
        // $blog->delete();
        return redirect('/blogs')->with('success','Post Deleted'); 
    }
}
