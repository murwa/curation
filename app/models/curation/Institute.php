<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 4:11 PM
 */

namespace App\Models\Curation;

use Jenssegers\Mongodb\Model;

/**
 * Class Institute
 * @package App\Models\Curation
 */
class Institute extends Model {

    /**
     * @param null $url
     */
    public function __construct ($url = null) {
        if ($url) {
            $this->url = $url;
        }
    }

    /**
     * Blacklisted fields
     *
     * @var array
     */
    protected $guarded = ['_id', '_token', 'url'];

    /**
     * @var string
     */
    protected $collection = 'institutes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faculties () {
        return $this->hasMany(Faculty::class);
    }

}