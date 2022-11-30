<?php

namespace NogorSolutionsLTD\Hver\Console\Commands;

use Illuminate\Console\Command;

class SetWebPackProdCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webpack:prod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change webpack to production.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info( 'Setting up the environment:' );

        if ( file_exists( 'webpack_prod' ) ) {
            rename( 'webpack.mix.js', 'webpack_local' );
            rename( 'webpack_prod', 'webpack.mix.js' );
            return $this->info( 'Setting up webpack for production development success!🥳' );
        }
        $this->warn( "You're already in webpack for production environment mode." );
    }
}
