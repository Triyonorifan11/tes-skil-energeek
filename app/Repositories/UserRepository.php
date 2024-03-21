<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

	public function findById($id, $withRelations = [], $method = 'findOrFail')
    {
        $user = User::with($withRelations)->$method($id);

        return $user;
    }

	public function findUserLogin($username, $password){
		$user = User::where('email', $username)->first();
		if($user){
			if(Hash::check($password, $user->password)){
				return $user;
			}else{
				return null;
			}
		}else{
			return null;
		}
	}

    public function findByIdHash($id, $withRelations = [], $method = 'firstOrFail')
    {
        $user = User::with($withRelations)->where('id_hash', $id)->$method();

        return $user;
    }

}
