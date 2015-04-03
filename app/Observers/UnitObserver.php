<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 4/3/2015
 * Time: 3:03 AM
 */

namespace App\Observers;


class UnitObserver {
    public function deleting ($unit) {
        # Remove all topics
        try {
            $unit->topics()->delete();
        } catch (\Exception $e) {
            # Cancel deleting
            return false;
        }
    }
}