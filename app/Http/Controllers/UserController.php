<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repository\IUserRepository;
use App\Reposotory\UserRepository;

class UserController extends controller{
	public $user;
	public function __construct(IUserRepository $user){
		$this->user =$user; 
	}

	public function showUsers(){
       $users = $this->user->getAllUsers();
	   $users->load('country');
	   return View::make('user.index', compact('users'));
	}

	public function createuser(){
		return view('user.edit');
	}

	public function getUser($id){
		$user=  $this->user-getUserById($id);

		return view::make('user.edit', compact('user'));
	}

	public function saveUser(request $request, $id=null){
		$collection = $request->except(['method', '_token']);
		if(!is_null($id)){
			$this->user->createOrUpdate($id, $collection);
		}else{
			$this->user->createOrUpdate($id=null, $collection);
		}
return redirect()->route('user.list');

	}


	public function deleteUser($id){
		$this->user->deleteUser();
		return redirect()->route('user.list');
	}
}
