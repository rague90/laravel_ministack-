<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Question;
use App\Models\Collective;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth','verified'])->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::where('user_id',auth()->user()->id)->latest()->paginate(3);
        return view('questions.index')->with([
            'questions'=>$question,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       $collective = Collective::all();
       $category = Category::all();
        return view ('questions.create')->with([
            'collectives'=>$collective,
            'categories' =>$category
        ]);
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
              'title'=> 'required|min:5|unique:questions',
              'body'=>  'required|min:10',
              'category_id' => 'required|numeric',
              'collective_id' => 'required|numeric',
          ]);
          $data = $request->except('_token');
          $data['user_id'] = auth()->user()->id;
          $data ['slug']= Str::slug($request->title);
          Question::create($data);
          return Redirect()->route('questions.index')->with([
            'success'=> 'question added successfly '
         ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        $categories = Category::all();
        $collectives = Collective::all();
        return view ('questions.edit')->with([
               'categories' => $categories,
               'collectives' => $collectives,
               'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        if ($question->owner($question->user_id))
        {
        $this->validate ($request,[
            'title' => 'required|min:5|unique:questions,id,'. $question->id,
            'body' => 'required|min:10',
            'category_id' => 'required|numeric',
            'collective_id' => 'required|numeric'

        ]);
        $data = $request->except('_token', '_methode');
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->title);      
        $question->update($data);
        return Redirect()->route('questions.index')->with([
           'success'=> 'Question update successfly '
        ]);
        abort(403);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
     
        if ($question->owner($question->user_id))
        {
         
         $question->delete();
         return Redirect()->route('questions.index')->with([
            'success'=> 'Question Delelte successfly '
         ]);
 
        }
        abort(403);
     
    }
}
