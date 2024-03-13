<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Undocumented class.
 */
class CreateSessionsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
<<<<<<< HEAD
                // $table->timestamps();
                // $table->string('created_by')->nullable();
                // $table->string('updated_by')->nullable();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
                // $this->updateUser($table);
                $this->updateTimestamps($table, true);
=======
                $table->timestamps();
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
>>>>>>> 2ecdc898 (up)
            }
        );
    }
}
