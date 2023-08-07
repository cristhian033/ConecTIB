<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CitiesController extends Controller
{
    public function load(int $departmentId=0):JsonResponse
    {
        $cities["data"]=City::orderby("name","asc")->select('id','name')->where('department_id',$departmentId)->get();
        return response()->json($cities);
    }
}
