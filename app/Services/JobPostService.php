<?php

namespace App\Services;

use App\Repositories\JobPostRepositoryInterface;
use App\Models\JobPost;

class JobPostService
{
    protected JobPostRepositoryInterface $jobPostRepository;

    public function __construct(JobPostRepositoryInterface $jobPostRepository)
    {
        $this->jobPostRepository = $jobPostRepository;
    }

    public function getAll()
    {
        return $this->jobPostRepository->all();
    }

    public function getById(int $id): JobPost
    {
        return $this->jobPostRepository->find($id);
    }

    public function store(array $data): JobPost
    {
       
        return $this->jobPostRepository->create($data);
    }

    public function update(int $id, array $data): JobPost
    {
        return $this->jobPostRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->jobPostRepository->delete($id);
    }
}
