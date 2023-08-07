<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class DepartmentsController extends Controller
{
    public function load(int $countryId=0):JsonResponse
    {
        $Departments["data"]=Department::orderby("name","asc")->select('id','name')->where('country_id',$countryId)->get();
        return response()->json($Departments);
    }
}
