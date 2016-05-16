<?php

namespace Task\Validator;

use Respect\Validation\Validator;

/*
 * This file is part of sample Task command package.
 * 
 * (c) Piotr Plenik <piotr.plenik@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Url class
 *
 * @author Piotr Plenik <piotr.plenik@gmail.com>
 */
class Url
{
    /**
     * Check if URL is correct
     *
     * @param string|array $value The url or collection of urls
     * @return bool True if pass validation
     */
    public function validate($value): bool
    {
        $urls = is_array($value) ? $value : array($value);

        $result = true;

        foreach ($urls as $url) {
            if (!Validator::url()->validate($url)) {
                $result = false;
                break;
            }
        }

        return $result;
    }
}
