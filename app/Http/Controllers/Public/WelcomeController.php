<?php

namespace App\Http\Controllers\Public;

use App\Models\Event;
use App\Models\Member;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Display the about page.
     *
     * @return View
     */
    public function index(): View
    {
        $pageTitle = 'Welcome to BUBT IT Club';
        $pageDescription = 'Explore our mission, vision, and the latest updates from BUBT IT Club';

        return view('public.welcome', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display the about page.
     *
     * @return View
     */
    public function about(): View
    {
        $pageTitle = 'About BUBT IT Club';
        $pageDescription = 'Learn about our mission, vision, and the team behind BUBT IT Club';

        return view('public.about', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display the contact page.
     *
     * @return View
     */
    public function contact(): View
    {
        $pageTitle = 'Contact Us';
        $pageDescription = 'Get in touch with BUBT IT Club leadership team';
        
        return view('public.contact', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display a listing of events.
     *
     * @return View
     */
    public function events(): View
    {
        $events = Event::query()
            ->where('is_published', true)
            ->orderBy('event_date', 'desc')
            ->paginate(6);

        $pageTitle = 'Upcoming Events';
        $pageDescription = 'Discover upcoming workshops, seminars, and competitions organized by BUBT IT Club';

        return view('public.events.index', compact('events', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display a listing of members.
     *
     * @return View
     */
    public function members(): View
    {
        $members = Member::query()
            ->where('is_active', true)
            ->orderBy('batch', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(12);

        $pageTitle = 'Our Members';
        $pageDescription = 'Meet the talented members of BUBT IT Club';

        return view('public.members.index', compact('members', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the specified member.
     *
     * @param  string  $id
     * @return View
     */
    public function memberDetails(string $id): View
    {
        $member = Member::query()
            ->with(['projects', 'events'])
            ->findOrFail($id);

        $pageTitle = "Member Profile - {$member->name}";
        $pageDescription = "Learn about {$member->name}'s contributions to BUBT IT Club";

        return view('public.members.show', compact('member', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display a listing of projects.
     *
     * @return View
     */
    public function projects(): View
    {
        $projects = Project::query()
            ->with(['members', 'technologies'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $pageTitle = 'Our Projects';
        $pageDescription = 'Explore innovative projects created by BUBT IT Club members';

        return view('public.projects.index', compact('projects', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the specified project.
     *
     * @param  string  $id
     * @return View
     */
    public function projectDetails(string $id): View
    {
        $project = Project::query()
            ->with(['members', 'technologies'])
            ->findOrFail($id);

        $pageTitle = "Project - {$project->title}";
        $pageDescription = $project->short_description;

        return view('public.projects.show', compact('project', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the gallery page.
     *
     * @return View
     */
    public function gallery(): View
    {
        $galleries = Gallery::query()
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $pageTitle = 'Gallery';
        $pageDescription = 'Photos from our events and activities';

        return view('public.gallery', compact('galleries', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display a listing of blog posts.
     *
     * @return View
     */
    public function blog(): View
    {
        $posts = BlogPost::query()
            ->with(['author', 'categories'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $pageTitle = 'Blog';
        $pageDescription = 'Latest articles and news from BUBT IT Club';

        return view('public.blog.index', compact('posts', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the specified blog post.
     *
     * @param  string  $id
     * @return View
     */
    public function blogDetails(string $id): View
    {
        $post = BlogPost::query()
            ->with(['author', 'categories', 'comments'])
            ->findOrFail($id);

        $pageTitle = $post->title;
        $pageDescription = $post->excerpt;

        // Increment view count
        $post->increment('views');

        return view('public.blog.show', compact('post', 'pageTitle', 'pageDescription'));
    }
}