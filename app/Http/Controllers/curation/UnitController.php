<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 7:03 PM
 */

namespace App\Http\Controllers\Curation;

use App\Http\Controllers\Controller;
use App\Models\Curation\Course;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Models\Curation\Unit;
use App\Utilities\Utils;
use Illuminate\Support\Facades\Input;
use Form;
use App\Utilities\Util;
use Excel;


/**
 * Class UnitController
 * @package App\Http\Controllers\Curation
 */
class UnitController extends Controller{
    use Util;
    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     * @param \App\Models\Curation\Course    $course
     * @param \App\Models\Curation\Unit      $unit
     *
     * @return \Illuminate\View\View
     */
    public function show (Institute $institute, Faculty $faculty, Course $course, Unit $unit) {
        # Get parent relations
        $unit->load('course.faculty.institute');
        # Make forms
        $unitForm = Form::model($unit, ['url' => route('curation_unit_update', ['institute' => $institute->url, 'faculty' => $faculty->url, 'degree' => $course->url, 'entity' => $unit->url]), 'files' => true, 'method' => 'patch']);
        $topicForm = Form::open(['url' => route('curation_topic_store', ['institute' => $institute->url, 'faculty' => $faculty->url, 'degree' => $course->url, 'entity' => $unit->url])]);
        return view('curation.unit.profile', compact('unit', 'unitForm', 'topicForm'));
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     * @param \App\Models\Curation\Course    $course
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Institute $institute, Faculty $faculty, Course $course) {
        # Is it a csv?
        if (Input::hasFile('csv')) {
            $files = $this->upload('csv');
            $csv = array_pop($files);
            $units = Excel::load(storage_path('uploads') . DIRECTORY_SEPARATOR . $csv['path'])->toArray();
            foreach ($units as &$item) {
                $item['code'] = (int)$item['code'];
                $item['hours'] = (int)array_get($item, 'hours', 0);
                $item = (new Unit(Utils::getUrl()))->fill($item);
            }

            # Avoid weird stuff
            unset($item);

            # Save all
            if ($units) {
                $course->units()->saveMany($units);
            }
        }else{
            # Make a unit
            $unit = new Unit(Utils::getUrl());

            # Save and get back
            $course->units()->save($unit->fill(Input::all()));
        }
        return back();
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     * @param \App\Models\Curation\Course    $course
     * @param \App\Models\Curation\Unit      $unit
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Institute $institute, Faculty $faculty, Course $course, Unit $unit) {
        $unit->fill(Input::except('_token'))->save();

        return back();
    }

    public function destroy (Institute $institute, Faculty $faculty, Course $course, Unit $unit) {
        # Delete the unit
        $unit->delete();
        return back();
    }
}