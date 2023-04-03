<?php

namespace Theme\Bestbuy\Http\Controllers;
use Theme;

use Botble\Theme\Http\Controllers\PublicController;

class BestbuyController extends PublicController
{
    /**
     * {@inheritDoc}
     */
    public function getIndex()
    {
        if(auth('member')->user() == null) {
            return redirect('/login');
        }
        return parent::getIndex();
    }

    /**
     * {@inheritDoc}
     */
    public function profile()
    {
        return Theme::scope('profile')->render();
    }

    /**
     * {@inheritDoc}
     */
    public function getView($key = null)
    {
        return parent::getView($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getSiteMap()
    {
        return parent::getSiteMap();
    }
}
