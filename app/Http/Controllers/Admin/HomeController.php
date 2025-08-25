<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $numbersOfMembers = Member::count();
        $numbersOfActiveMembers = Member::active()->count();
        $numbersOfInactiveMembers = Member::inactive()->count();

        $completedEvents = Event::completed()->count();
        $ongoingEvents = Event::ongoing()->count();
        $upcomingEvents = Event::upcoming()->count();

        $projects = Project::count();

        $blogs = BlogPost::count();

        $galleries = Gallery::count();

        $contacts = Contact::count();

        return view('admin.index', compact(
            'numbersOfMembers',
            'numbersOfActiveMembers',
            'numbersOfInactiveMembers',
            'completedEvents',
            'ongoingEvents',
            'upcomingEvents',
            'projects',
            'blogs',
            'galleries',
            'contacts'
        ));
    }

}