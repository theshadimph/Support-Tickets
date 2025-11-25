<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Provides the authorize() method
use Illuminate\Foundation\Validation\ValidatesRequests; // Provides validation helpers
use Illuminate\Routing\Controller as BaseController;

// Change `abstract class Controller` to `class Controller extends BaseController`
class Controller extends BaseController
{
    // Use the traits to inject the core functionality
    use AuthorizesRequests, ValidatesRequests;
}
