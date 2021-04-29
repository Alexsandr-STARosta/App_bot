<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MessageService;

class getMessage extends Command
{
    
    protected $signature = 'get:message';

    
    protected $description = 'dsgdgdsdsthsth';

    
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {   
        
        $message = new MessageService();
        $message->getMessages();
        return 0;
    }
}
