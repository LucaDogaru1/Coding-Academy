<?php

namespace App\Console\Commands;

use App\Http\Controllers\CalenderController;
use App\Http\Controllers\SportController;
use Illuminate\Console\Command;

class GetDataIntoDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-data-into-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sport = new SportController();
        $sport->getContentFromJsonFile();

        $calender = new CalenderController();
        $calender->getTimeTablesForSportEvents();
    }
}
