<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Country;
use App\Model\State;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function state(Request $request, $id)
    {
        $state=State::where('country_id', $id)->get();
        return response()->json(
            [
                "success"=>true,
                "data"=>StateResource::collection($state),
                "message"=> 'State List out Successfully'
            ],
            200
        );
    }

    public function country(Request $request)
    {
        $country = Country::all();
        // $state=State::where('country_id', $request->country_id)->get();
        return response()
                ->json(
                    [
                        "success"=>true,
                        "data"=>CountryResource::collection($country),
                        "message"=> 'Country List out Successfully'
                    ],
                    200
                );
    }
}
