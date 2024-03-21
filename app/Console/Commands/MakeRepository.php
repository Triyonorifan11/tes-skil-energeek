<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository file';

    public function handle()
    {
        $name = $this->argument('name');
        $repository = app_path("Repositories/{$name}Repository.php");

        if (File::exists($repository)) {
            $this->error('Repository already exists!');
            return;
        }

        File::put($repository, $this->generateInterfaceStub($name));

        $this->info("Repositories {$name} created successfully!");
    }

    private function generateInterfaceStub($name)
    {
        return "<?php\n\nnamespace App\Repositories;\n\nuse App\Interfaces\ {$name}Interface;\n\nclass {$name}Repository implements {$name}Interface\n{\n\n \t // Your repository logic here \n\n\t public function create(){}\n\n}\n";
    }
}
