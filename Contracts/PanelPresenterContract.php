<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface PanelPresenterContract.
 */
<<<<<<< HEAD
interface PanelPresenterContract {
=======
interface PanelPresenterContract
{
>>>>>>> 9472ad4 (first)
    /**
     * @return mixed
     */
    public function index(?Collection $items);

    /**
     * @return mixed
     */
    public function setPanel(PanelContract &$panel);

    /**
     * @return mixed
     */
    public function out(?array $params = null);
}
