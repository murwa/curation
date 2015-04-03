<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 4/3/2015
 * Time: 4:45 AM
 */

namespace App\Observers;


class InstituteObserver {
    public function deleting ($institute) {
        try {
            # Delete each faculty
            foreach ($institute->faculties as $faculty) {
                $faculty->delete();
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}