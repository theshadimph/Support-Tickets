<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the team members (Managers and Employees).
     */
    public function index()
    {
        $team_members = User::whereIn('role', ['manager', 'employee'])
            ->orderBy('role', 'desc')
            ->orderBy('last_name', 'asc')
            ->get();

        return view('team', compact('team_members'));
    }
}
