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
use App\Models\Client;
use App\Models\Region;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name')->get();
        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::select('id', 'name')->orderBy('name')->get();
        if(count($states)>0){
            if(State::find(1)){
                $cities = State::find(1)->cities()->select('id','name','state_id')->orderBy('name')->get();
            }
        }else{
            $cities = City::select('id','name','state_id')->orderBy('name')->get();
        }
        $regions = Region::select('id','name')->orderBy('name')->get()->unique('name');
        return view('admin.clients.create',['states' => $states, 'cities' => $cities, 'regions' => $regions]);
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
                'clientName.required' => 'Please enter the field ',
                'siteName.required' => 'Please enter the field ',

                'regionName.required' => 'Please enter the region name!',
                'stateName.required' => 'Please enter the state name!',
                'cityName.required' => 'Please enter the city name!',

                'attendanceCycle.required' => 'Please enter the field ',
                'siteIncharge.required' => 'Please enter the field ',
                'remarks.required' => 'Please enter the field ',
            ];

            $validator = Validator::make($request->all(), [
                'clientName' => 'required',
                'siteName' => 'required|unique:clients,site',
                'regionName' => 'required',
                'stateName' => 'required',
                'cityName' => 'required',
                'attendanceCycle' => 'required',
                'siteIncharge' => 'required',
                'remarks' => 'required'
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('clients.create')
                            ->withErrors($validator)
                            ->withInput();
            }

            $client = Client::create([
                'name' => $request->clientName,
                'site' => $request->siteName,
                'state_id' => $request->stateName,
                'city_id' => $request->cityName,
                'region_id' => $request->regionName,
                'attendance_cycle' => $request->attendanceCycle,
                'incharge' => $request->siteIncharge,
                'remarks' => $request->remarks,
            ]);

            if($client){
                return redirect()->route('clients.index')
                ->with('success' , 'Client created successfully');
            }
        
        }
        return back()->withInput()->with('errors', 'Error creating new Client');
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
        $client = Client::find($id);
        // dd($client);
        $states = State::orderBy('name')->get();

        $cities = State::find($client->state_id)->cities()->orderBy('name')->get();
        $region = Region::find($client->region_id)->first();
        
        return view('admin.clients.edit', ['client'=>$client, 'cities'=>$cities,'states' => $states, 'region'=>$region]);
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
        $clientUpdate = Client::where('id', $id)
                                  ->update([
                                          'name' => $request->clientName,
                                          'site' => $request->siteName,
                                          'state_id' => $request->stateName,
                                          'city_id' => $request->cityName,
                                          'region_id' => $request->regionName,
                                          'attendance_cycle' => $request->attendanceCycle,
                                          'incharge' => $request->siteIncharge,
                                          'remarks' => $request->remarks,
                                  ]);
        
        if($clientUpdate){
            return redirect()->route('clients.index')
            ->with('success' , 'Client updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findClient = Client::find($id);
        if($findClient->delete()){
            
            //redirect
            return redirect()->route('clients.index')
            ->with('error' , 'Client deleted successfully');
        }
        
        return back()->withInput()->with('error' , 'Client could not be deleted');
    }
}
