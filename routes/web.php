<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioCotroller;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FeedbackController;



Route::middleware(['auth'])->group(function () {

    //tous les routes de AdminCotroller
    Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/login','destroy')->name('admin.login');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editProfile')->name('edit.profile');   
    Route::post('/stor/profile','storProfile')->name('store.profile');
    Route::get('/change/password','ChangePassword')->name('change.password');
    Route::post('/update/password','UpdatePassword')->name('update.password');   
    });
});


//tous les routes de Home
Route::controller(HomeSliderController::class)->group(function(){
    //parti front
    Route::get('/','Home')->name('home');
    //parti back
    Route::middleware(['auth'])->group(function () {

        Route::get('/home/slide','HomeSlider')->name('home.slide');
        Route::post('/update/slide','UpdateSlider')->name('update.slide');
    });
});

//tous les routes de About
Route::controller(AboutController::class)->group(function(){
    //front
    Route::get('/about','HomeAbout')->name('home.about');
    Route::get('/download/cv','DownloadCV')->name('download.cv');
    //back
    Route::middleware(['auth'])->group(function () {
        Route::get('/about/page','AboutPage')->name('about.page');
        Route::post('/uptade/about','UpdateAbout')->name('uptade.about');

        Route::get('/about/multi/image','AboutMultiImage')->name('about.multi.image');
        Route::post('/store/multi/image','StoreMultiImage')->name('store.multi.image');
        Route::get('/all/multi/image','AllMultiImage')->name('all.multi.image');
        Route::get('/edit/multi/image/{id}','EditMultiImage')->name('edit.multi.image');
        Route::post('/update/multi/image','UpdateMultiImage')->name('update.multi.image');
        Route::get('/delete/multi/image/{id}','DeleteMultiImage')->name('delete.multi.image');
    });
});


//tous les routes de Portfolio
Route::controller(PortfolioCotroller::class)->group(function(){

    //back
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/portfolio','AllPortfolio')->name('all.portfolio');
        Route::get('/add/portfolio','AddPortfolio')->name('add.portfolio');
        Route::post('/store/portfolio','StorPortfolio')->name('store.portfolio');
        Route::get('/edit/portfolio/{id}','EditPortfolio')->name('edit.portfolio');
        Route::post('/update/portfolio','UpdatePortfolio')->name('update.portfolio');
        Route::get('/delete/portfolio/{id}','DeletePortfolio')->name('delete.portfolio');
    }); 
    //front
    Route::get('/portfolio/details/{id}','DetailsPortfolio')->name('portfolio.details');
    Route::get('/home/portfolio','HomePortfolio')->name('home.portfolio');
    
});


//tous les routes de BlogCategory
Route::controller(BlogCategoryController::class)->group(function(){
    //back
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StorCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });
});

//tous les routes de Blog
Route::controller(BlogController::class)->group(function(){
    //parti back
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/blog','AllBlog')->name('all.blog');
        Route::get('/add/blog','AddBlog')->name('add.blog');
        Route::post('/store/blog','StorBlog')->name('store.blog');
        Route::get('/edit/blog/{id}','EditBlog')->name('edit.blog');
        Route::post('/update/blog','UpdateBlog')->name('update.blog');
        Route::get('/delete/blog/{id}','DeleteBlog')->name('delete.blog');
    });
    //partie front
    Route::get('/blog/details/{id}','DetailsBlog')->name('blog.details');
    Route::get('/category/blog/{id}','CategoryBlog')->name('category.blog');
    Route::get('/home/blog','HomeBlog')->name('home.blog');
    Route::get('/search/blog','SearchBlog')->name('search.blog');
});

//tous les routes de Footer
Route::controller(FooterController::class)->group(function(){
    //back
    Route::middleware(['auth'])->group(function () {
        Route::get('/footer/setup','SetupFooter')->name('footer.setup');
        Route::post('/uptade/footer','UpdateFooter')->name('uptade.footer');
    });
});

//tous les routes de ContactMe
Route::controller(ContactController::class)->group(function(){
    //front
    Route::get('/contact','Contact')->name('contact.me');
    //back
    Route::middleware(['auth'])->group(function () {
        Route::post('/store/contact','StoreContact')->name('store.contact');
        Route::get('/contact/message','ContactMessage')->name('contact.message');
        Route::get('/delete/contact/{id}','DeleteContact')->name('delete.contact');
        Route::get('/show/message/{id}','ShowMessage')->name('show.message');
    }); 
});

//tous les routes de ContactMe
Route::controller(FeedbackController::class)->group(function(){
    //back
    Route::middleware(['auth'])->group(function () {
        Route::get('/all/feedback','AllFeedback')->name('all.feedback');
        Route::get('/add/feedback','AddFeedback')->name('add.feedback');
        Route::post('/store/feedback','StoreFeedback')->name('store.feedback');
        Route::get('/edit/feedback/{id}','EditFeedback')->name('edit.feedback');
        Route::post('/update/feedback','UpdateFeedback')->name('update.feedback');
        Route::get('/delete/feedback/{id}','DeleteFeedback')->name('delete.feedback');
    }); 
});


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
