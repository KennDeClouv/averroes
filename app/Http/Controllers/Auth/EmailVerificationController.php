<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        !Auth::user()->hasVerifiedEmail() ? $this->sendVerificationEmail() : null;
        return view('auth.verify-email');
    }
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/account')->with('success', 'Email kamu berhasil diverifikasi!');
    }
    public function resend(Request $request)
    {
        $request->user()->hasVerifiedEmail() ? redirect('/account')->with('success', 'Email sudah diverifikasi.') : $this->sendVerificationEmail();
        return back()->with('success', 'Link verifikasi telah dikirim ulang ke email kamu!');
    }
    public function sendVerificationEmail()
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new VerifyEmailMail($user));
    }
}
