<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 5:39 PM
 */

namespace App\Http\Controllers\Curation;

use App\Http\Controllers\Controller;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Utilities\Utils;
use Illuminate\Support\Facades\Input;
use Form;

/**
 * Class FacultyController
 * @package App\Http\Controllers\Curation
 */
class FacultyController extends Controller{
    /**
     * @param \App\Models\Curation\Institute $institute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store (Institute $institute) {
        $faculty = new Faculty(Utils::getUrl());

        # Add faculty
        $institute->faculties()->save($faculty->fill(Input::except('_token')));
        return back();
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Institute $institute, Faculty $faculty) {
        $faculty->fill(Input::except('_token'))->save();
        return back();
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     *
     * @return \Illuminate\View\View
     */
    public function show (Institute $institute, Faculty $faculty) {
        $facultyForm = Form::model($faculty, ['url' => route('curation_school_update', ['institution' => $institute->url, 'faculty' => $faculty->url]), 'files' => true, 'method' => 'patch']);
        $courseForm = Form::open(['url' => route('curation_course_update', ['institution' => $institute->url, 'faculty' => $faculty->url])]);
        # Load courses
        $faculty->load('institute');
        return view('curation.school.profile', compact('faculty', 'facultyForm', 'courseForm'));
    }

    /**
     * Remove faculty - cascade
     *
     * @param \App\Models\Curation\Institute $institute
     * @param \App\Models\Curation\Faculty   $faculty
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy (Institute $institute, Faculty $faculty) {
        # Remove faculty
        $faculty->delete();
        return back();
    }
}