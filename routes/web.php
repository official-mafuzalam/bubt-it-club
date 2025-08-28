<?php


use App\Http\Controllers\Admin\Accounts\ExpenseCategoryController;
use App\Http\Controllers\Admin\Accounts\IncomeCategoryController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Member\ProfileController as MemberProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\
{
    AccountController,
    AnnouncementController,
    BlogCategoryController,
    BlogPostController,
    EventController,
    ExecutiveCommitteeController,
    GalleryController,
    MemberController,
    ProjectController,
    PermissionController,
    HomeController,
    RoleController,
    UserController,
    ContactController,
};
use App\Http\Controllers\Public\WelcomeController;
use App\Http\Controllers\Public\EventController as PublicEventController;
use App\Http\Controllers\Public\MemberController as PublicMemberController;


Route::get('/', [WelcomeController::class, 'index'])->name('public.welcome');
Route::get('/about', [WelcomeController::class, 'about'])->name('public.about');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('public.contact');
Route::post('/contact', [WelcomeController::class, 'submitContactForm'])->name('public.contact.submit');

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

Route::get('/gallery', [WelcomeController::class, 'gallery'])->name('public.galleries.index');
Route::get('/gallery/{gallery}', [WelcomeController::class, 'galleryDetails'])->name('public.galleries.show');

Route::get('/blog', [WelcomeController::class, 'blog'])->name('public.blogs.index');
Route::get('/blog/{slug}', [WelcomeController::class, 'blogDetails'])->name('public.blogs.show');
Route::post('/blog/{slug}/comment', [WelcomeController::class, 'addComment'])->name('public.blogs.comments.store');

Route::get('/privacy-policy', [WelcomeController::class, 'privacyPolicy'])->name('public.privacy.policy');
Route::get('/terms-of-service', [WelcomeController::class, 'termsOfService'])->name('public.terms.service');


