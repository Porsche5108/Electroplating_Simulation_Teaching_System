<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;

class UsersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['show',  'edit', 'update', 'index', 'destroy', 'create', 'home']
        ]);
    }

    public function home()
    {
        return view('users.home');
    }

    public function index()
    {
        $users = User::paginate(15);
        $this->authorize('create', Auth::user());
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', Auth::user());
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '创建用户成功！');
        return back();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'confirmed|min:6'
        ]);



        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {

            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
