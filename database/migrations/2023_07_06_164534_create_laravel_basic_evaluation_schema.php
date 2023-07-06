<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelBasicEvaluationSchema extends Migration
{
    protected const
        USERS                  = 'users',
        STATES                 = 'states',
        TODOLIST               = 'todolist',
        TASKS                  = 'tasks',
        TASK_USER              = 'task_user',
        STEPS                  = 'steps',
        PASSWORD_RESETS        = 'password_resets',
        FAILED_JOBS            = 'failed_jobs',
        PERSONAL_ACCESS_TOKENS = 'personal_access_tokens';

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        self::createUsersTable();
        self::createStatesTable();
        self::createTodolistTable();
        self::createTasksTable();
        self::createTaskUserTable();
        self::createStepsTable();
        self::createPasswordResetsTable();
        self::createFailedJobsTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        $drops = [
            self::FAILED_JOBS,
            self::PASSWORD_RESETS,
            self::STEPS,
            self::TASK_USER,
            self::TASKS,
            self::TODOLIST,
            self::STATES,
            self::USERS,
        ];

        foreach ($drops as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }

    protected static function createUsersTable()
    {
        Schema::create(self::USERS, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected static function createStatesTable()
    {
        Schema::create(self::STATES, function (Blueprint $table) {
            $table->id();
            $table->string('state');
        });
    }


    protected static function createTodolistTable()
    {
        Schema::create(self::TODOLIST, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->unique()->constrained();
            $table->foreignId('state_id')->constrained();
            $table->timestamps();
        });
    }
    
    protected static function createTasksTable()
    {
        Schema::create(self::TASKS, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('todolist_id');
            $table->foreign('todolist_id')->references('id')->on(self::TODOLIST);
            $table->foreignId('state_id')->constrained();
            $table->timestamps();
        });
    }

    protected static function createTaskUserTable()
    {
        Schema::create(self::TASK_USER, function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('user_id')->constrained();
        });
    }

    protected static function createStepsTable()
    {
        Schema::create(self::STEPS, function (Blueprint $table) {
            $table->id();
            $table->string('step');
            $table->foreignId('task_id')->constrained();
            $table->foreignId('state_id')->constrained();
        });
    }

    

    protected static function createPasswordResetsTable()
    {
        Schema::create(self::PASSWORD_RESETS, function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    protected static function createFailedJobsTable()
    {
        Schema::create(self::FAILED_JOBS, function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }
}
