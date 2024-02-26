<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\UpdateSeeker;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class SeekerController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        return view('admin.seekers.index', [
            'seekers' => User::filter($request->toArray())->where('role', Role::CommonUser)->paginate()
        ]); 
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('admin.seekers.edit', [
            'user' => $user,
            'countries' => Country::orderBy('name')->get(),
            'roles' => Role::cases(),
        ]);
    }

    public function update(UpdateSeeker $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->validated();
        if ($request->photo) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);

        if ($request->user()->isServiceProvider()) {
            return redirect()->route('dashboard');
        }

        return to_route('seekers.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);
        $user->delete();

        return to_route('seekers.index');
    }
}
