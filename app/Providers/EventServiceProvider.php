<?php namespace App\Providers;

use App\Models\Curation\Course;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Models\Curation\Unit;
use App\Observers\CourseObserver;
use App\Observers\FacultyObserver;
use App\Observers\InstituteObserver;
use App\Observers\UnitObserver;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		//
        /*
         * Bind observers
         */
        # Register unit observer
        Unit::observe(new UnitObserver());

        # Register course observer
        Course::observe(new CourseObserver());

        # Register faculty observer
        Faculty::observe(new FacultyObserver());

        # Register Institute observer
        Institute::observe(new InstituteObserver());
	}

}
