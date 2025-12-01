<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard with relations to users, subcategories, registrations and events.
     */
    public function index()
    {
        $usersCount = User::count();
        $eventsCount = Event::count();
        $registrationsCount = Registration::count();
        $subcategoriesCount = Subcategory::count();
        $categoriesCount = Category::count();

        $recentRegistrations = Registration::with(['user', 'event', 'event.subcategory'])
            ->orderByDesc('created')
            ->take(8)
            ->get();

        $eventsBySubcategory = Subcategory::withCount('events')->get();
        $eventsByCategory = Category::withCount('events')->get();

        return view('dashboard.index', compact(
            'usersCount',
            'eventsCount',
            'registrationsCount',
            'subcategoriesCount',
            'recentRegistrations',
            'eventsBySubcategory',
            'eventsByCategory',
            'categoriesCount'
        ));
    }
}
