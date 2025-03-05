<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        $mail = new PHPMailer(true);
        
        try {
           
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'hamza.boumanjel@gmail.com'; 
            $mail->Password = 'rcgq dikr qxgm oilh'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587; 
    
            $mail->setFrom('MECA_DIAGNOSTICS@gmail.com', 'Support');
            $mail->addAddress($request->email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Reinitialisation du mot de passe';
            $mail->Body = "Cliquez ici pour réinitialiser votre mot de passe: 
                <a href='" . url('/resetpassword/' . $token) . "'>Réinitialiser le mot de passe</a>";
                // Send Email
            $mail->send();

    
            return back()->with('success', 'Un lien de réinitialisation a été envoyé à votre email.');
    
        } catch (Exception $e) {
            return back()->withErrors(['email' => "Échec de l'envoi de l'e-mail. Erreur: {$mail->ErrorInfo}"]);
        }

        // Mail::raw("Cliquez ici pour réinitialiser votre mot de passe: " . url('/resetpassword' . $token), function ($message) use ($request) {
        //     $message->to($request->email)
        //         ->subject('Réinitialisation du mot de passe');
        // });

        // return back()->with('success', 'Un lien de réinitialisation a été envoyé à votre email.');
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
