<?php namespace App\Http\Controllers;
//todo comment file
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
//todo comment class
abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

}
