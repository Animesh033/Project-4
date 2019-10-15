<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
 * added by animesh
*/
use Validator;
use Illuminate\Support\Facades\Auth; 
use App\Models\State;
use App\Models\City;
use App\Models\Region;
use App\Models\StateCityRegion;
use DB;
class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = State::find(4);
        // return $post->regions;
        // $regions = Region::orderBy('name')->get();
        // // dd($cities);
        // return view('admin.regions.index',compact('regions'));
        $regions = Region::select('id','name','state_id', 'city_id')->orderBy('name')->get();
        $states = State::select('id', 'name')->orderBy('name')->get();
        if(count($states)>0){
            if(State::find(1)){
                $cities = State::find(1)->cities()->select('id','name','state_id')->orderBy('name')->get();
            }
        }else{
            $cities = City::select('id','name','state_id')->orderBy('name')->get();
        }
        // dd($cities);
        return view('admin.regions.index',compact('regions','states','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $states = State::all();
        // $cities = City::all();
        // if(count($states) > 0 && count($cities) > 0){
        //     $cities = State::find(1)->cities()->select('id', 'name')->orderBy('name')->get();
        //     if(count($cities) > 0){
        //         return view('admin.regions.create',['states' => $states, 'cities' => $cities]);
        //     }
        // }
        // return view('admin.regions.create',['states' => $states, 'cities' => $cities]);
        $states = State::select('id', 'name')->orderBy('name')->get();
        $cities = City::select('id', 'name', 'state_id')->orderBy('name')->get();
        if(State::find(1)){
            $cities = State::find(1)->cities()->select('id', 'name', 'state_id')->orderBy('name')->get();
            if(count($cities) > 0){
                return view('admin.regions.create',['states' => $states, 'cities' => $cities]);
            }
        }
        return view('admin.regions.create',['states' => $states, 'cities' => $cities]);
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
                'regionName.required' => 'Please enter the region name!',
                'stateName.required' => 'Please enter the state name!',
                'cityName.required' => 'Please enter the city name!',
            ];

            $validator = Validator::make($request->all(), [
                'regionName' => 'required|max:255',
                'stateName' => 'required',
                'cityName' => 'required|unique:regions,city_id|max:255',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('regions.create')
                            ->withErrors($validator)
                            ->withInput();
            }
            // $findRegion = Region::where('name', $request->regionName)->first();
            // if (count($findRegion) > 0) {
            //     $regionId = $findRegion->id;
            // }else{
            //     $region = Region::create([
            //         'name' => $request->regionName,
            //     ]);
            //     $regionId = $region->id;
            // }
            

            // $stateCityRegion = StateCityRegion::create([
            //     'state_id' => $request->stateName,
            //     'city_id' => $request->cityName,
            //     'region_id' => $regionId,
            // ]);

            $region = Region::create([
                'name' => $request->regionName,
                'state_id' => $request->stateName,
                'city_id' => $request->cityName,
            ]);

            if($region){
                return redirect()->route('regions.index')
                ->with('success' , 'Region created successfully');
            }
        
        }
        return back()->withInput()->with('errors', 'Error creating new Region');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        // $region2 = Region::find($region->id);
        
        // $states = State::all();

        // $cities = State::find(1)->cities()->get();
        
        // return view('admin.regions.edit', ['region'=>$region2, 'cities'=>$cities,'states' => $states]);
        $region2 = Region::find($region->id);
        
        $states = State::all();
        if(State::find($region2->state_id)){
            $cities = State::find($region2->state_id)->cities()->get();
        }else{
            if(State::find(1)){
                $cities = State::find(1)->cities()->get();    
            }else{
                $cities = City::all();
            }
        }
        
        return view('admin.regions.edit', ['region'=>$region2, 'cities'=>$cities,'states' => $states]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $regionUpdate = Region::where('id', $region->id)
                                  ->update([
                                          'name' => $request->regionName,
                                          'state_id' => $request->stateName,
                                          'city_id' => $request->cityName,
                                  ]);
        
        if($regionUpdate){
            return redirect()->route('regions.index')
            ->with('success' , 'Region updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $findRegion = Region::find($region->id);
        if($findRegion->delete()){
            
            //redirect
            return redirect()->route('regions.index')
            ->with('success' , 'Region deleted successfully');
        }
        
        return back()->withInput()->with('error' , 'Region could not be deleted');
    }

    public function city(Request $request)
    {
        $cities = State::find($request->state_id)->cities()->select('id', 'name')->orderBy('name')->get();
        return response()->json(['cities'=> $cities]);
    }

    public function region(Request $request)
    {
        $regions = Region::where([
                  ['state_id', '=', $request->state_id],
                  ['city_id', '=', $request->city_id],
                ])
                ->select('id', 'name')
                ->get();
        return response()->json(['regions'=> $regions]);
    }
}
