<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:category-product-command')->weekly();
