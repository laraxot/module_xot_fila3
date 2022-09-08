<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

<<<<<<< HEAD
class LaravelNewsTile extends Component {
=======
class LaravelNewsTile extends Component
{
>>>>>>> 9472ad4 (first)
    public string $position;

    public ?string $title;

    public int $number = 0;

    public string $configurationName;

    public int $refreshIntervalInSeconds;

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function mount(string $position, ?string $title = null, string $configurationName = 'default'): void {
=======
    public function mount(string $position, ?string $title = null, string $configurationName = 'default'): void
    {
>>>>>>> 9472ad4 (first)
        $this->position = $position;

        $this->title = $title;

<<<<<<< HEAD
        $this->refreshIntervalInSeconds = intval(config('dashboard.tiles.laravelnews.refresh_interval_in_seconds', 60));
=======
        $this->refreshIntervalInSeconds = config('dashboard.tiles.laravelnews.refresh_interval_in_seconds', 60);
>>>>>>> 9472ad4 (first)

        $this->configurationName = $configurationName;
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function render(): Renderable {
=======
    public function render(): Renderable
    {
>>>>>>> 9472ad4 (first)
        /*
        $xml = \Illuminate\Support\Facades\Http::get('https://feed.laravel-news.com')->body();
        $data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($this->number == config('dashboard.tiles.laravelnews.number_of_articles', 19) - 1) {
            $this->number = 0;
        } else {
            ++$this->number;
        }
        $articleContent = (string) $data->channel->item[$this->number]->description;
        $articleTitle = (string) $data->channel->item[$this->number]->title;

        return view('xot::livewire.laravel-news-tile', compact('articleContent', 'articleTitle'));
        */
<<<<<<< HEAD
        /** 
        * @phpstan-var view-string
        */
=======
>>>>>>> 9472ad4 (first)
        $view = 'theme::empty';
        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    /**
     * Undocumented function.
     */
<<<<<<< HEAD
    public function shouldRender(): bool {
        return false;
    }
}
=======
    public function shouldRender(): bool
    {
        return false;
    }
}
>>>>>>> 9472ad4 (first)
