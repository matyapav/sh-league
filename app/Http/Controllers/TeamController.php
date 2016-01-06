<?php namespace App\Http\Controllers;
//todo comment file
use App\Http\Requests;
use App\Team;
use App\User;
use App\Tournament;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//TODO comment class
class TeamController extends Controller {

    public function leaveTournament($id){
        $team = Team::findOrFail($id);
        if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
            $t = Tournament::findOrFail(Input::all()['tour_leave_id']);
            $team->tournaments()->detach($t->id);
            return Redirect::back()->with('message', trans('messages.tour-leaved'));
        }else{
            return Redirect::back()->withErrors(trans('messages.not-captain-or-admin'));
        }
    }

	public function joinTournament($id){
		$team = Team::findOrFail($id);
        if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
            $t = Tournament::findOrFail(Input::all()['tour_join_id']);

            foreach ($team->tournaments()->get() as $tournament) {
                if ($tournament->id == $t->id) {
                    return Redirect::back()->withErrors(trans('messages.tour-already-joined'));
                }
            }
            if (count($t->signedTeams()->get()) + 1 > $t->max_number_of_teams) {
                return Redirect::back()->withErrors(trans('messages.tour-full'));
            }

            //todo add datetime conditions

            $team->tournaments()->attach($t->id);
            return Redirect::back()->with('message', trans('messages.tour-joined'));
        }else{
            return Redirect::back()->withErrors(trans('messages.not-captain-or-admin'));
        }
	}

	/**
	 * Invite another user to a team
     *
	 * @param $id id of team to which is user invited. User id is given from input.
	 * @return mixed redirection back with error or success msg
 	*/
    public function inviteUser($id){
        $team = Team::findOrFail($id);
        if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
            foreach ($team->sentInvitations()->get() as $invitation) {
                if ($invitation->id == Input::all()['user_inv_id']) {
                    return Redirect::back()->withErrors(trans('messages.inv-already-invited'));
                }
            }
            foreach ($team->members()->get() as $member) {
                if ($member->id == Input::all()['user_inv_id']) {
                    return Redirect::back()->withErrors(trans('messages.inv-already-in-team'));
                }
            }
            $team->sentInvitations()->attach(Input::all()['user_inv_id']);
            return Redirect::back()->with('message', trans('messages.user-invited'));
        }else{
            return Redirect::back()->withErrors(trans('messages.not-captain-or-admin'));
        }
    }


	/**
	 * Display a listing of the team.
	 *
	 * @return Response view with listing of teams
	 */
	public function index()
	{
		$teams = Team::orderBy('created_at', 'desc')->paginate(10);
		return view('/teams/teams', ['teams' => $teams]);
	}

	/**
	 * Show the form for creating a new team.
	 *
	 * @return Response view with creation form for team
	 */
	public function create()
	{
		return view('/teams/team-create', [ 'edited' => null]);
	}

	/**
	 * Store a newly created team in storage.
	 *
	 * @return Response route where to redirect after store
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Team::rules(""));

		if ($validator->fails()) {
			return redirect('/teams/createForm')
					->withInput()
					->withErrors($validator);
		}

		$team = new Team;
		$team->name = Input::get('name');
		$team->abbreviation = Input::get('abbreviation');
		$team->description = Input::get('description');
		$team->captain()->associate(Auth::user()); //set creator as captain
		$team->save();
		$team->members()->attach(Auth::user()); //addd him to the team

		return redirect('/teams');
		//
	}

	/**
	 * Display the specified team.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$team = Team::findOrFail($id);
		$users = User::all();
		$tournaments = Tournament::all();
		return view('/teams/team-details', ['team' => $team, 'users' => $users, 'tournaments' => $tournaments]);
	}

	/**
	 * Show the form for editing the specified team.
	 *
	 * @param  int  $id id of team which should be passed into editing view
	 * @return Response view with editing form for team
	 */
	public function edit($id)
	{
		$team = Team::findOrFail($id);
		if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
			return view('/teams/team-create', ['edited' => $team]);
		}else{
			return redirect('/teams')->withErrors(trans('messages.not-captain-or-admin'));
		}
	}

	/**
	 * Update the specified team in storage.
	 *
	 * @param  int  $id id of team which should be updated
	 * @return Response route where to redirect after update
	 */
	public function update($id)
	{

		$team = Team::findOrFail($id);
		if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
			$validator = Validator::make(Input::all(), Team::rules($id));

			if ($validator->fails()) {
				return redirect('/teams/createForm')
						->withInput()
						->withErrors($validator);
			}
			$team->name = Input::get('name');
			$team->abbreviation = Input::get('abbreviation');
			$team->description = Input::get('description');
			$team->save();
			return redirect('/teams');
		}else{
			return redirect('/teams')->withErrors(trans('messages.not-captain-or-admin'));
		}
		//
	}

	/**
	 * Remove the specified team from storage.
	 *
	 * @param  int  $id id of team which should be deleted
	 * @return Response route where to redirect after delete
	 */
	public function destroy($id)
	{
		$team = Team::findOrFail($id);
		if (Auth::user()->id == $team->captain->id || Auth::user()->hasRole('admin')) {
			$team->delete();
			return redirect('/teams');
		}else{
			return redirect('/teams')->withErrors(trans('messages.not-captain-or-admin'));
		}

	}

}
