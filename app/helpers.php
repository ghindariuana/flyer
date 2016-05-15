<?php

function flash($title = Null, $message = Null)
{
    #return session()->flash('flash_message', $message);
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0)
    {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * The web path to a given flyer
 *@param App\Flyer $flyer
 *@return string
 */
function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}