<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactMessage
 * @package App\Models
 *
 * @property int $id
 * @property string $phone
 * @property string $name
 * @property string $message
 * @property bool $read
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @mixin \Eloquent
 * @mixin Builder
 */

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';
}
