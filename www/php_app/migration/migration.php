<?php
include('migration_helpers.php');



function migration($modelObj){
    $Inflector = new Inflector();
    $plural = $Inflector->tabela($modelObj->name);

    $uses = createMigrationUses();
    $atributos = attributes($modelObj);


    $migration = '
'.arrayToList($uses).'

class Create'.$modelObj->name.'Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        if (!Schema::hasTable(\''.$plural.'\')) {
            Schema::create('.$plural.', function (Blueprint $table) {
                '.arrayToList($atributos).'
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists(\''.$plural.'\');
    }
}
    ';

return $migration;
}