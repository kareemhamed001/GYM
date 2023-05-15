<?php

namespace App\Http\Controllers\coach\user;

use App\classes\user\UserClass;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role=2;
        $users=User::where('role_as',2)->paginate();
        return view('coach.users.index',compact('users','role'));
    }

    function coaches(){
        $role=1;
        $users=User::where('role_as',1)->paginate();
        return view('coach.users.index',compact('users','role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=2;
        return view('coach.users.create',compact('role'));
    }
    public function createCoach()
    {
        $role=1;
        return view('coach.users.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);

        return view('coach.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
