<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 3/30/2015
 * Time: 7:50 PM
 */

namespace App\Models\Curation;

use Jenssegers\Mongodb\Model;

/**
 * Class Topic
 * @package App\Models\Curation
 */
class Topic extends Model {

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
    protected $collection = 'topics';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit () {
        return $this->belongsTo(Unit::class);
    }

}