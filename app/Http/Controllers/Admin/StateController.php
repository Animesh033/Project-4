<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
 * added by animesh
*/
use Validator;
use Illuminate\Support\Facades\Auth;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::select('id', 'name')->orderBy('name')->get();
        return view('admin.states.index',['states'=> $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $messages = [
                'stateName.required' => 'Please enter the state name!',
            ];

            $validator = Validator::make($request->all(), [
                'stateName' => 'required|unique:states,name|max:255',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('states.create')
                            ->withErrors($validator)
                            ->withInput();
            }

            $state = State::create([
                'name' => $request->stateName,
            ]);

            if($state){
                return redirect()->route('states.index')
                ->with('success' , 'State created successfully');
            }
        
        }
        return back()->withInput()->with('errors', 'Error creating new state');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $state = State::find($state->id);
        
        return view('admin.states.edit', ['state'=>$state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $stateUpdate = State::where('id', $state->id)
                                  ->update([
                                          'name'=> $request->input('stateName'),
                                  ]);
        
        if($stateUpdate){
            return redirect()->route('states.index')
            ->with('success' , 'State updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $findstate = State::find($state->id);
        if($findstate->delete()){
            
            //redirect
            return redirect()->route('states.index')
            ->with('success' , 'State deleted successfully');
        }
        
        return back()->withInput()->with('error' , 'State could not be deleted');
    }
}
