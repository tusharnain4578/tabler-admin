<?php

namespace App\Foundation;

abstract class Controller
{
    /**
     * Helper variable to store toast data when doing conditionally
     *
     * @var null|string|array
     */
    protected null|string|array $toast = null;


    /**
     * Helper function to set toast flash data
     * 
     * @param string $type
     * @param string $message
     * @return void
     */
    protected function flashToast(string $type, string $message): void
    {
        session()->flash('toast', compact('type', 'message'));
    }
}
