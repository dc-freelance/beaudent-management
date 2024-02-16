<?php

namespace App\Repositories;

use App\Interfaces\BranchInterface;
use App\Models\Branch;

class BranchRepository implements BranchInterface
{
    private $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    public function get()
    {
        return $this->branch->all()->sortBy('id');
    }

    public function getById($id)
    {
        return $this->branch->find($id);
    }

    public function store($data)
    {
        $this->branch->create($data);
    }

    public function update($id, $data)
    {
        $branch = $this->branch->find($id);
        $branch->update($data);
    }

    public function delete($id)
    {
        $branch = $this->branch->find($id);
        $branch->delete();
    }

    public function generateCode(){
        return $this->branch->generate_code_branch();
    }
}
