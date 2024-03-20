<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeInterface extends Command
{
    protected $signature = 'make:interface {name}';
    protected $description = 'Create a new interface file';

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Interfaces/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error('Interface already exists!');
            return;
        }

        File::put($servicePath, $this->generateInterfaceStub($name));

        $this->info("Interface {$name} created successfully!");
    }

    private function generateInterfaceStub($name)
    {
        return "<?php\n\nnamespace App\Interfaces;\n\ninterface {$name}\n{\n    // Your service logic here\n\n    public function create();\n\n}\n";
    }
}
