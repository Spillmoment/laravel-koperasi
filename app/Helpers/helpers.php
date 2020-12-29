<?php

use Illuminate\Support\Facades\Storage;

function customDate($date, $date_format)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

function ImageUrl($image_name)
{
    return Storage::url('public/' . $image_name);
}
