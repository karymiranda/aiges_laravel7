<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Usuario;
use \App\Mail\ResetPasswordMail;

class ResetPasswordController extends Controller
{
    public function index()
    {
    return view('admin.reset.index', []);
    }

    public function generate()
    {

        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($pattern) - 1;

        for($i=0;$i < 8;$i++) 
            $key .= $pattern[ mt_rand(0,$max) ];

        return $key;
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $usuario = Usuario::where('name', $params['username'])->first();
        $password = $this->generate();
 
        if ($usuario->email) {
            try { 
Mail::to("kartacer@gmail.com")->send(new ResetPasswordMail($usuario, $password));

                $usuario->password = Hash::make($password);
                $usuario->save();

        return redirect('reset/1');
            } catch(\Exception $e) {
              //dd($e);
                return redirect('reset/0');
            }
        }
        return redirect('reset/2');
    }

    public function show($id)
    {
        return view('admin.reset.success', [
            'type'  => $id
        ]);
    }
}
