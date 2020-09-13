<?php

namespace App\Http\Controllers;

use App\EmailModification;
use Illuminate\Http\Request;

class EmailModificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        return view('auth.email.modify');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\EmailModification  $emailModification
     * @return \Illuminate\Http\Response
     */
    public function show(EmailModification $emailModification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmailModification  $emailModification
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailModification $emailModification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmailModification  $emailModification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailModification $emailModification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmailModification  $emailModification
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailModification $emailModification)
    {
        //
    }
}
