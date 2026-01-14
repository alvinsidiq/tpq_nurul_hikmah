<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\ActivityLog;
use App\Models\User;
use App\Notifications\PasswordResetByAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()->with('roles')->latest()->paginate(12);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $req)
    {
        $data = $req->validated();
        if ($req->hasFile('foto')) {
            $data['foto_path'] = $req->file('foto')->store('users', 'public');
        }
        unset($data['foto']);
        $pwd = $data['password'];
        $data['password'] = Hash::make($pwd);
        $user = User::create($data);
        $user->syncRoles([$data['role']]);
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'create user','ref_type'=>'user','ref_id'=>$user->id]);
        return redirect()->route('admin.users.index')->with('success','Pengguna dibuat');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $req, User $user)
    {
        $data = $req->validated();
        if ($req->hasFile('foto')) {
            $data['foto_path'] = $req->file('foto')->store('users', 'public');
        }
        unset($data['foto']);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->syncRoles([$data['role']]);
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'update user','ref_type'=>'user','ref_id'=>$user->id]);
        return redirect()->route('admin.users.index')->with('success','Pengguna diperbarui');
    }

    public function destroy(User $user)
    {
        abort_if(auth()->id() === $user->id, 403);
        $user->delete();
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'delete user','ref_type'=>'user','ref_id'=>$user->id]);
        return back()->with('success','Pengguna dihapus');
    }

    public function resetPassword(User $user)
    {
        $new = Str::password(10);
        $user->forceFill(['password'=>Hash::make($new)])->save();
        $user->notify((new PasswordResetByAdmin($new))->onQueue('mail'));
        ActivityLog::create(['user_id'=>auth()->id(),'action'=>'reset pwd','ref_type'=>'user','ref_id'=>$user->id]);
        return back()->with('success','Password direset & dikirim via email');
    }
}
