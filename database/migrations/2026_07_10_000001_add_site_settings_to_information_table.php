<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('information')) {
            return;
        }

        $columns = [
            'frontend_logo' => 'string',
            'frontend_favicon' => 'string',
            'cms_favicon' => 'string',
            'cms_sidebar_logo' => 'string',
            'cms_login_logo' => 'string',
            'meta_title' => 'string',
            'meta_title_eng' => 'string',
            'meta_description' => 'text',
            'meta_description_eng' => 'text',
            'meta_keywords' => 'text',
            'meta_keywords_eng' => 'text',
            'meta_image' => 'string',
            'google_adsense_client_id' => 'string',
            'google_ads_head_script' => 'text',
            'google_ads_body_script' => 'text',
        ];

        foreach ($columns as $column => $type) {
            if (Schema::hasColumn('information', $column)) {
                continue;
            }

            Schema::table('information', function (Blueprint $table) use ($column, $type) {
                $table->{$type}($column)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('information')) {
            return;
        }

        foreach ([
            'google_ads_body_script',
            'google_ads_head_script',
            'google_adsense_client_id',
            'meta_image',
            'meta_keywords_eng',
            'meta_keywords',
            'meta_description_eng',
            'meta_description',
            'meta_title_eng',
            'meta_title',
            'cms_login_logo',
            'cms_sidebar_logo',
            'cms_favicon',
            'frontend_favicon',
            'frontend_logo',
        ] as $column) {
            if (! Schema::hasColumn('information', $column)) {
                continue;
            }

            Schema::table('information', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }
};
