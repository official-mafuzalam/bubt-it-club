<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\WelcomeController;
use App\Http\Controllers\Public\EventController as PublicEventController;
use App\Http\Controllers\Public\MemberController as PublicMemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/session', function () {

    $session = session()->all();

    echo "<pre>";
    print_r($session);
    echo "</pre>";

});

Route::get('/', [WelcomeController::class, 'index'])->name('public.welcome');
Route::get('/about', [WelcomeController::class, 'about'])->name('public.about');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('public.contact');

Route::get('/events', [PublicEventController::class, 'events'])->name('public.events');
Route::get('/events/{event}', [PublicEventController::class, 'eventDetails'])->name('public.events.show');
Route::get('/events/{event}/register', [PublicEventController::class, 'showRegistrationForm'])->name('public.events.register.form');
Route::post('/events/{event}/register', [PublicEventController::class, 'register'])->name('public.events.register');

Route::get('/members', [PublicMemberController::class, 'index'])->name('public.members.index');
Route::get('/members/register', [PublicMemberController::class, 'showRegistrationForm'])->name('public.members.register.form');
Route::post('/members/register', [PublicMemberController::class, 'register'])->name('public.members.register');
Route::get('/members/{member}', [PublicMemberController::class, 'show'])->name('public.members.show');

Route::get('/projects', [WelcomeController::class, 'projects'])->name('public.projects');
Route::get('/projects/{project}', [WelcomeController::class, 'projectDetails'])->name('public.projects.show');

Route::get('/gallery', [WelcomeController::class, 'gallery'])->name('public.gallery');

Route::get('/blog', [WelcomeController::class, 'blog'])->name('public.blog');
Route::get('/blog/{id}', [WelcomeController::class, 'blogDetails'])->name('public.blog.details');




// For all auth user
Route::middleware(['auth', 'role:super_admin|admin|user'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('admin.index');

        // Events
        Route::resource('events', EventController::class)->names('admin.events');
        Route::post('events/{event}/toggle-publish', [EventController::class, 'togglePublish'])->name('admin.events.toggle-publish');
        Route::post('events/{event}/toggle-paid', [EventController::class, 'togglePaid'])->name('admin.events.toggle-paid');
        Route::post('events/{event}/toggle-registration', [EventController::class, 'toggleRegistration'])->name('admin.events.toggle-registration');

        // Members
        Route::resource('members', MemberController::class)->names('admin.members');

        // Projects
        Route::resource('projects', ProjectController::class)->names('admin.projects');
        // Additional project routes
        Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('admin.projects.restore');
        Route::delete('projects/{project}/force-delete', [ProjectController::class, 'forceDelete'])->name('admin.projects.forceDelete');
        Route::patch('projects/{project}/toggle-publish', [ProjectController::class, 'togglePublish'])->name('admin.projects.togglePublish');

        // Blogs
        Route::resource('blogs', BlogPostController::class)->names('admin.blog.posts');

        // Galleries
        Route::resource('galleries', GalleryController::class)->names('admin.galleries');


        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });

});


// Only for Super Admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {

    Route::prefix('admin')->group(function () {

        // Roles
        Route::get('/role', [RoleController::class, 'role'])->name('admin.role');
        Route::get('/role/create', [RoleController::class, 'roleCreatePage'])->name('admin.role.createPage');
        Route::post('/role/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('/role/edit/{id}', [RoleController::class, 'roleEditPage'])->name('admin.role.edit');
        Route::put('/role/update/{id}', [RoleController::class, 'roleUpdate'])->name('admin.role.update');
        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('admin.role.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('admin.role.permissions.revoke');


        // Permissions
        Route::get('/permission', [PermissionController::class, 'permission'])->name('admin.permission');
        Route::get('/permission/create', [PermissionController::class, 'permissionCreatePage'])->name('admin.permission.createPage');
        Route::post('/permission/create', [PermissionController::class, 'permissionCreate'])->name('admin.permission.create');
        Route::get('/permission/edit/{id}', [PermissionController::class, 'permissionEditPage'])->name('admin.permission.edit');
        Route::put('/permission/update/{id}', [PermissionController::class, 'permissionUpdate'])->name('admin.permission.update');
        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'givePermission'])->name('admin.permissions.role');
        Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('admin.permissions.roles.revoke');


        // Users
        Route::get('/users', [UserController::class, 'user'])->name('admin.user');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('admin.users.roles');
        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('admin.users.roles.remove');
        Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('admin.users.permissions');
        Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('admin.users.permissions.revoke');
        Route::post('/users/password-regenerate/{user}', [UserController::class, 'passRegenerate'])->name('admin.users.passRegenerate')->middleware('can:user_edit');
        Route::patch('/user/{user}/block', [UserController::class, 'block'])->name('users.block');
        Route::patch('/user/{user}/unblock', [UserController::class, 'unblock'])->name('users.unblock');

        Route::get('/check-permissions', [PermissionController::class, 'checkPer']);

    });


});



require __DIR__ . '/auth.php';