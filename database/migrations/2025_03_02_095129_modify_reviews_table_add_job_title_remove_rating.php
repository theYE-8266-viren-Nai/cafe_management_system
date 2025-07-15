<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReviewsTableAddJobTitleRemoveRating extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Add job_title column (string)
            $table->string('job_title')->nullable()->after('content');

            // Remove rating column
            $table->dropColumn('rating');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Reverse: remove job_title and re-add rating
            $table->dropColumn('job_title');
            $table->integer('rating')->nullable()->after('content'); // Assuming rating was an integer
        });
    }
}
