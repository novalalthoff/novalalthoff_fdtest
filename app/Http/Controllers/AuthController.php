<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', ['title' => "Sign In"]);
    }

    public function loginRules(Array $request)
    {
        $rules = [
            'email' => 'required|max:255',
            'password' => 'required|max:255'
        ];
        $messages = [
            'email.required' => 'Email still empty!',
            'password.required' => 'Password still empty!'
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function loginProcess(Request $request)
    {
        $validator = $this->loginRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return response()->json(['status' => false, 'message' => "User not found!"]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => "Invalid email or password!"]);
        }

        if (empty($user->email_verified_at)) {
            $code = strval(rand(100000, 999999));
            VerificationCodeModel::create([
                'user_id' => $user->id,
                'code' => $code,
                'status' => 1
            ]);

            // Mail::to($user->email)->send(new VerificationCodeMail($code));

            return response()->json(['status' => true, 'message' => "Now verify your email first!!", 'url' => "verify/".$user->id]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return response()->json(['status' => true, 'message' => "Login succeed!", 'url' => "home"]);
        } else {
            return response()->json(['status' => false, 'message' => "Invalid email or password!"]);
        }
    }

    public function register()
    {
        return view('auth.register', ['title' => "Create Account"]);
    }

    public function registerRules(Array $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255'
        ];
        $messages = [
            'name.required' => 'Nama still empty!',
            'email.required' => 'Email still empty!',
            'password.required' => 'Password still empty!'
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function registerProcess(Request $request)
    {
        $validator = $this->registerRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $code = strval(rand(100000, 999999));
            $verif = VerificationCodeModel::create([
                'user_id' => $user->id,
                'code' => $code,
                'status' => 1
            ]);

            if ($user && $verif) {
                DB::commit();
                Mail::to($user->email)->send(new VerificationCodeMail($code));
                return response()->json(['status' => true, 'message' => "Nice, now verify your account!", 'url' => "verify/".$user->id]);
            } else {
                return response()->json(['status' => false, 'message' => "Failed to register!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function verify($id)
    {
        $user = User::find($id);

        if (empty($user) || isset($user->email_verified_at)) {
            return response(status: 400);
        }

        return view('auth.verify', [
            'user' => $user,
            'title' => "Account Verification"
        ]);
    }

    public function verifyRules(Array $request)
    {
        $rules = [
            'code' => 'required|string|max:255'
        ];
        $messages = [
            'code.required' => 'Verification code still empty!'
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function verifyProcess($id, Request $request)
    {
        $validator = $this->verifyRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::find($id);

        if (empty($user) || isset($user->email_verified_at)) {
            return response()->json(['status' => false, 'message' => "Invalid Request!"]);
        }

        $verif = VerificationCodeModel::where('user_id', $user->id)->where('status', 1)->latest()->first();

        if ($verif->code != $request->code) {
            return response()->json(['status' => false, 'message' => "Invalid verification code!"]);
        }

        DB::beginTransaction();
        try {
            $user->email_verified_at = now();
            $save = $user->save();

            VerificationCodeModel::where('user_id', $user->id)->update(['status' => 0]);

            if ($save) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Good job! Now enjoy.", 'url' => "login"]);
            } else {
                return response()->json(['status' => false, 'message' => "Verification failed!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function verifyResend(Request $request)
    {
        if (isset($request->id)) {
            $user = User::find($request->id);
        } else {
            if (empty($request->email)) {
                return response()->json(['status' => false, 'message' => "Fill your email!"]);
            }
            $user = User::where('email', $request->email)->first();
        }

        if (empty($user)) {
            return response()->json(['status' => false, 'message' => "User not found!!"]);
        }

        DB::beginTransaction();
        try {
            $verif = VerificationCodeModel::where('user_id', $user->id)->where('status', 1)->get();
            if (count($verif) > 0) {
                DB::table('verification_code')->where('user_id', $user->id)->where('status', 1)->update(['status' => 0]);
            }

            $code = strval(rand(100000, 999999));
            $save = VerificationCodeModel::create([
                'user_id' => $user->id,
                'code' => $code,
                'status' => 1
            ]);

            if ($save) {
                DB::commit();
                Mail::to($user->email)->send(new VerificationCodeMail($code));
                return redirect()->back();
            } else {
                return response()->json(['status' => false, 'message' => "Failed to send verification code!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function forgot()
    {
        return view('auth.forgot-password', ['title' => "Forgot Password?"]);
    }

    public function forgotRules(Array $request)
    {
        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed',
            'code' => 'required|max:6'
        ];
        $messages = [
            'email.required' => 'Email still empty!',
            'password.required' => 'Password still empty!',
            'code.required' => 'Verification code still empty!',
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function forgotProcess(Request $request)
    {
        $validator = $this->forgotRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return response()->json(['status' => false, 'message' => "User not found!"]);
        }

        $verif = VerificationCodeModel::where('user_id', $user->id)->where('status', 1)->latest()->first();

        if ($verif->code != $request->code) {
            return response()->json(['status' => false, 'message' => "Invalid verification code!"]);
        }

        DB::beginTransaction();
        try {
            $user->password = Hash::make($request->password);
            $save = $user->save();

            VerificationCodeModel::where('user_id', $user->id)->update(['status' => 0]);

            if ($save) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Succeed, now login to your account!", 'url' => "login"]);
            } else {
                return response()->json(['status' => false, 'message' => "Process failure!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function changePassRules(Array $request)
    {
        $rules = [
            'password' => 'required|min:8|max:255',
            'password_new' => 'required|min:8|max:255'
        ];
        $messages = [
            'password.required' => 'Password still empty!',
            'password_new.required' => 'New Password still empty!'
        ];
        return Validator::make($request, $rules, $messages);
    }

    public function changePassProcess($id, Request $request)
    {
        $validator = $this->changePassRules($request->all());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::find($id);

        if (empty($user)) {
            return response()->json(['status' => false, 'message' => "User not found!"]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status' => false, 'message' => "Invalid password!"]);
        }

        DB::beginTransaction();
        try {
            $user->password = Hash::make($request->password_new);
            $save = $user->save();

            if ($save) {
                DB::commit();
                return response()->json(['status' => true, 'message' => "Password successfully changed!", 'url' => ""]);
            } else {
                return response()->json(['status' => false, 'message' => "Process failure!"]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }

    public function logoutGet(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/');
    }
}
