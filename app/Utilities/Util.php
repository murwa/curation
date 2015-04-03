<?php
/**
 * Created by PhpStorm.
 * User: peter.wanjala
 * Date: 2/7/2015
 * Time: 3:18 PM
 */

namespace App\Utilities;

use App\Utilities\Utils;
use Input;
use ArrayObject;


trait Util {
    public function getClassName () {
        return strtolower(str_replace('App\\', '', str_replace('App\\Models\\', '', __CLASS__)));
    }


    /**
     * Upload Files
     *
     * @param string $key
     *
     * @return array
     */
    public function upload($key = 'upload')
    {
        $uploads = [];
        if (Input::hasFile($key)) {
            foreach (is_array(Input::file($key)) ? Input::file($key) : [Input::file($key)] as $file) {
                $filename = implode('.', [strtoupper(Utils::getUrl()), $file->guessExtension()]);
                # Get file details
                $upload = ['url' => Utils::getUrl(), 'path' => $filename, 'name' => $file->getClientOriginalName(), 'mime' => $file->getMimeType()];

                # Upload the file
                $file->move(config('globals.upload'), $filename);
                # If successful, add to list
                $uploads[] = $upload;
            }
        }
        return $uploads;
    }
}