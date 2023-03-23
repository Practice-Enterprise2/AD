<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'contract_ID';
    
    public function test()
    {
        echo "test";
    }
    use HasFactory;
}
