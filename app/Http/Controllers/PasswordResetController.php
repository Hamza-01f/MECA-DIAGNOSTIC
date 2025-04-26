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

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
        
        //email starts here 
        $mail = new PHPMailer(true);
        
        try {
           
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'hamza.boumanjel@gmail.com'; 
            $mail->Password = ''; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587; 
    
            $mail->setFrom('MECA_DIAGNOSTICS@gmail.com', 'MECA_DIAGNOSTICS_Support');
            $mail->addAddress($request->email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Reinitialisation du mot de passe';
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
            <title>Réinitialisation du mot de passe</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color:rgb(245, 199, 199);
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    background-color:rgb(240, 192, 192);
                    padding: 20px;
                    margin: 0 auto;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px 0px #ccc;
                    text-align: center;
                }
                .button {
                    background-color:rgb(172, 179, 233);
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 5px;
                    display: inline-block;
                    margin-top: 20px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #777;
                }
            </style>
            </head>
            <body>
            <div class="container">
                <h1>Réinitialisation du mot de passe</h1>
                <h2>Bonjour,</h2>
                <h3>Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le bouton ci-dessous pour le réinitialiser :</h3>
                <a href="' . url('/resetpassword/' . $token) . '" class="button">Réinitialiser le mot de passe</a>
                <h3>Si vous n\'avez pas fait cette demande, ignorez cet e-mail.</h3>
                <div class="footer">
                    <h4>&copy; 2025 MECA_DIAGNOSTICS. Tous droits réservés.</h4>
                </div>
            </div>
            </body>
            </html>';
               
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
