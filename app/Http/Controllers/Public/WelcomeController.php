<?php

namespace App\Http\Controllers\Public;

use App\Models\Event;
use App\Models\Member;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogComment;

class WelcomeController extends Controller
{
    /**
     * Display the about page.
     *
     * @return View
     */
    public function index(): View
    {
        $events = Event::query()
            ->upcoming()
            ->take(3)
            ->get();

        $pageTitle = 'Welcome to BUBT IT Club';
        $pageDescription = 'Explore our mission, vision, and the latest updates from BUBT IT Club';

        return view('public.welcome', compact('events', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display the about page.
     *
     * @return View
     */
    public function about(): View
    {
        $members = Member::query()
            ->executiveMembers()
            ->get();

        // dd($members->toArray());

        $pageTitle = 'About BUBT IT Club';
        $pageDescription = 'Learn about our mission, vision, and the team behind BUBT IT Club';

        return view('public.about', compact('pageTitle', 'pageDescription', 'members'));
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
     * Display a listing of members.
     *
     * @return View
     */
    public function members(): View
    {
        // $members = Member::query()
        //     ->where('is_active', true)
        //     ->orderBy('batch', 'desc')
        //     ->orderBy('name', 'asc')
        //     ->paginate(12);

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
        // $member = Member::query()
        //     ->with(['projects', 'events'])
        //     ->findOrFail($id);

        // $pageTitle = "Member Profile - {$member['name']}";
        // $pageDescription = "Learn about {$member['name']}'s contributions to BUBT IT Club";

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
    public function projectDetails(string $project): View
    {
        $project = Project::query()
            ->where('slug', $project)
            ->where('is_published', true)
            ->first();

        // $pageTitle = "Project - {$project['title']}";
        // $pageDescription = $project['short_description'];

        return view('public.projects.show', compact('project'));
    }

    /**
     * Display the gallery page.
     *
     * @return View
     */
    public function gallery(): View
    {
        // $galleries = Gallery::query()
        //     ->where('is_active', true)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);

        $pageTitle = 'Gallery';
        $pageDescription = 'Photos from our events and activities';

        return view('public.gallery', compact('galleries', 'pageTitle', 'pageDescription'));
    }

    /**
     * Display a listing of blog posts.
     */
    public function blog(Request $request)
    {
        // Get featured post
        $featuredPost = BlogPost::published()
            ->with(['author', 'categories'])
            ->latest('published_at')
            ->first();

        // Get all published posts
        $query = BlogPost::published()
            ->with(['author', 'categories'])
            ->latest('published_at');

        // Filter by category if requested
        if ($request->has('category')) {
            $query->forCategory($request->category);
        }

        $posts = $query->paginate(9);

        // Get categories with published posts
        $categories = BlogCategory::withPublishedPosts()
            ->withCount([
                'posts' => function ($query) {
                    $query->published();
                }
            ])
            ->get();

        return view('public.blogs.index', compact('featuredPost', 'posts', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function blogDetails($slug)
    {
        $post = BlogPost::published()
            ->with(['author', 'categories'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $post->increment('views');

        // Get related posts (same categories)
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($q) use ($post) {
                $q->whereIn('id', $post->categories->pluck('id'));
            })
            ->with(['author', 'categories'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('public.blogs.show', compact('post', 'relatedPosts'));
    }

    public function addComment(Request $request, $slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,student_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|exists:members,email',
            'content' => 'required|string|max:1000',
        ]);

        $comment = new BlogComment($validated);
        $post->comments()->save($comment);

        return redirect()->back()
            ->with('success', 'Comment posted successfully!');
    }

    public function privacyPolicy(): View
    {
        return view('public.privacy-policy');
    }

    public function termsOfService(): View
    {
        return view('public.terms-of-service');
    }
}