<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translations
 *
 * @property int $id
 * @property int $id_trans_word
 * @property string $lang
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Words|null $word
 * @method static \Illuminate\Database\Eloquent\Builder|Translations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Translations query()
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereIdTransWord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Translations whereValue($value)
 * @mixin \Eloquent
 */
class Translations extends Model
{
    use HasFactory;
    
    protected $table = 'trans_translations';
    
    public function word()
    {
        return $this->hasOne(Words::class, 'id', 'id_trans_word');
    }
}
