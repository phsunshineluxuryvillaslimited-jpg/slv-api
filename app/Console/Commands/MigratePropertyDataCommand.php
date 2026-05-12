<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyOld;
use Illuminate\Support\Facades\DB;

#[Signature('app:migrate-property-data')]
#[Description('Copy old data properties to new database')]
class MigratePropertyDataCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldProperties = DB::table('properties_old')->limit(1)->get();
        dd($oldProperties);

        return 0; 
    }
}
