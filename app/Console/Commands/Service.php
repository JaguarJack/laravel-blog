<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class Service extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A Service File';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    protected $type = 'Service';
    
    
    /**
     * @author 方法重写
     * {@inheritDoc}
     * @see \Illuminate\Console\GeneratorCommand::getStub()
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/service.stub';
    }
}
