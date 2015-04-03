<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 7:54 PM
 */

namespace App\Http\Controllers\Curation;

use App\Http\Controllers\Controller;
use App\Models\Curation\Course;
use App\Models\Curation\Faculty;
use App\Models\Curation\Institute;
use App\Models\Curation\Topic;
use App\Models\Curation\Unit;
use App\Utilities\Utils;
use Illuminate\Support\Facades\Input;

class TopicController extends Controller{
    public function store (Institute $institute, Faculty $faculty, Course $course, Unit $unit) {
        # Make a topic
        $topic = new Topic(Utils::getUrl());
        $unit->topics()->save($topic->fill(Input::all()));

        return back();
    }

    public function show () {

    }

    public function update () {

    }

    public function destroy (Institute $institute, Faculty $faculty, Course $course, Unit $unit, Topic $topic) {
        # Remove the topic and return back
        $topic->delete();

        return back();
    }
}