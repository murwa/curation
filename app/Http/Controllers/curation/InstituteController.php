<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 3:30 PM
 */

namespace App\Http\Controllers\Curation;


use App\Http\Controllers\Controller;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Utilities\Utils;
use Illuminate\Support\Facades\Input;
use Form;

/**
 * Class InstitutionController
 * @package App\Http\Controllers\Curation
 */
class InstituteController extends Controller{
    /**
     * Display all institutions - maybe paginated?
     *
     * @return \Illuminate\View\View
     */
    public function index () {
        # Get all institutes
        $institutes = Institute::paginate(getPageSize());
        $form = Form::open(['route' => 'curation_institution_store', 'files' => true]);
        return view('curation.institution.main', compact('institutes', 'form'));
    }

    /**
     * Save a new institute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store () {
        $institute = new Institute(Utils::getUrl());
        $institute->fill(Input::all())->save();

        return back();
    }

    /**
     * Display a single institute
     */
    public function show (Institute $institute) {
        $form = Form::model($institute, ['url' => route('curation_institution_show', ['institution' => $institute->url]), 'files' => true, 'method' => 'patch']);
        $facultyForm = Form::open(['url' => route('curation_school_store', ['institution' => $institute->url]), 'files' => true]);
        return view('curation.institution.profile', compact('form', 'facultyForm'))->with(['institute' => $institute]);
    }

    /**
     * @param \App\Models\Curation\Institute $institute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Institute $institute) {
        # Fill, save and pretend nothing happened :)
        $institute->fill(Input::all())->save();
        return back();
    }

    /**
     * Delete institute - CASCADE via delete model event
     *
     * @param \App\Models\Curation\Institute $institute
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy (Institute $institute) {
        $institute->delete();
        return back();
    }
}