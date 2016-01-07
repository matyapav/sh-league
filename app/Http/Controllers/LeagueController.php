<?php
/**
 * This file contains controller for Leagues
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Game;
use App\League;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

/**
 * LeagueController handles mostly CRUD operations for Leagues.
 * @package App\Http\Controllers
 */
class LeagueController extends Controller {


	/**
	 * Display a listing of the leagues.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = League::orderBy('created_at', 'desc')->paginate(10);
		return view('/leagues/leagues', ['leagues' => $leagues]);
	}

	/**
	 * Show the form for creating a new league.
	 *
	 * @return Response view with the creating form
	 */
	public function create()
	{
		$games = Game::all();
		return view('/leagues/league-create', ['games' => $games,  'edited' => null]);
	}

	/**
	 * Store a newly created league in storage.
	 *
	 * @return Response route where to redirect after store
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), League::rules(""));

		if ($validator->fails()) {
			return redirect('/leagues/createForm')
					->withInput()
					->withErrors($validator);
		}

		$league = new League;
		$league->name = htmlspecialchars(Input::get('name'));
		$league->abbreviation = htmlspecialchars(Input::get('abbreviation'));
		$league->description = htmlspecialchars(Input::get('description'));
		$league->game()->associate(Game::findOrFail(Input::get('game_id')));
		$league->creator()->associate(Auth::user()); //assign creator of league
		$league->save();
		return redirect('/leagues');
		//
	}

	/**
	 * Display the league.
	 *
	 * @param  int  $id id of league which shold be shown
	 * @return Response view with information about league
	 */
	public function show($id)
	{
		$league = League::findOrFail($id);
		return view('/leagues/league-details', ['league' => $league]);
	}

	/**
	 * Show the form for editing the league.
	 *
	 * @param  int  $id id of the league which should be edited
	 * @return Response view with editing form
	 */
	public function edit($id)
	{
		$games = Game::all();
		$league = League::findOrFail($id);
		return view('/leagues/league-create', ['games' => $games, 'edited' => $league ]);
	}

	/**
	 * Update the league in storage.
	 *
	 * @param  int  $id id of league which should be updated
	 * @return Response route where to redirect after update
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), League::rules($id));

		if ($validator->fails()) {
			return redirect('/leagues/createForm')
					->withInput()
					->withErrors($validator);
		}

		$league = League::findOrFail($id);
		$league->name = htmlspecialchars(Input::get('name'));
		$league->abbreviation = htmlspecialchars(Input::get('abbreviation'));
		$league->description = htmlspecialchars(Input::get('description'));
		$league->game()->associate(Game::findOrFail(Input::get('game_id')));
		$league->save();
		return redirect('/leagues');
		//
	}

	/**
	 * Remove the league from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$league = League::findOrFail($id);
		$league->delete();
		return redirect('/leagues');
	}

}
