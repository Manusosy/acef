<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isCoordinator();
    }

    public function view(User $user, Article $article): bool
    {
        return $user->isAdmin() || $user->isCoordinator();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isCoordinator();
    }

    public function update(User $user, Article $article): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Coordinators can only edit their own articles
        if ($user->isCoordinator()) {
            return $article->author_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, Article $article): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isCoordinator()) {
            return $article->author_id === $user->id;
        }

        return false;
    }
}
