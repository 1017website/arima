<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('home_contents')) {
            if (!Schema::hasColumn('home_contents', 'iso_is_active')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->boolean('iso_is_active')->default(true);
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_kicker')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->string('iso_kicker')->nullable();
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_kicker_eng')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->string('iso_kicker_eng')->nullable();
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_title')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->string('iso_title')->nullable();
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_title_eng')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->string('iso_title_eng')->nullable();
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_description')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->text('iso_description')->nullable();
                });
            }
            if (!Schema::hasColumn('home_contents', 'iso_description_eng')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->text('iso_description_eng')->nullable();
                });
            }

            DB::table('home_contents')->whereNull('iso_kicker')->update([
                'iso_is_active' => true,
                'iso_kicker' => 'Sertifikasi',
                'iso_kicker_eng' => 'Certification',
                'iso_title' => 'Standar Mutu & Sertifikasi ISO',
                'iso_title_eng' => 'Quality Standard & ISO Certification',
                'iso_description' => 'Komitmen ARIMA Indonesia terhadap standar mutu, keselamatan, dan layanan profesional yang terdokumentasi.',
                'iso_description_eng' => 'ARIMA Indonesia is committed to documented quality, safety, and professional service standards.',
            ]);
        }

        Schema::create('home_isos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_eng')->nullable();
            $table->text('image')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('home_isos')->insert([
            [
                'title' => 'Sertifikat ISO 1',
                'title_eng' => 'ISO Certificate 1',
                'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1783611268/IMG_4073_ykldoe.png',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sertifikat ISO 2',
                'title_eng' => 'ISO Certificate 2',
                'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1783611268/IMG_4074_zhymcp.png',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sertifikat ISO 3',
                'title_eng' => 'ISO Certificate 3',
                'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1783611268/IMG_4072_rdopba.png',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('home_isos');

        if (Schema::hasTable('home_contents')) {
            foreach ([
                'iso_description_eng',
                'iso_description',
                'iso_title_eng',
                'iso_title',
                'iso_kicker_eng',
                'iso_kicker',
                'iso_is_active',
            ] as $column) {
                if (Schema::hasColumn('home_contents', $column)) {
                    Schema::table('home_contents', function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                }
            }
        }
    }
};
