<?php

namespace App\Repository;
use App\Models\User;
use App\Repository\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
  protected $user = null;

  public function getAllUsers(){
	return user::all();
  }

  public function getUserById($id){
	return User::find($id);
  }

  public function createOrUpadet($id=null, $collection = []){
   if(is_null($id)){
       $user = new User;
	   $user->name = $collection['name'];
	   $user->email = $collection['email'];
	   $user->password = Hash::make($collection['password']);
	   return $user->save();
   }else{
	$user = User::find($id);
	$user->name = $collection['name'];
	$user->email = $collection['email'];
	return $user->save();
   }

  }


  public function deleteUser($id){
	return User::find($id)->delete();
  }
}