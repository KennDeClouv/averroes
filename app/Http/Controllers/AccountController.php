<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Imam;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserShortcut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private function uploadPhoto($photo, $oldPhoto = null)
    {
        if ($oldPhoto && file_exists(public_path($oldPhoto))) {
            unlink(public_path($oldPhoto));
        }
        if ($photo) {
            if (preg_match('/^data:image\/(\w+);base64,/', $photo, $type)) {
                $photo = substr($photo, strpos($photo, ',') + 1);
                $type = strtolower($type[1]);
                if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                    throw new \Exception('Invalid image type');
                }
                $photo = base64_decode($photo);
                if ($photo === false) {
                    throw new \Exception('Base64 decode failed');
                }
                $filename = uniqid() . '_' . time() . '.' . $type;
                $path = public_path('uploads/photo/') . $filename;
                file_put_contents($path, $photo);
                return 'uploads/photo/' . $filename;
            } elseif ($photo instanceof \Illuminate\Http\UploadedFile) {
                $filename = uniqid() . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/photo/'), $filename);
                return 'uploads/photo/' . $filename;
            }
        }
        return null;
    }
    public function index()
    {
        return view('account.index');
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5000',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah ada',
            'photo.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, atau gif.',
            'photo.max' => 'Foto maksimal 5MB.',
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
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $validated['photo'] = $this->uploadPhoto($request->file('photo'));
        }
        $user->update($validated);
        return redirect()->route('account.index')->with('success', 'Profile berhasil diperbarui!');
    }
    public function updateStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'address' => 'nullable|string|max:255',
        ]);
        Student::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account.index')->with('success', 'Santri berhasil diperbarui.');
    }
    public function updateTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'ktp' => 'nullable|string|max:20',
            'birthplace' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'address' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'ktp.max' => 'KTP maksimal 20 karakter',
            'birthplace.required' => 'Tempat lahir harus diisi',
            'birthdate.required' => 'Tanggal lahir harus diisi',
            'address.max' => 'Alamat maksimal 255 karakter',
            
        ]);
        Teacher::where('user_id', Auth::id())->firstOrFail()->update($validated);
        return redirect()->route('account.index')->with('success', 'Ustadz berhasil diperbarui.');
    }
}
