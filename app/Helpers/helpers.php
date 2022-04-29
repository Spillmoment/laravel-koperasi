<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

function truncate($table)
{
    DB::statement("SET FOREIGN_KEY_CHECKS=0");
    DB::table($table)->truncate();
    DB::statement("SET FOREIGN_KEY_CHECKS=1");
}

function customDate($date, $date_format)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

function ImageUrl($image_name)
{
    return Storage::url('public/' . $image_name);
}
