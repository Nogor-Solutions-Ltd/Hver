<?php

namespace NogorSolutionsLTD\Hver\Console\Commands;

use Illuminate\Console\Command;

class EnvironmentCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hver {arg}';

    /**
     * Hver commands const
     * @var string
     */
    const APP_LOCAL     = "app:local";
    const APP_PROD      = "app:prod";
    const WEBPACK_PROD  = "webpack:local";
    const WEBPACK_LOCAL = "webpack:prod";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setting up the local environment.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        # app:local
        # app:prod
        # webpack:local
        # webpack:prod

         $arg = $this->argument('arg');

         if( $arg == self::APP_LOCAL ){
            $this->appLocal();
         }else if($arg == self::APP_PROD ){
            $this->appProduction();
         }else if( $arg == self::WEBPACK_PROD){
           $this->webpackLocal();
         }else if ( $arg == self::WEBPACK_LOCAL){
           $this->webpackProduction();
         }
    }

    /**
     * Execute app local console command.
     *
     * @return bool
     */
    public function appLocal(){
        $this->info( 'Setting up the environment.' );

        if ( file_exists( 'env_local' ) ) {
            rename( '.env', 'env_prod' );
            rename( 'env_local', '.env' );
            return $this->info( 'Setting up app for local development success!🥳' );
        }
        $this->warn( "You're already in local app environment mode." );

    }

    /**
     * Execute app prod console command.
     *
     * @return bool
     */
    public function appProduction(){

        $this->info( 'Setting up the environment.' );

        if ( file_exists( 'env_prod' ) ) {
            rename( '.env', 'env_local' );
            rename( 'env_prod', '.env' );
            return $this->info( 'Setting up production development success!🥳' );
        }
        $this->warn( "You're already in production environment mode." );
    }

    /**
     * Execute webpack prod console command.
     *
     * @return bool
     */
    public function webpackLocal(){
        $this->info( 'Setting up the environment.' );

        if ( file_exists( 'webpack_local' ) ) {
            rename( 'webpack.mix.js', 'webpack_prod' );
            rename( 'webpack_local', 'webpack.mix.js' );
            return $this->info( 'Setting up webpack for local development success!🥳' );
        }
        $this->warn( "You're already in webpack for local environment mode." );
    }

    /**
     * Execute webpack local console command.
     *
     * @return bool
     */
    public function webpackProduction(){
        $this->info( 'Setting up the environment.' );

        if ( file_exists( 'webpack_prod' ) ) {
            rename( 'webpack.mix.js', 'webpack_local' );
            rename( 'webpack_prod', 'webpack.mix.js' );
            return $this->info( 'Setting up webpack for production development success!🥳' );
        }
        $this->warn( "You're already in webpack for production environment mode." );
    }
}
