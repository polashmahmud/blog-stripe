<?php

namespace App\Models;

use App\Casts\TitleCast;
use App\Traits\HasAuthor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use HasAuthor;

    const TABLE = 'posts';

    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'cover_image',
        'published_at',
        'type',
        'photo_credit_text',
        'photo_credit_link',
        'author_id'
    ];

    // Eager load the relationship
    protected $with = [
        'authorRelation'
    ];

    protected $cast = [
        'published_at' => 'datetime',
        'title' => TitleCast::class
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function excerpt(int $limit = 250): string
    {
        return Str::limit(strip_tags($this->body()), $limit);
    }

    public function coverImage(): string
    {
        return $this->cover_image;
    }
}
