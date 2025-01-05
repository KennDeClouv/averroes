<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('common.account.index');
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah ada',
        ]);
        if ($request->password) {
            $request->validate(['password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Z]).+$/'], [
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password tidak cocok',
                'password.regex' => 'Password harus mengandung setidaknya satu huruf besar',
            ]);
            $validated['password'] = $request->password;
        }
        if ($request->photo) {
            if (preg_match('/^data:image\/(\w+);base64,/', $request->photo)) {
                $validated['photo'] = $request->photo;
            } else {
                throw new \Exception('Invalid base64 image');
            }
        }
        $user->update($validated);
        return redirect()->route('account.index')->with('success', 'Profile berhasil diperbarui!');
    }
    public function updateStudent(UserRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address' => 'nullable|string|max:255',
        ]);
        Student::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account.index')->with('success', 'Santri berhasil diperbarui.');
    }
    public function updateTeacher(UserRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'ktp' => 'nullable|string|max:20',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'address' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'ktp.max' => 'KTP maksimal 20 karakter',
            'birth_place.required' => 'Tempat lahir harus diisi',
            'birth_date.required' => 'Tanggal lahir harus diisi',
            'address.max' => 'Alamat maksimal 255 karakter',

        ]);
        Teacher::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account.index')->with('success', 'Ustadz berhasil diperbarui.');
    }
}
