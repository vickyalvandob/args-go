<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Auth;
use Alert;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $req)
    {
        $users = user::orderBy('id', 'ASC')->where(function ($query) use ($req) {
            if ($req->q) {
                $query->where('username', 'LIKE', "%{$req->q}%")->where('name', 'LIKE', "%{$req->q}%")->orWhere('email', 'LIKE', "%{$req->q}%")->orWhere('created_at', 'LIKE', "%{$req->q}%");
            }
        })->paginate(10);
        $users->appends($req->only('q'));
        if ($req->ajax()) {
            return view('multiauth::admin.user.table_user', ['users' => $users])->render();
        }
        return view('multiauth::admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('multiauth::admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'username' => ['required', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($request->password == $request->password_confirmation) {
            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password =  Hash::make($request->password);
            $user->username = $request->username;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->zipcode = $request->zipcode;
            $user->city = $request->city;
            $user->birth = $request->birth;
            if ($request->emailv) {
                $user->email_verified_at = Carbon::now();
            }
            $user->save();
            alert()->success('Successfully!');
        } else {
            alert()->info('Password not match!');
        }
        return redirect(route('admin.user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = user::find($id);
        return view('multiauth::admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::find($id);
        return view('multiauth::admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $userFind = User::where('id', '!=', $id)->where('email', $request->email)->first();
        if ($userFind) {
            alert()->info('Email has already been taken by ' . $userFind->name . '');
        } else {


            $user->email = $request->email;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->zipcode = $request->zipcode;
            $user->city = $request->city;
            $user->birth = $request->birth;
            if ($request->emailv) {
                $user->email_verified_at = Carbon::now();
            } else {
                $user->email_verified_at = null;
            }
            $user->save();
            alert()->success('Successfully!');
        }
        return redirect(route('admin.user.show', $user->id));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::find($id);
        $user->delete();

        alert()->success('Successfully!');
        return redirect()->back();
    }

    public function reset($id)
    {
        $user = User::find($id);
        $user->password = Hash::make('secret123');
        $user->save();
        alert()->success('Reset password to secret123')->persistent('Close');
        return redirect()->back();
    }


}
