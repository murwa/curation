<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 6:49 PM
 */

namespace App\Http\Controllers\Curation;

use App\Http\Controllers\Controller;
use App\Models\Curation\Course;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Utilities\Utils;
use Illuminate\Support\Facades\Input;
use Form;

/**
 * Class CourseController
 * @package App\Http\Controllers\Curation
 */
class CourseController extends Controller{
    /**
     * @return \Illuminate\View\View
     */
    public function show (Institute $institute, Faculty $faculty, Course $course) {
        # Make forms
        $courseForm = Form::model($course, ['url' => route('curation_course_update', ['institute' => $institute->url, 'faculty' => $faculty->url, 'degree' => $course->url]), 'files' => true, 'method' => 'patch']);
        $unitForm = Form::open(['url' => route('curation_unit_store', ['institute' => $institute->url, 'faculty' => $faculty->url, 'degree' => $course->url]), 'files' => true]);
        # Load faculty and institute
        $course->load('faculty.institute');
        return view('curation.course.profile', compact('course', 'courseForm', 'unitForm'));
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Institute $institute, Faculty $faculty) {
        $course = new Course(Utils::getUrl());

        # Save course and get back
        $faculty->courses()->save($course->fill(Input::except('_token')));
        return back();
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     * @param \App\Models\Curation\Course    $course
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Institute $institute, Faculty $faculty, Course $course) {
        $course->fill(Input::except('_token'))->save();
        return back();
    }

    /**
     * Remove course - cascade
     *
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     * @param \App\Models\Curation\Course    $course
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy (Institute $institute, Faculty $faculty, Course $course) {
        # Remove course
        $course->delete();

        return back();
    }
}