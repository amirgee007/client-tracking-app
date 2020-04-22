<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{

    public function welcome(){

        $counter = Counter::first();
        return view('welcome' ,compact('counter'));
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

    public function show(){

        $counter = Counter::first();
        return view('show' ,compact('counter'));

    }

    public function resetCounter(Request $request){

        $counter = Counter::first();
        $counter->counter = $request->counter;
        $counter->save();

        return back();

    }
}
