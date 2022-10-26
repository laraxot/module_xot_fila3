<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

// ----- models -----

/**
 * Class CreateConfsTable.
 */
class CreateConfsTable extends XotBaseMigration
{
    /**
     * db up.
     *
     * @return void
     */
    public function up()
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('note')->nullable();
                $table->timestamps();
                $table->string('updated_by')->nullable();
                $table->string('created_by')->nullable();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
            }
        ); // end update
    }
}
