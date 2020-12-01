<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 表單
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_template_id');
            $table->string('form_name', 256)->comment('表單名稱');

            $table->foreignIdFor(User::class, 'create_user_id')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
