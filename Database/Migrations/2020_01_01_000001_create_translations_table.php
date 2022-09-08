<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
<<<<<<< HEAD
// --- models --
// /use Modules\Blog\Models\Post as MyModel;
=======
//--- models --
///use Modules\Blog\Models\Post as MyModel;
>>>>>>> 9472ad4 (first)
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateTranslationsTable.
 */
<<<<<<< HEAD
class CreateTranslationsTable extends XotBaseMigration {
=======
class CreateTranslationsTable extends XotBaseMigration
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
                $table->string('lang')->nullable();
                $table->string('key')->nullable();
                $table->text('value')->nullable();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();

                $table->timestamps();
            }
        );

        // -- UPDATE --
=======
    public function up()
    {
        //-- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('lang')->nullable();
                    $table->string('key')->nullable();
                    $table->text('value')->nullable();
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();

                    $table->timestamps();
            }
        );


        //-- UPDATE --
>>>>>>> 9472ad4 (first)
        $this->tableUpdate(
            function (Blueprint $table) {
                if (! $this->hasColumn('created_by')) {
                    $table->string('created_by')->nullable();
                }
                if (! $this->hasColumn('updated_by')) {
                    $table->string('updated_by')->nullable();
                }
            }
        );
    }

<<<<<<< HEAD
    // end up

    // end down
}// end class
=======
    //end up

    //end down
}//end class
>>>>>>> 9472ad4 (first)
