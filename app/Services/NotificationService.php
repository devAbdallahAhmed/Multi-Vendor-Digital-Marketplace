<?php

namespace App\Services;

class NotificationService 
{


    public static function created($message = null)
    {
        notyf()->success($message ??__("Created Successfully"));
    }

    public static function updated($message = null)
    {
        notyf()->success($message ?? __("Updated Successfully"));
    }

    public static function deleted($message = null)
    {
        notyf()->success($message ?? __("Deleted Successfully"));
    }

    public static function error($message = null)
    {
        notyf()->error($message ??__("Something went wrong!"));
    }
}
