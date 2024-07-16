<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;




Route::get('/', function () {

    return view('home');
});

//Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});


//Create
Route::get('jobs/create', function () {
    return view('jobs.create');
});


//Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});


//Store
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => '10'
    ]);

    return redirect(('/jobs'));
});


//Edit a job
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});


//Update
Route::patch('/jobs/{id}', function ($id) {
    //Step 1-validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    //Step 2-authorize(On hold...for now)

    //update the job -> // Method 1
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);
    //Step 3-update the job -> // Method 2
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();

    //Ste 4-redirect on the job listing page
    return redirect('/jobs/' . $job->id);
});

//Destroy
Route::delete('/jobs/{id}', function ($id) {
    //Step 1-authorize(On hold...)
    //Step 2-delete the job
    $job = Job::findOrFail($id);
    $job->delete();
    //Step 3-redirect
    return redirect('/jobs');
});



Route::get('/contact', function () {
    return view('contact');
});
