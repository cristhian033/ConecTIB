<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class UsersController extends Controller
{


    public function show():View
    {
        return view('users/Users');
    }

    public function getUsers(Request $request):JsonResponse
    {
        if ($request->ajax()) {
            $users=User::orderby("name","asc")->with("city")->get();
            return Datatables::of($users)->make(true);
         }
    }

    public function editUser(int $userId=0):View
    {
        $user=User::find($userId);
        $cities=City::orderby("name","asc")->where("department_id",$user->city->department_id)->get();
        $departments=Department::orderby("name","asc")->where("country_id",$cities[0]->department->country_id)->get();
        $countries=Country::orderby("name","asc")->get();
        return View('users/edit',compact(['user','cities','departments','countries']));
    }

    public function deleteUser(int $userId=0)
    {
        $user=User::find($userId);
        $user->delete();
        return Redirect::route('user.show')->with('status', 'profile-deleted');
    }

    public function saveEditUser(int $userId=0, Request $request):RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['sometimes','nullable','string', 'max:10', 'min:10'],
            'birth_date' => ['required','date', 'before:'.now()->subYears(18)->toDateString()],
            'city_id' => ['required'],
        ]);

        $user=User::find($userId);
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->birth_date=$request->birth_date;
        $user->city_id=$request->city_id;
        $user->save();

        return Redirect::route('user.show')->with('status', 'profile-updated');
    }

}
