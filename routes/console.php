<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:remove-expired-links')->everyMinute();
