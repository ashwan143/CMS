<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Frontend\PageController;

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\JobOpeningController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\NewsletterSubscriberController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ActivityLogController;


/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend.home');
})->name('home');


/*
|--------------------------------------------------------------------------
| About
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');


/*
|--------------------------------------------------------------------------
| Dynamic CMS Pages
|--------------------------------------------------------------------------
*/

Route::get('/page/{slug}', [PageController::class, 'show'])
    ->name('frontend.page');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:users.view');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('permission:users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('permission:users.create');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:users.view');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:users.edit');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:users.delete');


    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    Route::resource('roles', RoleController::class);


    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    Route::resource('services', ServiceController::class);


    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */

    Route::resource('projects', ProjectController::class);


    /*
    |--------------------------------------------------------------------------
    | Technologies
    |--------------------------------------------------------------------------
    */

    Route::resource('technologies', TechnologyController::class);


    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */

    Route::resource('pages', AdminPageController::class);


    /*
    |--------------------------------------------------------------------------
    | Menus
    |--------------------------------------------------------------------------
    */

    Route::resource('menus', MenuController::class);


    /*
    |--------------------------------------------------------------------------
    | Sliders
    |--------------------------------------------------------------------------
    */

    Route::resource('sliders', SliderController::class);


    /*
    |--------------------------------------------------------------------------
    | Blogs
    |--------------------------------------------------------------------------
    */

    Route::resource('blogs', BlogController::class);


    /*
    |--------------------------------------------------------------------------
    | Albums
    |--------------------------------------------------------------------------
    */

    Route::resource('albums', AlbumController::class);


    /*
    |--------------------------------------------------------------------------
    | Gallery Images
    |--------------------------------------------------------------------------
    */

    Route::resource('gallery-images', GalleryImageController::class);


    /*
    |--------------------------------------------------------------------------
    | Testimonials
    |--------------------------------------------------------------------------
    */

    Route::resource('testimonials', TestimonialController::class);


    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    */

    Route::resource('clients', ClientController::class);


    /*
    |--------------------------------------------------------------------------
    | FAQs
    |--------------------------------------------------------------------------
    */

    Route::resource('faqs', FaqController::class);


    /*
    |--------------------------------------------------------------------------
    | Team Members
    |--------------------------------------------------------------------------
    */

    Route::resource('team-members', TeamMemberController::class);


    /*
    |--------------------------------------------------------------------------
    | Job Openings
    |--------------------------------------------------------------------------
    */

    Route::resource('job-openings', JobOpeningController::class);


    /*
    |--------------------------------------------------------------------------
    | Contact Messages
    |--------------------------------------------------------------------------
    */

    Route::get('contact-messages', [ContactMessageController::class, 'index'])
        ->name('contact-messages.index');

    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
        ->name('contact-messages.show');

    Route::patch('contact-messages/{contactMessage}/read', [ContactMessageController::class, 'markAsRead'])
        ->name('contact-messages.mark-read');

    Route::patch('contact-messages/{contactMessage}/unread', [ContactMessageController::class, 'markAsUnread'])
        ->name('contact-messages.mark-unread');

    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
        ->name('contact-messages.destroy');


    /*
    |--------------------------------------------------------------------------
    | Newsletter Subscribers
    |--------------------------------------------------------------------------
    */

    Route::get('newsletter-subscribers', [NewsletterSubscriberController::class, 'index'])
        ->name('newsletter-subscribers.index');

    Route::get('newsletter-subscribers/{newsletterSubscriber}', [NewsletterSubscriberController::class, 'show'])
        ->name('newsletter-subscribers.show');

    Route::patch('newsletter-subscribers/{newsletterSubscriber}/status', [NewsletterSubscriberController::class, 'updateStatus'])
        ->name('newsletter-subscribers.update-status');

    Route::delete('newsletter-subscribers/{newsletterSubscriber}', [NewsletterSubscriberController::class, 'destroy'])
        ->name('newsletter-subscribers.destroy');


    /*
    |--------------------------------------------------------------------------
    | Inquiries
    |--------------------------------------------------------------------------
    */

    Route::get('inquiries', [InquiryController::class, 'index'])
        ->name('inquiries.index');

    Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])
        ->name('inquiries.show');

    Route::patch('inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])
        ->name('inquiries.update-status');

    Route::patch('inquiries/{inquiry}/assign', [InquiryController::class, 'assign'])
        ->name('inquiries.assign');

    Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])
        ->name('inquiries.destroy');


    /*
    |--------------------------------------------------------------------------
    | Activity Logs
    |--------------------------------------------------------------------------
    */

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');

    Route::get('activity-logs/{activityLog}', [ActivityLogController::class, 'show'])
        ->name('activity-logs.show');

    Route::delete('activity-logs/{activityLog}', [ActivityLogController::class, 'destroy'])
        ->name('activity-logs.destroy');


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    Route::delete('/settings/{key}/image', [SettingController::class, 'removeImage'])
        ->name('settings.image.remove');

});
