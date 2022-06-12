<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CollectiveRequest;
use App\Models\Collective;
use Illuminate\Support\Facades\Redirect;

class CollectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $collectives = Collective:: where('user_id',auth()->user()->id)->latest()->paginate(2);
       return view ('collectives.index')->with([
           'collectives'=> $collectives
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('collectives.create')->with ([
           'categories'=> $category
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectiveRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($request->title);      
        Collective::create($data);
        return Redirect()->route('collectives.index')->with([
           'success'=> 'Collective added successfly '
        ]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collective $collective)
    {
        return view ('collectives.show')->with([
            'collective'=> $collective
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collective $collective)
    {
        $category = Category::all();
    return view('collectives.edit')->with([
              'collective'=> $collective,
              'categories'=>$category
    ]);
    

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collective $collective)
    {
        if ($collective->owner($collective->user_id))
        {
         $this->validate ($request,[
             'title' => 'required|min:5|unique:collectives,id,'. $collective->id,
             'description' => 'required|min:10',
             'category_id' => 'required|numeric'
 
         ]);
         $data = $request->except('_token', '_methode');
         $data['user_id'] = auth()->user()->id;
         $data['slug'] = Str::slug($request->title);      
         $collective->update($data);
         return Redirect()->route('collectives.index')->with([
            'success'=> 'Collective update successfly '
         ]);
 
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collective $collective)
    {
        if($collective->owner($collective->user_id))
        {
                  $collective->delete();
                  return Redirect()->route('collectives.index')->with([
                      'success'=>'collective delete successfuly'
                  ]);
        }
        //
        abort(403);
    }
}
