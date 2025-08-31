<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// This class is no longer needed in Laravel 11. Use FormRequest directly in your custom requests.
// Left for legacy compatibility, but should be removed if not referenced elsewhere.
abstract class Request extends FormRequest
{
}

