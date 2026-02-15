<?php

namespace App\Repositories;

use App\Models\JobPost;
use Illuminate\Database\Eloquent\Collection;

class JobPostRepository implements JobPostRepositoryInterface
{
    public function all(): Collection
    {
        return JobPost::latest()->get();
    }

    public function find(int $id): ?JobPost
    {
        return JobPost::findOrFail($id);
    }

    public function create(array $data): JobPost
    {
        return JobPost::create($data);
    }

    public function update(int $id, array $data): JobPost
    {
        $jobPost = $this->find($id);
        $jobPost->update($data);
        return $jobPost;
    }

    public function delete(int $id): bool
    {
        return JobPost::destroy($id);
    }
}
