<?php

namespace App\Console\Commands;

use App\Models\Admin\Space;
use Illuminate\Console\Command;

class UpdateSpaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateSpaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza de la tabla espacios el campo time_taken a cero, cada día';

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
        // $this->info('Antes de llamar los espacio');
        $spaces = Space::where('horario_id', 1)
        ->where('duration_id', 1)
        ->get();
        foreach ($spaces as $space) {
            // $this->info('Espacio: '.$space->id.' : '.$space->start_hour.' - '.$space->end_hour.'  -> '.$space->times_taken);
            $space->update(['times_taken' => 0]);
        }
        // $this->info('Se ejecuto todos los espacios');
    }
}
