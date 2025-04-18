<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordResetController extends Controller
{
    public function showResetPassword()
    {
        return view('resetpassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(60);
        $resetLink = url('/resetpassword/' . $token);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
            $mail->Port = env('MAIL_PORT', 587);
    
            $mail->setFrom(env('MAIL_FROM_ADDRESS', 'MECA_DIAGNOSTICS@gmail.com'), 
                         env('MAIL_FROM_NAME', 'MECA_DIAGNOSTICS_Support'));
            $mail->addAddress($request->email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Reinitialisation du mot de passe';
            
            $mail->Body = View::make('password-recover', [
                'resetLink' => $resetLink
            ])->render();
               
            $mail->send();
    
            return back()->with('success', 'Un lien de réinitialisation a été envoyé à votre email.');
    
        } catch (Exception $e) {
            return back()->withErrors(['email' => "Échec de l'envoi de l'e-mail. Erreur: {$mail->ErrorInfo}"]);
        }
    }

    public function showResetForm($token)
    {
        return view('newpassword', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $resetData = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$resetData) {
            return back()->withErrors(['token' => 'Token invalide ou expiré.']);
        }

        $user = User::where('email', $resetData->email)->first();
        $user->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $resetData->email)->delete();

        return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}