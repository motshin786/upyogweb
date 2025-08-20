<?php

namespace Layerdrops\Treck;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    function __construct()
    {
        new Metaboxes\Page();
        new Metaboxes\Post();
    }
}
