<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Team;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

	/**
	 * Authenticated user leaves given team if user is member of it. Captain cannot leave team until he/she forwars the captain role
	 */
	public function leaveTeam($id){
		$team = Team::findOrFail($id);
		if($team->members()->get()->contains(Auth::user())){
			if($team->captain->id == Auth::user()->id){
				return Redirect::back()->withErrors('Captain cannot leave team. You must give someone captain role first'); //TODO tranlate
			}
			$team->members()->detach(Auth::user()->id);
			return Redirect::back();
		}
		return Redirect::back()->withErrors('You are not member of this team'); //TODO translate
	}

    /**
     * Accepts invitation from team
     */
	public function acceptInvitation($id){
		$team = Team::findOrFail($id);
		$team->sentInvitations()->detach(Auth::user()->id);
		$team->members()->attach(Auth::user()->id);
		return Redirect::back()->with('message', 'Invitation accepted'); //TODO translate
	}

    /**
     * Declines invitation from team
     */
	public function declineInvitation($id){
		$team = Team::findOrFail($id);
		$team->sentInvitations()->detach(Auth::user()->id);
		return Redirect::back()->with('message', 'Invitation declined'); //TODO translate
	}

    /**
     * Uploads avatar in images/ folder
     * @return string Html code of image
     */
    public function uploadAvatar(){
        if(is_array($_FILES)) {
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                $sourcePath = $_FILES['image']['tmp_name'];
                $targetPath = "images/".$_FILES['image']['name'];

                if(move_uploaded_file($sourcePath,$targetPath)) {
                    return "<img src=\"/$targetPath\" width=\"100%\" height=\"100%\" />";
                }
            }
        }
    }

    /**
     * Checks inserted nickname availability among all users via ajax request
     * @return string Html code to be build in view
     */
	public function checkUserNicknameAvailability(){
		if (Request::ajax()){
				$users = User::all();
				foreach ($users as $user) {
					if ($user->nickname == Input::get('nickname')) {
						$msg = trans('messages.nickname-not-available');
						$html = "<span class=\"red-text\" data-tip=\"$msg\"><i class=\"fa fa-times\"></i></span>";
						return $html;
					}
				}
				$msg = trans('messages.nickname-available');
				$html = "<span class=\"green-text\" data-tip=\"$msg\"><i class=\"fa fa-check\"></i></span>";

				return $html;
		}else{
			$html = "Not ajax request";
			return $html;
		}
	}

    /**
     * Checks inserted email availability among all users via ajax request
     * @return string Html code to be build in view
     */
    public function checkUserEmailAvailability(){
        if (Request::ajax()){
            $users = User::all();
            foreach ($users as $user) {
                if ($user->email == Input::get('email')) {
                    $msg = trans('messages.email-not-available');
                    $html = "<span class=\"red-text\" data-tip=\"$msg\"><i class=\"fa fa-times\"></i></span>";
                    return $html;
                }
            }
            $msg = trans('messages.email-available');
            $html = "<span class=\"green-text\" data-tip=\"$msg\"><i class=\"fa fa-check\"></i></span>";

            return $html;
        }else{
            $html = "Not ajax request";
            return $html;
        }
    }
	/**
	 * Display a listing of the users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::orderBy('created_at', 'desc')->paginate(10);
		return view('/users/users', ['users' => $users]);
	}

	/**
	 * Display the user.
	 *
	 * @param  int  $id id of league which shold be shown
	 * @return Response view with information about league
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
        $roles = Role::all();
		return view('/users/user-details', ['user' => $user, 'roles' => $roles]);
	}

	/**
	 * Remove the user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		$isAdmin = false;
		foreach($user->roles()->get() as $role){
			if($role->name == "admin"){
				$isAdmin = true;
			}
		}
		if(!$isAdmin || Auth::user()->nickname == $user->nickname) {
			$user->roles()->detach(); //delete record in pivot table
			$user->delete();
			return redirect('/users');
		}else{

			$errorMsg = "The user ".$user->nickname." is another admin. Can't delete it. Admin can only delete himself"; //TODO translate
			return redirect('/users')->withErrors([$errorMsg]);
		}
	}

}
