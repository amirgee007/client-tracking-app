<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }


    public function show(){

        #no need any AUTH here
        $counter = Counter::first();
        return view('show' ,compact('counter'));
    }

    public function home()
    {
        $user = auth()->user();
        $counter = Counter::first();

        if($user->role == 'admin'){
            return view('home' ,compact('counter'));
        }
        else{
            return view('live' ,compact('counter'));
        }
    }

    public function updateCounter(Request $request) {
        if($request->ajax()) {
            try {

                $counter = Counter::first();

                if($request->type == 'increment')
                    $counter->counter = $counter->counter+1;
                else
                    $counter->counter = $counter->counter-1;

                $counter->save();

                $response = ['counter' => $counter->counter];

                return response()->json($response);


            } catch (\Exception $ex) {

                $counter = Counter::first();

                $response = ['counter' => $counter->counter];
                return response()->json($response);

            }
        }
    }


    public function getLatestCount(Request $request) {

        if($request->ajax()) {
            $counter = Counter::first();
            $response = ['counter' => $counter->counter ,'message' => "Last refresh at ".now()];
            return response()->json($response);
        }
    }


    public function resetCounter(Request $request){

        $counter = Counter::first();
        $counter->counter = $request->counter;
        $counter->save();

        return back();

    }
}
