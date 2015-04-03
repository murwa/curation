<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 6:23 PM
 */

namespace App\Models\Curation;

use Jenssegers\Mongodb\Model;

/**
 * Class Course
 * @package App\Models\Curation
 */
class Course extends Model {

    /**
     * @param null $url
     */
    public function __construct ($url = null) {
        if ($url) {
            $this->url = $url;
        }
    }

    /**
     * @var array
     */
    protected $guarded = ['_id', 'url', '_token'];

    /**
     * @var string
     */
    protected $collection = 'courses';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty () {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units () {
        return $this->hasMany(Unit::class);
    }

}