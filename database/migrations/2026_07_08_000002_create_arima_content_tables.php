<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('logo_header')->nullable();
            $table->string('logo_favicon')->nullable();
            $table->string('logo_company')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slogan')->nullable();
            $table->text('description')->nullable();
            $table->text('description_eng')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('phone_sms')->nullable();
            $table->string('phone_wa')->nullable();
            $table->text('google_map')->nullable();
            $table->text('link_wa')->nullable();
            $table->text('order_wa')->nullable();
            $table->string('website_link')->nullable();
            $table->string('sebaran_wilayah')->nullable();
            $table->timestamps();
        });

        foreach (['commercial', 'residential', 'factory', 'disinfection', 'cleaning'] as $service) {
            Schema::create("service_{$service}", function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('description_eng')->nullable();
                $table->string('background')->nullable();
                $table->text('list_type')->nullable();
                $table->timestamps();
            });
        }

        foreach (['general_pest', 'termite_baiting', 'fumigation'] as $method) {
            Schema::create("method_{$method}", function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('description_eng')->nullable();
                $table->string('header_image')->nullable();
                $table->timestamps();
            });
        }

        Schema::create('pest', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('header_image')->nullable();
            $table->timestamps();
        });

        Schema::create('pest_bugs', function (Blueprint $table) {
            $table->id();
            $table->string('types')->nullable();
            $table->string('title')->nullable();
            $table->string('title_eng')->nullable();
            $table->string('icon')->nullable();
            $table->string('header_image')->nullable();
            $table->text('ekosistem')->nullable();
            $table->text('ekosistem_eng')->nullable();
            $table->string('funfact')->nullable();
            $table->string('funfact_eng')->nullable();
            $table->text('penanggulangan')->nullable();
            $table->text('penanggulangan_eng')->nullable();
            $table->timestamps();
        });

        Schema::create('pest_detail_bugs', function (Blueprint $table) {
            $table->id();
            $table->string('title_bugs')->nullable();
            $table->foreignId('id_pest_bugs')->nullable()->constrained('pest_bugs')->nullOnDelete();
            $table->string('image')->nullable();
            $table->string('latin_title')->nullable();
            $table->timestamps();
        });

        Schema::create('pest_management_quality', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_eng')->nullable();
            $table->text('description')->nullable();
            $table->text('description_eng')->nullable();
            $table->timestamps();
        });

        Schema::create('pest_management_image', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('id_management')->nullable()->constrained('pest_management_quality')->nullOnDelete();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_eng')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('description_eng')->nullable();
            $table->timestamps();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('company')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });

        Schema::create('advantages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('portfolio', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('image_spec')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach ([
            'products',
            'portfolio',
            'advantages',
            'contact',
            'news',
            'slider',
            'pest_management_image',
            'pest_management_quality',
            'pest_detail_bugs',
            'pest_bugs',
            'pest',
            'method_fumigation',
            'method_termite_baiting',
            'method_general_pest',
            'service_cleaning',
            'service_disinfection',
            'service_factory',
            'service_residential',
            'service_commercial',
            'information',
        ] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
