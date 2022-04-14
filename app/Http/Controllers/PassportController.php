<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassportRequest;
use App\Http\Requests\UpdatePassportRequest;
use App\Models\Passport;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePassportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePassportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Http\Response
     */
    public function show(Passport $passport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Http\Response
     */
    public function edit(Passport $passport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePassportRequest  $request
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePassportRequest $request, Passport $passport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Passport  $passport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passport $passport)
    {
        //
    }
}
