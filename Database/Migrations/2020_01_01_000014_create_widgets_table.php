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
 * Class CreateWidgetsTable.
 */
<<<<<<< HEAD
class CreateWidgetsTable extends XotBaseMigration {
=======
class CreateWidgetsTable extends XotBaseMigration
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
                $table->nullableMorphs('post');
                $table->string('blade')->nullable();
                $table->string('image_src')->nullable();
                $table->integer('pos')->nullable();
                $table->string('model')->nullable();
                $table->integer('limit')->nullable();
                $table->string('order_by')->nullable();
                $table->timestamps();
            }
<<<<<<< HEAD
        ); // end create

        // -- UPDATE --
=======
        ); //end create

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
                if (! $this->hasColumn('title')) {
                    $table->string('title')->nullable()->after('post_type');
                }

                if (! $this->hasColumn('layout_position')) {
                    $table->string('layout_position')->nullable()->after('post_type');
                }
            }
<<<<<<< HEAD
        ); // end update
=======
        ); //end update
>>>>>>> 9472ad4 (first)
    }
}
