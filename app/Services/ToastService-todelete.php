<?php

namespace App\Services;

class ToastService

{
    public static function success(string $message): void
    {
        self::flash($message, 'success');
    }

    public static function error(string $message): void
    {
        self::flash($message, 'error');
    }

    public static function warning(string $message): void
    {
        self::flash($message, 'warning');
    }

    public static function info(string $message): void
    {
        self::flash($message, 'info');
    }

    protected static function flash(string $message, string $type): void
    {
        session()->flash('toast', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
