<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 9472ad4 (first)
use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
<<<<<<< HEAD
 * Undocumented class.
 */
class CreateSessionsTable extends XotBaseMigration {
=======
 * Undocumented class
 */
class CreateSessionsTable extends XotBaseMigration
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
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
            }
        );
=======
    public function up()
    {
        //-- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                    $table->string('id')->primary();
                    $table->foreignId('user_id')->nullable()->index();
                    $table->string('ip_address', 45)->nullable();
                    $table->text('user_agent')->nullable();
                    $table->text('payload');
                    $table->integer('last_activity')->index();
            }
        );

>>>>>>> 9472ad4 (first)
    }
}
