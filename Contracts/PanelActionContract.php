<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

interface PanelActionContract {

    /**
     * Undocumented function
     *
     * @param string $act
     * @return string
     */
    public function url(string $act = 'show'): string;
}