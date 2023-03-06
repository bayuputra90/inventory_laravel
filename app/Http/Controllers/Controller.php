<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function color_status($status)
    {
        if ($status == 'draft') {
            $color = 'secondary';
        } elseif ($status == 'pending') {
            $color = 'warning';
        } elseif ($status == 'reject') {
            $color = 'danger';
        } elseif ($status == 'approve') {
            $color = 'success';
        } else {
            $color = 'primary';
        }

        return $color;
    }
}
