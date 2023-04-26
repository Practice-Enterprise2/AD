<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Employee $employee
 * @property \Illuminate\Support\Carbon $start_date
 * @property ?\Illuminate\Support\Carbon $end_date
 * @property ?\Illuminate\Support\Carbon $created_date
 * @property ?\Illuminate\Support\Carbon $updated_date
 */
class EmployeeContract extends Model
{
}
