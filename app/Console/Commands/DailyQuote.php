<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cách chấm công chưa check out  ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $branch = new School();
        $branch->school_name = '123';
        $branch->email = 'a@gmail.com';
        $branch->phone = '0911234564';
        $branch->address = '433sdfsd';
        $branch->lat = '334223';
        $branch->lng = '2342342';
        $branch->save();
        $this->info('Thành công.');
    }
}
