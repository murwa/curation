<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 1/9/2015
 * Time: 2:18 PM
 */

namespace App\Utilities;

use MongoId;

/**
 * Class Utils
 * @package App\Utilities
 */
class Utils {

    # Define Constants for image manipulations

    /**
     *  Landscape orientation
     */
    const ORIENTATION_LANDSCAPE = 1;

    /**
     *  Portrait orientation
     */
    const ORIENTATION_PORTRAIT = 2;

    /**
     * Cutout position - Top left
     */
    const IMAGE_FIT_TOP_LEFT = 'top-left';

    /**
     * Cutout position - Top
     */
    const IMAGE_FIT_TOP = 'top';

    /**
     * Cutout position - Right
     */
    const IMAGE_FIT_TOP_RIGHT = 'right';

    /**
     * Cutout position - Left
     */
    const IMAGE_FIT_LEFT = 'left';

    /**
     * Cutout position - Center (default)
     */
    const IMAGE_FIT_CENTER = 'center';

    /**
     * Cutout position - Right
     */
    const IMAGE_FIT_RIGHT = 'right';

    /**
     * Cutout position - Bottom-left
     */
    const IMAGE_FIT_BOTTOM_LEFT = 'bottom-left';

    /**
     * Cutout position - Bottom
     */
    const IMAGE_FIT_BOTTOM = 'bottom';

    /**
     * Cutout position - Bottom right
     */
    const IMAGE_FIT_BOTTOM_RIGHT = 'bottom-right';

    /**
     *  Confirmed attendance
     */
    const EVENT_ATTENDING = 1;

    /**
     *  Not decided as yet
     */
    const EVENT_MAYBE = 2;
    /**
     *  Won't attend the event
     */
    const EVENT_NOT_ATTENDING = 3;

    /**
     * API KEYS
     */

    # Google API
    const GOOGLE_API = 'AIzaSyApH6LRBl1PUcrFTQOXif072Tv1TxPK120';

    /**
     * @return string
     */
    public static function getUrl(){
        return md5((string)new MongoId());
    }
}