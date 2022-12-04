<?php

namespace NogorSolutionsLTD\Hver\Console\Commands;

use Illuminate\Console\Command;

class SetWebPackLocalCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webpack:local';

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

        if ( file_exists( 'webpack_local' ) ) {
            rename( 'webpack.mix.js', 'webpack_prod' );
            rename( 'webpack_local', 'webpack.mix.js' );
            return $this->info( 'Setting up webpack for local development success!🥳' );
        }
        $this->warn( "You're already in webpack for local environment mode." );
    }
}
