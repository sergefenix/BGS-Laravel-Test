<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

class LogMessageController
{

    public function fire($job, $date): void
    {
        File::append(storage_path('app/public') . '/queue.txt', $date['message'] . PHP_EOL);
        $job->delete();
    }

}
