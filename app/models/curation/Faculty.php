<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 5:41 PM
 */
namespace App\Models\Curation;

use Jenssegers\Mongodb\Model;

/**
 * Class Faculty
 * @package App\Models\Curation
 */
class Faculty extends Model {

    /**
     * @param null $url
     */
    public function __construct ($url = null) {
        if ($url) {
            $this->url = $url;
        }
    }

    /**
     * Blacklist fields
     *
     * @var array
     */
    protected $guarded = ['_id', 'url', '_token'];

    /**
     * Collection name
     *
     * @var string
     */
    protected $collection = 'faculties';

    /**
     * Relate to institution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institute () {
        return $this->belongsTo(Institute::class);
    }

    /**
     * Relate to courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses () {
        return $this->hasMany(Course::class);
    }



}