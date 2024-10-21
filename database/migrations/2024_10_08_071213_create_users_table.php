<?php
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'cashier']);
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

        $user = new User();
        $user->name = 'Antangin';
        $user->email = 'harix96486@searpen.com';
        $user->password = '$2y$10$5kw2RaeArMAZtwmoRoTtUO3qHy1qpDTPgahVVuE.bB294xwX6Yhu2';
        $user->role = 'admin';
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
