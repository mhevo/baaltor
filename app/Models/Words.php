<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Words
 *
 * @property int $id
 * @property int $d2_id
 * @property string $d2_key
 * @property string $enUs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Translations[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Words newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Words newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Words query()
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereD2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereD2Key($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereEnUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Words whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Words extends Model
{
    use HasFactory;
    
    protected $table = 'trans_words';
    
    public function translations()
    {
        return $this->hasMany(Translations::class, 'id_trans_word');
    }
}
