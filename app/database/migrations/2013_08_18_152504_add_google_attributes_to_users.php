<?php

use Illuminate\Database\Migrations\Migration;

class AddGoogleAttributesToUsers extends Migration {

  public function up() {
    Schema::table('users', function($table) {
      $table->string('google_access_token')->nullable();
      $table->timestamp('google_access_token_expires_at')->nullable();
      $table->string('google_photoURL')->nullable();
    });
  }

  public function down() {
    Schema::table('users', function($table) {
      $table->dropColumn('google_access_token', 'google_access_token_expires_at', 'google_photoURL');
    });
  }

}
