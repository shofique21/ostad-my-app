<?php

namespace App\Repositories;

use App\Models\JobPost;
use Illuminate\Database\Eloquent\Collection;

interface JobPostRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?JobPost;
    public function create(array $data): JobPost;
    public function update(int $id, array $data): JobPost;
    public function delete(int $id): bool;
}
