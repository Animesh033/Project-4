<?php

namespace App\Http\Controllers\Admin\Audit;
use App\Http\Controllers\Controller; //added
use App\Models\Admin\AuditSchedule;
use Illuminate\Http\Request;

class AuditScheduleController extends Controller
{
    /**
      * Create a new controller instance.
      *
      * @return void
      */
    public function __construct()
    {
        // $this->middleware(['auth:admin', 'admin.verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.audits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.audits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\AuditSchedule  $auditSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(AuditSchedule $auditSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\AuditSchedule  $auditSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditSchedule $auditSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\AuditSchedule  $auditSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditSchedule $auditSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\AuditSchedule  $auditSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditSchedule $auditSchedule)
    {
        //
    }
}
