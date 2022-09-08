<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
<<<<<<< HEAD
// ----- models -----
=======
//----- models -----
>>>>>>> 9472ad4 (first)
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
questa tabella non dovrebbe esistere, creata per risolvere:
<<<<<<< HEAD
[2021-08-20 16:35:11] locale.ERROR: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'cvfcmxwn_test sitename.feeds'
doesn't exist (SQL: select count(*) as aggregate from `feeds` where (`feeds`.`id` = restaurant)) {"
url":"https://www.test sitename.com/it/feed/restaurant"
*/

class CreateFeedsTable extends XotBaseMigration {
=======
[2021-08-20 16:35:11] locale.ERROR: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'cvfcmxwn_foodfriendfinder.feeds'
doesn't exist (SQL: select count(*) as aggregate from `feeds` where (`feeds`.`id` = restaurant)) {"
url":"https://www.foodfriendfinder.com/it/feed/restaurant"
*/

class CreateFeedsTable extends XotBaseMigration
{
>>>>>>> 9472ad4 (first)
    /**
     * Run the migrations.
     *
     * @return void
     */
<<<<<<< HEAD
    public function up() {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->increments('id');
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
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->timestamps();
            }
        );


        //-- UPDATE --
>>>>>>> 9472ad4 (first)
        $this->tableUpdate(
            function (Blueprint $table) {
            }
        );
    }
}
