<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
<<<<<<< HEAD
// ----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

// ----- models -----
=======
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

//----- models -----
>>>>>>> 9472ad4 (first)

/**
 * Class CreateConfsTable.
 */
<<<<<<< HEAD
class CreateConfsTable extends XotBaseMigration {
=======
class CreateConfsTable extends XotBaseMigration
{
>>>>>>> 9472ad4 (first)
    /**
     * db up.
     *
     * @return void
     */
<<<<<<< HEAD
    public function up() {
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
=======
    public function up()
    {
        //-- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('note')->nullable();
                    $table->timestamps();
                    $table->string('updated_by')->nullable();
                    $table->string('created_by')->nullable();
            }
        );

        //-- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
            }
        ); //end update
>>>>>>> 9472ad4 (first)
    }
}
