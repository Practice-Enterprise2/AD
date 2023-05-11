<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $iata_code
 * @property string $name
 * @property string $land
 * @property Address $address
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 * @property ?\Illuminate\Support\Carbon $deleted_at
 */
class Airport extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Sortable;

    protected $table = 'airports';

    protected $primaryKey = 'id';
    protected $fillable = [
        'iata_code',
        'name',
        'land',
        'address_id',

    ];

    public $sortable = [
        'id',
        'iata_code',
        'name',
        'land',
        'address_id',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function airlines(): BelongsToMany
    {
        return $this->belongsToMany(Airline::class);
    }
}