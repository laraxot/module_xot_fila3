<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Migrations;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

//----- models -----

/**
 * Class XotBaseMigration.
 */
abstract class XotBaseMigration extends Migration {
    protected ?Model $model = null;

    protected ?string $model_class = null;

    //*
    public function __construct() {
        if (null == $this->model) {
            $model = $this->getModel();
            if ('\Modules\LU\Models\Groupright' == $model) {
                exit(debug_backtrace());
            }
            $this->model = app($model);
        }
        //$this->model = new $this->model();
    }

    //*/

    public function getModel(): string {
        if (null != $this->model_class) {
            return $this->model_class;
        }
        $name = class_basename($this);
        $name = Str::before(Str::after($name, 'Create'), 'Table');
        $name = Str::singular($name);
        $reflection_class = new \ReflectionClass($this);
        $filename = (string) $reflection_class->getFilename();
        $mod_path = Module::getPath();

        $mod_name = Str::after($filename, $mod_path);
        $mod_name = explode(DIRECTORY_SEPARATOR, $mod_name)[1];

        $model_ns = '\Modules\\'.$mod_name.'\Models\\'.$name;
        $model_dir = $mod_path.'/'.$mod_name.'/'.'Models'.'/'.$name.'.php';
        $model_dir = Str::replace('/', DIRECTORY_SEPARATOR, $model_dir);

        return $model_ns;
    }

    public function getTable(): string {
        if (null == $this->model) {
            return '';
        }
        $table = $this->model->getTable();
        /*
        if (Str::endsWith($table, '_pivot')) {
            $table = Str::before($table, '_pivot');
        }
        */
        return $table;
    }

    /**
     * @return \Illuminate\Database\Schema\Builder
     */
    public function getConn() {
        //$conn_name=with(new MyModel())->getConnectionName();
        //\DB::reconnect('mysql');
        //dddx(config('database'));
        //\DB::purge('mysql');
        //\DB::reconnect('mysql');
        if (null == $this->model) {
            throw new \Exception('model is null');
        }
        $conn_name = $this->model->getConnectionName();
        $conn = Schema::connection($conn_name);

        return $conn;
    }

    /**
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     */
    public function getSchemaManager() {
        $schema_manager = $this->getConn()
            ->getConnection()
            ->getDoctrineSchemaManager();

        return $schema_manager;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     *
     * @return \Doctrine\DBAL\Schema\Table
     */
    public function getTableDetails() {
        $table_details = $this->getSchemaManager()
            ->listTableDetails($this->getTable());

        return $table_details;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     *
     * @return \Doctrine\DBAL\Schema\Index[]
     */
    public function getTableIndexes() {
        $table_indexes = $this->getSchemaManager()
            ->listTableIndexes($this->getTable());

        return $table_indexes;
    }

    /**
     * @return bool
     */
    public function tableExists(string $table = null) {
        if (null == $table) {
            $table = $this->getTable();
        }

        return $this->getConn()->hasTable($table);
    }

    /**
     * @param string $col
     *
     * @return bool
     */
    public function hasColumn($col) {
        return $this->getConn()->hasColumn($this->getTable(), $col);
    }

    /**
     * @param string $sql
     */
    public function query($sql): void {
        $this->getConn()->getConnection()->statement($sql);
    }

    /**
     * @return bool
     */
    public function hasPrimaryKey() {
        $table_details = $this->getTableDetails();

        return $table_details->hasPrimaryKey();
    }

    public function dropPrimaryKey(): void {
        $table_details = $this->getTableDetails();
        $table_details->dropPrimaryKey();
        $sql = 'ALTER TABLE '.$this->getTable().' DROP PRIMARY KEY;';
        $this->query($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @return void
     */
    public function down() {
        $this->getConn()->dropIfExists($this->getTable());
    }

    public function tableCreate(Closure $next) {
        if (! $this->tableExists()) {
            $this->getConn()->create(
                $this->getTable(),
                $next
            );
        }
    }

    public function tableUpdate(Closure $next) {
        $this->getConn()->table(
            $this->getTable(),
            $next
        );
    }
}//end XotBaseMigration