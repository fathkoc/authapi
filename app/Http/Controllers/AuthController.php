<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\Users;


class AuthController extends Controller
{

    public function insert(AuthRequest $request)
    {  
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $users = new Users();
        $users->name = $name;
        $users->email = $email;
        $users->password = bcrypt($password);
        $users->save();
        
        return response()->json(['success' => true, 'message' => 'Kullanıcı başarıyla eklendi']);
    }

    public function list()
    {
        $users = Users::all(); 

        return response()->json(['success' => true, 'data' => $users]);
    }

    public function update(Users $users ,  AuthRequest $request)
    {   
        if (!$users) {
            return response()->json(['success' => false, 'message' => 'Kullanıcı bulunamadı'], 404);
        }
        //dd($request);
        $users->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $users->save(); 

        return response()->json(['success' => true, 'message' => 'Kullanıcı başarıyla güncellendi']);
    }

    public function delete(Users $users)
    {
        try {
           
            $users->delete();
    
            return response()->json(['success' => true, 'message' => 'Kullanıcı başarıyla silindi']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Kullanıcı silme işleminde hata oluştu'], 500);
        }
    }

    public function destroy(Request $user)
    {
        //bilmem
    }
}
