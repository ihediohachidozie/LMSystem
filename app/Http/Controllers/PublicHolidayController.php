<?php

namespace App\Http\Controllers;

use App\PublicHoliday;
use Illuminate\Http\Request;

class PublicHolidayController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth')->except(['index']); // locking part of a controller
        $this->middleware('auth'); // locking all parts
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publicholidays = PublicHoliday::paginate(10);

        return view('publicholiday.index', compact('publicholidays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $publicholiday = new PublicHoliday();

        return view('publicholiday.create', compact('publicholiday'));
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
        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'publicholiday' => 'required',
                'date' => 'required',
            ]);
            $publicholiday = PublicHoliday::create($data);

            return redirect('publicholiday')->withStatus(__('Public Holiday successfully saved.'));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function show(PublicHoliday $publicholiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicHoliday $publicholiday)
    {
        //
        if(auth()->id() == 1)
        {
            return view('publicholiday.edit', compact('publicholiday'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicHoliday $publicholiday)
    {
        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'publicholiday' => 'required',
                'date' => 'required',
            ]);
             $publicholiday->update($data);
 
             return redirect('publicholiday')->withStatus(__('Public holiday successfully updated.'));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicHoliday  $publicHoliday
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicHoliday $publicholiday)
    {
        //
        if(auth()->id() == 1)
        {
              $publicholiday->delete();
  
              return redirect('publicholiday')->withStatus(__('Public Holiday successfully deleted.'));
        }
        return back();
    }
}
