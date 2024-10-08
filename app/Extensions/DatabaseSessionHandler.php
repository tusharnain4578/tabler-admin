<?php

namespace App\Extensions;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Session\DatabaseSessionHandler as DBSessionHandler;

class DatabaseSessionHandler extends DBSessionHandler
{
    /**
     * Add the user information to the session payload.
     *
     * @param array $payload
     * @return $this
     * @throws BindingResolutionException
     */
    protected function addUserInformation(&$payload): static
    {
        if ($this->container->bound(Guard::class)) {
            $payload['userable_type'] = $this->user() ? get_class($this->user()) : null;
            $payload['userable_id'] = $this->userId();
        }

        return $this;
    }

    /**
     * Get the currently authenticated user's ID.
     *
     * @return mixed
     * @throws BindingResolutionException
     */
    protected function user(): mixed
    {
        return $this->container->make(Guard::class)->user();
    }
}