<?php
namespace Darkpony\WCMSPolls;

use Illuminate\Support\ServiceProvider;
use Darkpony\WCMSPolls\Helpers\PollWriter;
use Illuminate\Database\Eloquent\Factories\Factory;

class WCMSPollsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPollWriter();
    }

    /**
     * Boot What is needed
     *
     */
    public function boot()
    {
        // migrations
        $this->publishes([
            __DIR__ . '/database/migrations/2024_01_23_115718_create_polls_table.php'
            => base_path('database/migrations/2024_01_23_115718_create_polls_table.php'),
            __DIR__ . '/database/migrations/2024_01_23_124357_create_poll_options_table.php'
            => base_path('database/migrations/2024_01_23_124357_create_poll_options_table.php'),
            __DIR__ . '/database/migrations/2024_01_25_111721_create_votes_table.php'
            => base_path('database/migrations/2024_01_25_111721_create_votes_table.php'),
            __DIR__ . '/database/migrations/2024_03_22_134439_add_poll_id_on_content.php'
            => base_path('database/migrations/2024_03_22_134439_add_poll_id_on_content.php'),

        ]);
        // routes
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        // views
        $this->loadViewsFrom(__DIR__ . '/views', 'wcmspolls');

        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('wcmspolls_config.php'),
        ]);
    }

    /**
     * Register the poll writer instance.
     *
     * @return void
     */
    protected function registerPollWriter()
    {
        $this->app->singleton('pollwritter', function ($app) {
            return new PollWriter();
        });
    }

}
