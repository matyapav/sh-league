<?php
/**
 * This file contains abstract Controller.
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Abstract class controller is pattern for building other controllers.
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

}
