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
 * Class CreateMetatagsTable.
 */
<<<<<<< HEAD
class CreateMetatagsTable extends XotBaseMigration {
=======
class CreateMetatagsTable extends XotBaseMigration
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
=======
    public function up()
    {
        //-- CREATE --
>>>>>>> 9472ad4 (first)
        $this->tableCreate(
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('sitename')->nullable();
                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();
                $table->string('charset')->nullable();
                $table->string('author')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->string('logo_src')->nullable();
                $table->string('logo_footer_src')->nullable();
                $table->string('tennant_name')->nullable();
            }
        );

<<<<<<< HEAD
        // -- UPDATE --
=======

        //-- UPDATE --
>>>>>>> 9472ad4 (first)
        $this->tableUpdate(
            function (Blueprint $table) {
                if (! $this->hasColumn('updated_at')) {
                    $table->timestamps();
                }
                if (! $this->hasColumn('updated_by')) {
                    $table->string('updated_by')->nullable()->after('updated_at');
                    $table->string('created_by')->nullable()->after('created_at');
                }
            }
<<<<<<< HEAD
        ); // end update
=======
        ); //end update
>>>>>>> 9472ad4 (first)
    }
}
