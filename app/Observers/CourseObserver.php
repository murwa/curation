<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 4/3/2015
 * Time: 4:39 AM
 */

namespace App\Observers;


class CourseObserver {
    public function deleting ($course) {
        try {
            # Loop through course units to trigger deleting events on Unit models. This will cascade through to topics
            foreach ($course->units as $unit) {
                $unit->delete();
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}