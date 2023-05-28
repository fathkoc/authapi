<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\Users;

class AuthController extends Controller
{

    public function insert(Request $request)
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

    public function update(User $user, Request $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('passwor');
        $user->save(); 

        return response()->json(['success' => true, 'message' => 'Kullanıcı başarıyla güncellendi']);
    }

    public function delete(User $user)
    {
        try {
            $userId = $user->id; 
    
            $user->delete();
    
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
