<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

//----- models -----

/**
 * Class CreateMetatagsTable.
 */
class CreateMetatagsTable extends XotBaseMigration {
    /**
     * db up.
     *
     * @return void
     */
    public function up() {
        //-- CREATE --
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


        //-- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
            if (! $this->hasColumn('updated_at')) {
                $table->timestamps();
            }
            if (! $this->hasColumn('updated_by')) {
                $table->string('updated_by')->nullable()->after('updated_at');
                $table->string('created_by')->nullable()->after('created_at');
            }
        }); //end update
    }
}
