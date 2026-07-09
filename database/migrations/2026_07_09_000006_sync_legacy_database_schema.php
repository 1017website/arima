<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('service')) {
            Schema::create('service', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('service')) {
            foreach ([
                1 => 'Commercial',
                2 => 'Residential',
                3 => 'Factory',
                4 => 'Disinfection',
            ] as $id => $title) {
                DB::table('service')->updateOrInsert(
                    ['id' => $id],
                    ['title' => $title, 'created_at' => null, 'updated_at' => null]
                );
            }
        }

        if (! Schema::hasTable('method')) {
            Schema::create('method', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('method')) {
            foreach ([
                1 => 'General Pest',
                2 => 'Termite Baiting',
                3 => 'Fumigation',
            ] as $id => $title) {
                DB::table('method')->updateOrInsert(
                    ['id' => $id],
                    ['title' => $title, 'created_at' => null, 'updated_at' => null]
                );
            }
        }

        if (Schema::hasTable('pest') && ! Schema::hasColumn('pest', 'title_eng')) {
            Schema::table('pest', function (Blueprint $table) {
                $table->string('title_eng')->nullable()->after('title');
            });
        }

        foreach (['service_commercial', 'service_residential', 'service_factory'] as $tableName) {
            if (Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'list_type_eng')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->text('list_type_eng')->nullable()->after('list_type');
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['service_commercial', 'service_residential', 'service_factory'] as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'list_type_eng')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('list_type_eng');
                });
            }
        }

        if (Schema::hasTable('pest') && Schema::hasColumn('pest', 'title_eng')) {
            Schema::table('pest', function (Blueprint $table) {
                $table->dropColumn('title_eng');
            });
        }
    }
};
