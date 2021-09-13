<?php

namespace App\Providers;

use App\Events;
use App\SupportTicket;
use App\VTCJob;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                if (Gate::allows('manage_support')) {
                    $OpenSupportTickets = SupportTicket::where('status', 1)->get()->count();
                    view()->share('OpenSupportTickets', $OpenSupportTickets);
                    $view->with('currentUser', $OpenSupportTickets);
                }

                if (Gate::allows('manage_events')) {
                    $PendingEventsCount = Events::where('status', 1)->get()->count();
                    view()->share('PendingEventsCount', $PendingEventsCount);
                    $view->with('currentUser', $PendingEventsCount);
                }

                if (Gate::allows('manage_vtc')) {
                    $PendingJobsCount = VTCJob::where('status', 1)->get()->count();
                    view()->share('PendingJobsCount', $PendingJobsCount);
                    $view->with('currentUser', $PendingJobsCount);
                }
            }
        });

        Paginator::useBootstrap();
    }
}
