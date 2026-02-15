<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("assigned_to")->nullable()->constrained("users")->nullOnDelete();
            $table->enum('status', ['pending', 'in_progress', 'completed'])
                  ->default('pending');
            $table->string("title");
            $table->text("descryption")->nullable();
            $table->enum("priority",['high','medium','low']);
            $table->enum("status",['done','not_done'])->default('not_done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
