<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Panels\Actions;

use Illuminate\Support\Facades\File;

/**
 * Class StoreFileMetatagAction.
 */
class StoreFileMetatagAction extends XotBasePanelAction {
    public bool $onContainer = false; //per tutte le righe, esempio xls

    public bool $onItem = true; //per riga selezionata

    public string $icon = '<i class="far fa-save"></i>';

    /**
     * @return mixed
     */
    public function handle() {
        $data = $this->row->toArray();
        $content = var_export($data, true);
        $filename = base_path('config/'.$this->row->tennant_name.'/metatag.php');
        $filename = str_replace(['\\', '/'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $filename);
        //return $filename;
        $content = '<'.'?php'.chr(13).'return '.$content.';';
        File::put($filename, $content);

        return '<h3>+Done</h3>';
    }
}