// For It Club Respectable Members
Route::prefix('it-club-respectable-members')->group(function () {

    // Member Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('members.login');
    Route::post('/login', [AuthController::class, 'login'])->name('members.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('members.logout');

    // Protected member routes
    Route::middleware(['auth.member'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('members.dashboard');

        Route::get('/events', [DashboardController::class, 'events'])->name('members.events.index');
        Route::get('/events/{event}', [DashboardController::class, 'eventDetails'])->name('members.events.show');
        Route::get('/events/{event}/register', [DashboardController::class, 'showRegistrationForm'])->name('members.events.register.form');
        Route::post('/events/{event}/register', [DashboardController::class, 'completeRegistration'])->name('members.events.register.store');
        Route::post('/events/register/{event}', [DashboardController::class, 'registerForEvent'])->name('members.events.register');

        Route::get('/profile', [MemberProfileController::class, 'show'])->name('members.profile');
        Route::get('/profile/edit', [MemberProfileController::class, 'edit'])->name('members.profile.edit');
        Route::put('/profile/edit', [MemberProfileController::class, 'update'])->name('members.profile.update');

    });
});



/**
 * Routes for all authenticated users
 */
Route::middleware(['auth', 'role:super_admin|admin|user'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('admin.index');

        // Accounts section
        Route::resource('accounts', AccountController::class)->names('admin.accounts');

        // Income, Expense Categories
        Route::resource('income-categories', IncomeCategoryController::class)->names('admin.income-categories');
        Route::resource('expense-categories', ExpenseCategoryController::class)->names('admin.expense-categories');

        // Events
        Route::resource('events', EventController::class)->names('admin.events');
        Route::get('events/registration/{event}', [EventController::class, 'showRegister'])->name('admin.events.participants');
        Route::post('events/{registration}/attendance', [EventController::class, 'markAttendance'])->name('admin.events.attendance');
        Route::get('events/{registration}/confirm-email/', [EventController::class, 'confirmEmail'])->name('admin.events.confirm-email');
        Route::patch('events/{registration}/cancel', [EventController::class, 'cancelRegistration'])->name('admin.events.cancel');
        Route::post('events/{event}/toggle-publish', [EventController::class, 'togglePublish'])->name('admin.events.toggle-publish');
        Route::post('events/{event}/toggle-paid', [EventController::class, 'togglePaid'])->name('admin.events.toggle-paid');
        Route::post('events/{event}/toggle-registration', [EventController::class, 'toggleRegistration'])->name('admin.events.toggle-registration');
        Route::post('events/{event}/toggle-only-for-members', [EventController::class, 'toggleOnlyForMembers'])->name('admin.events.toggle-only-for-members');

        Route::post('/events/{event}/income', [EventController::class, 'storeIncome'])->name('events.income.store');
        Route::post('/events/{event}/expense', [EventController::class, 'storeExpense'])->name('events.expense.store');



        // Announcement
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements.index');
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('admin.announcements.create');
        Route::post('/announcements/create', [AnnouncementController::class, 'store'])->name('admin.announcements.store');
        Route::patch('/announcements/status', [AnnouncementController::class, 'toggleStatus'])->name('admin.announcements.toggle-status');


        // Executive Committees
        Route::resource('executive-committees', ExecutiveCommitteeController::class)->names('admin.executive-committees');

        // Members
        Route::resource('members', MemberController::class)->names('admin.members');
        Route::prefix('members')->name('admin.members.')->group(function () {
            Route::post('{member}/password-reset', [MemberController::class, 'resetPassword'])->name('password.reset');
            Route::post('{member}/add-to-user', [MemberController::class, 'addToUser'])->name('add-to-user');
            Route::post('{member}/send-email-confirmation', [MemberController::class, 'sendEmailConfirmation'])->name('email-confirmation');
            Route::get('assign-executive-committees/{member}', [MemberController::class, 'executive'])->name('executive'); // view
            Route::post('assign-executive-committees/{member}', [MemberController::class, 'assignExecutive'])->name('assign-executive');
            Route::post('{member}/toggle-activation', [MemberController::class, 'toggleActivation'])->name('toggle-activation');
            Route::post('{member}/toggle-verification', [MemberController::class, 'toggleVerification'])->name('toggle-verification');
            Route::patch('{member}/update-payment-status', [MemberController::class, 'updatePaymentStatus'])->name('payments');
        });


        // Projects
        Route::resource('projects', ProjectController::class)->names('admin.projects');
        Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('admin.projects.restore');
        Route::delete('projects/{project}/force-delete', [ProjectController::class, 'forceDelete'])->name('admin.projects.forceDelete');
        Route::patch('projects/{project}/toggle-publish', [ProjectController::class, 'togglePublish'])->name('admin.projects.togglePublish');


        // Blogs categories
        Route::resource('blog/categories', BlogCategoryController::class)->names('admin.blog.categories');

        // Blog Posts
        Route::resource('blogs', BlogPostController::class)->names('admin.blog.posts');
        Route::patch('blog/posts/{post}/restore', [BlogPostController::class, 'restore'])->name('admin.blog.posts.restore');
        Route::delete('blog/posts/{post}/force-delete', [BlogPostController::class, 'forceDelete'])->name('admin.blog.posts.forceDelete');
        Route::patch('blog/posts/{post}/toggle-publish', [BlogPostController::class, 'togglePublish'])->name('admin.blog.posts.togglePublish');

        // Galleries
        Route::resource('galleries', GalleryController::class)->names('admin.galleries');
        Route::patch('galleries/{gallery}/restore', [GalleryController::class, 'restore'])->name('admin.galleries.restore');
        Route::delete('galleries/{gallery}/force-delete', [GalleryController::class, 'forceDelete'])->name('admin.galleries.forceDelete');
        Route::patch('galleries/{gallery}/toggle-publish', [GalleryController::class, 'togglePublish'])->name('admin.galleries.togglePublish');
        Route::delete('galleries/images/{image}', [GalleryController::class, 'deleteImage'])->name('admin.galleries.deleteImage');
        Route::post('galleries/{gallery}/update-order', [GalleryController::class, 'updateImageOrder'])->name('admin.galleries.updateImageOrder');

        // Contact
        Route::resource('/contact', ContactController::class)->names('admin.contacts');
        Route::patch('/contact/read/{id}', [ContactController::class, 'markAsRead'])->name('admin.contacts.read');

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
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
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