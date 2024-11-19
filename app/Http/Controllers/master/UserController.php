<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        $users = User::all();
        $activePage = 'user';

        return view('master.user_list', ['activePage' => $activePage,'users' => $users]);
    }
    public function add(){
        $activePage = 'user';

        return view('master.user_add', ['activePage' => $activePage,]);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:user,admin', // Validasi role
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'), // Simpan role
            ]);

            return redirect()->route('user.show')->with('success', 'Data pengguna berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $activePage = 'user';

        if (!$user) {
            abort(404); // Tampilkan halaman 404 jika pengguna tidak ditemukan
        }
        return view('master.user_edit', ['activePage' => $activePage,'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user.show')->with('success', 'Data pengguna berhasil dihapus!');
        } else {
            return redirect()->route('user.show')->with('error', 'Data pengguna tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'required|in:user,admin', // Validasi role
            ]);
    
            $user = User::find($id);
            if ($user) {
                $user->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'role' => $request->input('role'), // Update role
                ]);
    
                return redirect()->route('user.show')->with('success', 'Data pengguna berhasil diperbarui!');
            } else {
                return redirect()->route('user.show')->with('error', 'Data pengguna tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('user.show')->with('error', $e->getMessage());
        }
    }
    


}
