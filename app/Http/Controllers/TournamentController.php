<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tournament;
use App\League;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class TournamentController extends Controller {


	/**
	 * Display a listing of the tournament.
	 *
	 * @return Response view with listing of tournaments
	 */
	public function index()
	{
		$tournaments = Tournament::orderBy('created_at', 'desc')->paginate(5);
		return view('/tournaments/tournaments', ['tournaments' => $tournaments]);
	}

	/**
	 * Show the form for creating a new tournament.
	 *
	 * @return Response view with creation form for tournament
	 */
	public function create()
	{
		$leagues = League::all();
		return view('/tournaments/tournament-create', ['leagues' => $leagues,  'edited' => null]);
	}

	/**
	 * Store a newly created tournament in storage.
	 *
	 * @return Response route where to redirect after store
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), Tournament::rules(""));

		if ($validator->fails()) {
			return redirect('/tournaments/createForm')
					->withInput()
					->withErrors($validator);
		}

		$tournament = new Tournament ;
		$tournament->name = Input::get('name');
		$tournament->type = Input::get('type');
		$tournament->min_number_of_teams = Input::get('min_number_of_teams');
		$tournament->max_number_of_teams = Input::get('max_number_of_teams');
		$tournament->start_date = Input::get('start_date');
		$tournament->end_date = Input::get('end_date');
		$tournament->description = Input::get('description');
		$tournament->league()->associate(League::findOrFail(Input::get('league_id')));
		$tournament->save();
		return redirect('/tournaments');
		//
	}

	/**
	 * Display the specified tournament.
	 *
	 * @param  int  $id Id of tournament to be shown
	 * @return Response view with information about tournament
	 */
	public function show($id)
	{
		$tournament = Tournament::findOrFail($id);
		return view('/tournaments/tournament-details', ['tournament' => $tournament]);
	}

	/**
	 * Show the form for editing the specified tournament.
	 *
	 * @param  int  $id Id of edited tournament
	 * @return Response View with editing form for tournament
	 */
	public function edit($id)
	{
		$leagues = League::all();
		$tournament = Tournament::findOrFail($id);
		return view('/tournaments/tournament-create', ['leagues' => $leagues, 'edited' => $tournament ]);
	}

	/**
	 * Update the specified tournament in storage.
	 *
	 * @param  int  $id id of tournament which should be updated
	 * @return Response route where to redirect after update
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Tournament::rules($id));

		if ($validator->fails()) {
			return redirect('/tournaments/edit/'.$id)
					->withInput()
					->withErrors($validator);
		}

		$tournament = Tournament::findOrFail($id);
		$tournament->name = Input::get('name');
		$tournament->type = Input::get('type');
		$tournament->min_number_of_teams = Input::get('min_number_of_teams');
		$tournament->max_number_of_teams = Input::get('max_number_of_teams');
		$tournament->start_date = Input::get('start_date');
		$tournament->end_date = Input::get('end_date');
		$tournament->description = Input::get('description');
		$tournament->league()->associate(League::findOrFail(Input::get('league_id')));
		$tournament->save();
		return redirect('/tournaments');
		//
	}

	/**
	 * Remove the specified tournament from storage.
	 *
	 * @param  int  $id Id of tournament to delete
	 * @return Response route where to redirect after delete
	 */
	public function destroy($id)
	{
		$tournament = Tournament::findOrFail($id);
		$tournament->delete();
		return redirect('/tournaments');
	}

}
