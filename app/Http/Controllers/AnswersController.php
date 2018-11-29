<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Answer;
use GistMed\Gist;

class AnswersController extends Controller
{
     /**
     * Store a newly created answer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
       //Validate Inputs   
      $this->validate($request,[
        'answer'=>'required'
        ]);

        $gist = Gist::find($id);
        //Create Gist
        $answer = new Answer;
        $answer->answer = $request->input('answer');
        $answer->expert_id = auth('expert')->user()->id;
        $answer->gist()->associate($gist);
        $answer->save();

        return redirect('/gists/'.$id)->with('success','Answer Submitted.'); 
    }

   
}
