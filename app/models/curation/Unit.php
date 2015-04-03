<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 7:05 PM
 */

namespace App\Models\Curation;

use Jenssegers\Mongodb\Model;

/**
 * Class Unit
 * @package App\Models\Curation
 */
class Unit extends Model {

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
    protected $guarded = ['_id', 'url', '_token', 'csv'];

    /**
     * @var string
     */
    protected $collection = 'units';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course () {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics () {
        return $this->hasMany(Topic::class);
    }

}