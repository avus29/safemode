<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Gist;
use GistMed\User;
use GistMed\Answer;
use Illuminate\Support\Carbon;

class GistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get posts from database from the recent and paginate by 10's
        $gists = Gist::orderBy('id','desc')->with(['user','answers'])->paginate(10);
        return view('gists.index')->with('gists', $gists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gists.create');
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
            'gist'=>'required',
            
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
       $gist = new Gist;
       $gist->title = $request->input('title');
       $gist->gist = $request->input('gist');
       $gist->author_id = auth('web')->user()->id;
    //    $post->cover_image = $fileNameToStore;
       $gist->save();

       return redirect('/gists')->with('success','Post Created...You may edit or delete this question within the next 15 minutes'); 
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
        $gist = Gist::find($id);
        //Find Answers associated with gist
        $answers = $gist->answers()->get();
        //Display the gist and their respective answers
        return view('gists.show')->with(['gist'=>$gist,'answers'=>$answers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gist = Gist::find($id);
        //Check for correct user
        if(auth('web')->user()->id!==$gist->author_id){
          return redirect('/gists')->with('error','Unauthorized page');
        }
        return view('gists.edit')->with('gist',$gist);
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
        $gist = Gist::find($id);

         //Check if the post is still within the 30 minutes window else prevent update!
        if (Carbon::now()>($gist->created_at->addMinutes(15))){
            return redirect('/gists')->with('error','More than 15 minutes have elapsed since you asked this question. You cannot edit the question!')->with('gist',$gist);
        }

        $this->validate($request,[
            'title'=>'required',
            'gist'=>'required'
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
       $gist = Gist::find($id);
       $gist->title = $request->input('title');
       $gist->gist = $request->input('gist');
    //    $post->user_id = auth()->user()->id;
    //    $post->cover_image = $fileNameToStore;
       $gist->save();

       return redirect('/gists')->with('success','Post Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gist = Gist::find($id);

        //Check if the post is still within the 15 minutes window else prevent delete!
        if (Carbon::now()>($gist->created_at->addMinutes(15))){
            return redirect('/gists')->with('error','More than 15 minutes have elapsed since you asked this question, You cannot delete this question!')->with('gist',$gist);
        }
        /*
        //Check for correct user...NOT NECESSARY SINCE CLIENT CANNOT HARD-TYPE IN BROWSER
        if(auth('web')->user()->id!==$gist->author_id){
            return redirect('/gists')->with('error','Unauthorized page');
        }
        */
        // if($post->cover_image !='noimage.jpg'){
        //     //Delete Image
        //     Storage::delete('public/cover_images/'.$post->cover_img);
        // }

        //Set as non-visible rather than delete!
        // $gist->visible = 0;
        // $gist->save();
        $gist->delete();
        return redirect('/gists')->with('success','Post Deleted'); 
    }
    
}
