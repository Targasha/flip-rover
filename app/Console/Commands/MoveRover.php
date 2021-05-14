<?php

namespace App\Console\Commands;

use App\Models\Map;
use App\Models\Rover;
use Illuminate\Console\Command;

class MoveRover extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rover:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $mapData = $this->ask('Enter map size. Eg. 5 5');

        $map = new Map;
        $map->setData($mapData);

        $roverData = $this->ask('Enter rover coordinates and direction. (Eg. 1 2 N)');

        $rover = new Rover($map);
        $rover->setData($roverData);

        $actionCommand = $this->ask('Enter moving commands. (Eg. LMLMLMLMM)');

        $rover->simolate($actionCommand);
        $rover->doActions($actionCommand);

        $this->info($rover->getLocation());
    }
}
