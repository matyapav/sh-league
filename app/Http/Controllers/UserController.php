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
     * Forwards captain role to another team member
     * @param $id Id of new captain
     * @return mixed redirection back with error or success msg
     */
    public function forwardCaptainRole($id){
        if(!array_key_exists('fwd_cpt_team_id', Input::all())){
            return Redirect::back()->withErrors(trans('messages.forward-team-not-specified'));
        }
        $user = User::findOrFail($id);
        $team = Team::findOrFail(Input::all()['fwd_cpt_team_id']);
        if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
            if(!$team->members()->get()->contains($user)){
                return Redirect::back()->withErrors(trans('messages.forward-not-member'));
            }
            $team->captain()->associate($user)->save();
            $msg = trans('messages.forwarded-to').$user->nickname;
            return Redirect::back()->with('message', $msg);
        } else{
            return Redirect::back()->withErrors(trans('messages.not-captain-or-admin'));
        }
    }

    /**
     * Kick user out of the team
     *
     * @param $id Id of user
     * @return mixed redirection back with error or success msg
     */
	public function kickUser($id){
        if(!array_key_exists('kicked_from_id', Input::all())){
            return Redirect::back()->withErrors(trans('messages.kick-team-not-specified'));
        }
		$user = User::findOrFail($id);
		$team = Team::findOrFail(Input::all()['kicked_from_id']);
		if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
			if(!$user->isCaptain($team)){
				$team->members()->detach($user->id);
				$msg = $user->nickname.trans('messages.kicked');
				return Redirect::back()->with('message', $msg);
			}else{
				return Redirect::back()->withErrors(trans('messages.captain-cannot-be-kicked'));
			}
		}else{
			return Redirect::back()->withErrors(trans('messages.not-captain-or-admin'));
		}
	}

    /**
     * Authenticated user leaves given team if user is member of it. Captain cannot leave team until he/she forwards the captain role
     *
     * @param $id Id of team, which is leaved
     * @return mixed redirection back with error or success msg
     */
	public function leaveTeam($id){
		$team = Team::findOrFail($id);
		if($team->members()->get()->contains(Auth::user())){
			if($team->captain->id == Auth::user()->id){
				return Redirect::back()->withErrors(trans('messages.captain-cant-leave'));
			}
			$team->members()->detach(Auth::user()->id);
            $msg = $team->name.trans('messages.team-leaved');
			return Redirect::back()->with('message', $msg);
		}
		return Redirect::back()->withErrors(trans('messages.not-member'));
	}

    /**
     * Accepts invitation from team
     *
     * @param $id Id of team from which invitation comes
     * @return mixed redirection back with error or success msg
     */
	public function acceptInvitation($id){
		$team = Team::findOrFail($id);
		$team->sentInvitations()->detach(Auth::user()->id);
		$team->members()->attach(Auth::user()->id);
		return Redirect::back()->with('message', trans('messages.inv-accepted'));
	}

    /**
     * Declines invitation from team
     *
     * @param $id Id of team from which invitation comes
     * @return mixed redirection back with error or success msg
     */
	public function declineInvitation($id){
		$team = Team::findOrFail($id);
		$team->sentInvitations()->detach(Auth::user()->id);
		return Redirect::back()->with('message', trans('messages.inv-declined'));
	}

    /**
     * Uploads avatar in images/ folder
     *
     * @return string Html code of image
     */
    public function uploadAvatar(){
        if(is_array($_FILES)) {
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                $sourcePath = $_FILES['image']['tmp_name'];
                $targetPath = "images/".$_FILES['image']['name'];

                if(move_uploaded_file($sourcePath,$targetPath)) {
                    return "<img src=\"/$targetPath\" width=\"100%\" height=\"100%\" alt='avatar preview'/>";
                }
            }
        }
    }

    /**
     * Checks inserted nickname availability among all users via ajax request
     *
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
			$html = trans('messages.not-ajax');
			return $html;
		}
	}

    /**
     * Checks inserted email availability among all users via ajax request
     *
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
            $html = trans('messages.not-ajax');
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
	 * @param  int  $id id of league which should be shown
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
            //forward all captain roles (if there is nobody to forward delete the team because team cannot be without captain)
            if(count($user->teamsWhereUserIsCaptain()->get()) > 0){
                foreach($user->teamsWhereUserIsCaptain()->get() as $team){
                    if(count($team->members()->get()) > 1){
                        //give captain role to first available user
                        foreach($team->members()->get() as $member){
                            if($member->id != $user->id){
                                $team->captain()->associate($member)->save();
                                break;
                            }
                        }
                    }else{
                        $team->delete();
                    }
                }
            }
            $user->roles()->detach(); //delete record in pivot table
            $user->delete();
			return redirect('/users');
		}else{
			$errorMsg = $user->nickname.trans('messages.delete-another-admin');
			return redirect('/users')->withErrors([$errorMsg]);
		}
	}

}
