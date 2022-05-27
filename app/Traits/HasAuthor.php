<?php

namespace App\Traits;

trait HasAuthor
{
    public function author(): User
    {
        return $this->authorRelation;
    }

    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault([
            'name' => 'John Dow'
        ]);
    }

    public function isAuthorBy(User $user): bool
    {
        return $this->author()->matches($user);
    }

    public function authorBy(User $author)
    {
        $this->authorRelation->associate($author);
        $this->unsetRelation('authorRelation');
    }
}
