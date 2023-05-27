<?php

// UserController.php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function insert(UserRequest $request)
    {
        // Verilen UserModel'ı için geçerli validasyonu geçtiği varsayılan ekleme işlemi
    }

    public function list()
    {
        // Kullanıcı listeleme işlemi
    }

    public function update(User $user, UserRequest $request)
    {
        // Belirli bir kullanıcıyı güncelleme işlemi
    }

    public function delete(User $user)
    {
        // Belirli bir kullanıcıyı silme işlemi
    }

    public function destroy(User $user)
    {
        // Belirli bir kullanıcıyı kalıcı olarak silme işlemi
    }
}
