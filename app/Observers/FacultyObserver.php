<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 4/3/2015
 * Time: 4:43 AM
 */

namespace App\Observers;


class FacultyObserver {
    public function deleting ($faculty) {
        try {
            # Delete each course model to trigger cascade
            foreach ($faculty->courses as $course) {
                $course->delete();
            }
        } catch (\Exception $e) {
            return false;
        }
    }

}