<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobPostRequest;
use App\Services\JobPostService;

class JobPostController extends Controller
{
    protected JobPostService $JobPostService;

    public function __construct(JobPostService $jobPostService)
    {
        $this->jobPostService = $jobPostService;
    }
    public function create()
    {
        return view('job-post');
    }

    public function index()
    {
       $jobs = $this->jobPostService->getAll();
       return view('job_posts.index', compact('jobs'));
       
    }
    public function store(JobPostRequest $request)
    {
        //dd($request->validated());
        $this->jobPostService->store($request->validated());
        return redirect()->route('job-posts.index')
            ->with('success', 'Job created successfully');

    }

        public function edit($id)
    {
        $job = $this->jobPostService->getById($id);
        return view('job_posts.edit', compact('job'));
    }

    public function update(JobPostRequest $request, $id)
    {
        $this->jobPostService->update($id, $request->validated());

        return redirect()->route('job-posts.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy($id)
    {
        $this->jobPostService->delete($id);

        return redirect()->route('job-posts.index')
            ->with('success', 'Job deleted successfully');
    }
}
