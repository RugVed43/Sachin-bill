<?php

namespace AntosGenerators\ModuleGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;

class ModuleMakeCommand extends Command
{

    // SAMPLE php artisan make:module Tester "name:string,fillable,nullable|number:integer,fillable,nullable"

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name : The model name} {attributes?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Model, Routes, Controller, Migration and Views for admin & user';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @var array The data types that can be created in a migration.
     */
    private $dataTypes = [
        'string', 'integer', 'boolean', 'bigIncrements', 'bigInteger',
        'binary', 'boolean', 'char', 'date', 'dateTime', 'float', 'increments',
        'json', 'jsonb', 'longText', 'mediumInteger', 'mediumText', 'nullableTimestamps',
        'smallInteger', 'tinyInteger', 'softDeletes', 'text', 'time', 'timestamp',
        'timestamps', 'rememberToken',
    ];

    private $fakerMethods = [
        'string' => ['method' => 'words', 'parameters' => '2, true'],
        'integer' => ['method' => 'randomNumber', 'parameters' => ''],
    ];

    /**
     * @var array $columnProperties Properties that can be applied to a table column.
     */
    private $columnProperties = [
        'unsigned', 'index', 'default', 'nullable',
    ];

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = trim($this->input->getArgument('name'));

        // $this->getModelAttrs("admin_id");

        $this->createModel($name);

        $this->createMigration($name);

        $this->createController($name);

        $this->createAgentController($name);

        $this->createAdminController($name);

        $this->createClientApiController($name);

        $this->createAgentApiController($name);

        $this->createAdminApiController($name);

        $this->appendRoutes($name);

        $this->createAdminView($name);

        $this->createAdminsView($name);

        $this->createUserView($name);

        $this->createUsersView($name);

        $this->createAgentView($name);

        $this->createAgentsView($name);

        $this->addMenuEntries($name);

        $this->setAllViewComposerVars($name);

        exec("php artisan config:cache");
        exec("php artisan config:clear");
        exec("php artisan route:clear");
        exec("php artisan optimize:clear");
        exec("composer dumpautoload");

    }

    private function createAdminView($name)
    {
        $view = strtolower($this->modelName($name));
        // $name = "nullable";

        $stub = $this->files->get(__DIR__ . '/../Stubs/admin_single.stub');

        $stub = str_replace('myTitle', ucwords($view), $stub);

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myFormFields', str_replace('myVar', $view, $this->getFormFields()), $stub);

        $filename = $view . '.blade.php';

        $this->files->put(resource_path('views/admin/' . $filename), $stub);

        $this->info('Created Admin Form View');

        return true;
    }
    private function createAdminsView($name)
    {
        $view = strtolower($this->modelName($name));

        $stub = $this->files->get(__DIR__ . '/../Stubs/admin_multiple.stub');

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myTableColNames', $this->getTableColNames($view), $stub);

        $stub = str_replace('myTableColumns', $this->getTableCols($view), $stub);

        $filename = $view . 's.blade.php';

        $this->files->put(resource_path('views/admin/' . $filename), $stub);

        $this->info('Created Admin Manage View');

        return true;
    }

    private function createUserView($name)
    {
        $view = strtolower($this->modelName($name));

        $stub = $this->files->get(__DIR__ . '/../Stubs/user_single.stub');

        $stub = str_replace('myTitle', ucwords($view), $stub);

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myFormFields', str_replace('myVar', $view, $this->getFormFields()), $stub);

        $filename = $view . '.blade.php';

        $this->files->put(resource_path('views/' . $filename), $stub);

        $this->info('Created User Form View');

        return true;
    }
    private function createUsersView($name)
    {
        $view = strtolower($this->modelName($name));

        $stub = $this->files->get(__DIR__ . '/../Stubs/user_multiple.stub');

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myTableColNames', $this->getTableColNames($view), $stub);

        $stub = str_replace('myTableColumns', $this->getTableCols($view), $stub);

        $filename = $view . 's.blade.php';

        $this->files->put(resource_path('views/' . $filename), $stub);

        $this->info('Created User Manage View');

        return true;
    }

    private function createAgentView($name)
    {
        $view = strtolower($this->modelName($name));

        $stub = $this->files->get(__DIR__ . '/../Stubs/agent_single.stub');

        $stub = str_replace('myTitle', ucwords($view), $stub);

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myFormFields', str_replace('myVar', $view, $this->getFormFields()), $stub);

        $filename = $view . '.blade.php';

        $this->files->put(resource_path('views/agent/' . $filename), $stub);

        $this->info('Created User Form View');

        return true;
    }
    private function createAgentsView($name)
    {
        $view = strtolower($this->modelName($name));

        $stub = $this->files->get(__DIR__ . '/../Stubs/agent_multiple.stub');

        $stub = str_replace('myVar', $view, $stub);

        $stub = str_replace('myTableColNames', $this->getTableColNames($view), $stub);

        $stub = str_replace('myTableColumns', $this->getTableCols($view), $stub);

        $filename = $view . 's.blade.php';

        $this->files->put(resource_path('views/agent/' . $filename), $stub);

        $this->info('Created User Manage View');

        return true;
    }

    public function buildFakerAttributes($attributes)
    {
        $faker = '';

        foreach ($attributes as $attribute) {

            $formatter =
            $this->fakerMethods[$this->getFieldTypeFromProperties($attribute['properties'])];

            $method = $formatter['method'];
            $parameters = $formatter['parameters'];

            $faker .= "'" . $attribute['name'] . "' => \$faker->" . $method . "(" . $parameters . ")," . PHP_EOL . '        ';

        }

        return rtrim($faker);
    }

    /**
     * Create and store a new Model to the filesystem.
     *
     * @param string $name
     * @return bool
     */
    private function createModel($name)
    {
        $modelName = $this->modelName($name);

        $filename = $modelName . '.php';

        if ($this->files->exists(app_path($filename))) {
            $this->error('Model already exists!');
            return false;
        }

        $model = $this->buildModel($name);

        $this->files->put(app_path('/' . $filename), $model);

        $this->info($modelName . ' Model created');

        return true;
    }

    private function createMigration($name)
    {
        $filename = $this->buildMigrationFilename($name);

        if ($this->files->exists(database_path($filename))) {
            $this->error('Migration already exists!');
            return false;
        }

        $migration = $this->buildMigration($name);

        $this->files->put(
            database_path('/migrations/' . $filename),
            $migration
        );

        if (env('APP_ENV') != 'testing') {
            $this->composer->dumpAutoloads();
        }

        $this->info('Created migration ' . $filename);

        return true;
    }

    private function createController($modelName)
    {
        $filename = ucfirst($modelName) . 'Controller.php';
        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));

        if ($this->files->exists(app_path('Http/Controllers/User/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);

        $inputHandlers = "";
        foreach ($attributes as $name => $properties) {
            if (
                strpos(strtolower($name), "pic") > -1 ||
                strpos(strtolower($name), "photo") > -1 ||
                strpos(strtolower($name), "image") > -1 ||
                strpos(strtolower($name), "screenshot") > -1 ||
                strpos(strtolower($name), "attach") > -1 ||
                strpos(strtolower($name), "upload") > -1 ||
                strpos(strtolower($name), "copy") > -1 ||
                strpos(strtolower($name), "file") > -1
            ) {
                $inputHandlers .= "if (isset(\$input['" . strtolower($name) . "'])) {
                    \$input['" . strtolower($name) . "'] = \"storage/\" . Req::file('" . strtolower($name) . "')->store('" . strtolower($name) . "', 'storage');
                } else {
                    unset(\$input['" . strtolower($name) . "']);
                }\n";
            }
            if (strpos(strtolower($name), "password") > -1) {
                $inputHandlers .= "\t\t\tif (isset(\$input['" . strtolower($name) . "'])) {
                    if (empty(\$input['" . strtolower($name) . "'])) {
                           unset(\$input['" . strtolower($name) . "']);
                    }
                } \n";
            }
        }

        $stub = str_replace('myModelInputs', $inputHandlers, $stub);

        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/User/' . $filename), $stub);

        $this->info('Created controller ' . $filename);

        return true;
    }
    private function createAgentController($modelName)
    {
        $filename = 'Agent' . ucfirst($modelName) . 'Controller.php';
        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));

        if ($this->files->exists(app_path('Http/Controllers/Agent/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/agent_controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);

        $inputHandlers = "";
        foreach ($attributes as $name => $properties) {
            if (
                strpos(strtolower($name), "pic") > -1 ||
                strpos(strtolower($name), "photo") > -1 ||
                strpos(strtolower($name), "image") > -1 ||
                strpos(strtolower($name), "screenshot") > -1 ||
                strpos(strtolower($name), "attach") > -1 ||
                strpos(strtolower($name), "upload") > -1 ||
                strpos(strtolower($name), "copy") > -1 ||
                strpos(strtolower($name), "file") > -1
            ) {
                $inputHandlers .= "if (isset(\$input['" . strtolower($name) . "'])) {
                    \$input['" . strtolower($name) . "'] = \"storage/\" . Req::file('" . strtolower($name) . "')->store('" . strtolower($name) . "', 'storage');
                } else {
                    unset(\$input['" . strtolower($name) . "']);
                }\n";
            }
            if (strpos(strtolower($name), "password") > -1) {
                $inputHandlers .= "\t\t\tif (isset(\$input['" . strtolower($name) . "'])) {
                    if (empty(\$input['" . strtolower($name) . "'])) {
                           unset(\$input['" . strtolower($name) . "']);
                    }
                } \n";
            }
        }

        $stub = str_replace('myModelInputs', $inputHandlers, $stub);

        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/Agent/' . $filename), $stub);

        $this->info('Created controller ' . $filename);

        return true;
    }
    private function createAdminController($modelName)
    {
        $filename = 'Manage' . ucfirst($modelName) . 'Controller.php';
        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));

        if ($this->files->exists(app_path('Http/Controllers/Admin/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/admin_controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);
        $inputHandlers = "";
        foreach ($attributes as $name => $properties) {
            if (
                strpos(strtolower($name), "pic") > -1 ||
                strpos(strtolower($name), "photo") > -1 ||
                strpos(strtolower($name), "image") > -1 ||
                strpos(strtolower($name), "screenshot") > -1 ||
                strpos(strtolower($name), "attach") > -1 ||
                strpos(strtolower($name), "upload") > -1 ||
                strpos(strtolower($name), "copy") > -1 ||
                strpos(strtolower($name), "file") > -1
            ) {
                $inputHandlers .= "if (isset(\$input['" . strtolower($name) . "'])) {
                    \$input['" . strtolower($name) . "'] = \"storage/\" . Req::file('" . strtolower($name) . "')->store('" . strtolower($name) . "', 'storage');
                } else {
                    unset(\$input['" . strtolower($name) . "']);
                }\n";
            }
            if (strpos(strtolower($name), "password") > -1) {
                $inputHandlers .= "\t\t\tif (isset(\$input['" . strtolower($name) . "'])) {
                    if (empty(\$input['" . strtolower($name) . "'])) {
                           unset(\$input['" . strtolower($name) . "']);
                    }
                } \n";
            }
        }

        $stub = str_replace('myModelInputs', $inputHandlers, $stub);

        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/Admin/' . $filename), $stub);

        $this->info('Created Admin controller ' . $filename);

        return true;
    }
    private function createClientApiController($modelName)
    {
        $filename = 'Api' . ucfirst($modelName) . 'Controller.php';

        if ($this->files->exists(app_path('Http/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/api_controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);
        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/Api/User/' . $filename), $stub);

        $this->info('Created CLIENT API controller ' . $filename);

        return true;
    }

    private function createAdminApiController($modelName)
    {
        $filename = 'mApi' . ucfirst($modelName) . 'Controller.php';

        if ($this->files->exists(app_path('Http/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/api_admin_controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);
        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/Api/Admin/' . $filename), $stub);

        $this->info('Created ADMIN API controller ' . $filename);

        return true;
    }
    private function createAgentApiController($modelName)
    {
        $filename = 'aApi' . ucfirst($modelName) . 'Controller.php';

        if ($this->files->exists(app_path('Http/' . $filename))) {
            $this->error('Controller already exists!');
            return false;
        }

        $stub = $this->files->get(__DIR__ . '/../Stubs/api_agent_controller.stub');

        $stub = str_replace('MyModelClass', ucfirst($modelName), $stub);
        $stub = str_replace('myModelInstance', strtolower($modelName), $stub);
        // $stub = str_replace('template', strtolower($modelName), $stub);

        $this->files->put(app_path('Http/Controllers/Api/Agent/' . $filename), $stub);

        $this->info('Created ADMIN API controller ' . $filename);

        return true;
    }

    private function appendRoutes($modelName)
    {
        $modelTitle = ucfirst($modelName);

        $modelName = strtolower($modelName);

        $newRoutes = $this->files->get(__DIR__ . '/../Stubs/user_route.stub');
        $newRoutes = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes);
        $newRoutes = str_replace('|MODEL_NAME|', $modelName, $newRoutes);
        $newRoutes = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes);
        $r1 = $this->files->get(base_path('routes/web.php'));
        $r1 = str_replace('//USER_ROUTES', $newRoutes, $r1);
        file_put_contents(base_path('routes/web.php'), $r1);

        $newRoutes1 = $this->files->get(__DIR__ . '/../Stubs/agent_route.stub');
        $newRoutes1 = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes1);
        $newRoutes1 = str_replace('|MODEL_NAME|', $modelName, $newRoutes1);
        $newRoutes1 = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes1);
        $r2 = $this->files->get(base_path('routes/web.php'));
        $r2 = str_replace('//AGENT_ROUTES', $newRoutes1, $r2);
        file_put_contents(base_path('routes/web.php'), $r2);

        $newRoutes1 = $this->files->get(__DIR__ . '/../Stubs/admin_route.stub');
        $newRoutes1 = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes1);
        $newRoutes1 = str_replace('|MODEL_NAME|', $modelName, $newRoutes1);
        $newRoutes1 = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes1);
        $r2 = $this->files->get(base_path('routes/web.php'));
        $r2 = str_replace('//ADMIN_ROUTES', $newRoutes1, $r2);
        file_put_contents(base_path('routes/web.php'), $r2);

        $newRoutes2 = $this->files->get(__DIR__ . '/../Stubs/api_admin_route.stub');
        $newRoutes2 = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes2);
        $newRoutes2 = str_replace('|MODEL_NAME|', $modelName, $newRoutes2);
        $newRoutes2 = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes2);
        $r3 = $this->files->get(base_path('routes/api.php'));
        $r3 = str_replace('//ADMIN_API_ROUTES', $newRoutes2, $r3);
        file_put_contents(base_path('routes/api.php'), $r3);

        $newRoutes2 = $this->files->get(__DIR__ . '/../Stubs/api_agent_route.stub');
        $newRoutes2 = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes2);
        $newRoutes2 = str_replace('|MODEL_NAME|', $modelName, $newRoutes2);
        $newRoutes2 = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes2);
        $r3 = $this->files->get(base_path('routes/api.php'));
        $r3 = str_replace('//AGENT_API_ROUTES', $newRoutes2, $r3);
        file_put_contents(base_path('routes/api.php'), $r3);

        $newRoutes2 = $this->files->get(__DIR__ . '/../Stubs/api_route.stub');
        $newRoutes2 = str_replace('|MODEL_TITLE|', $modelTitle, $newRoutes2);
        $newRoutes2 = str_replace('|MODEL_NAME|', $modelName, $newRoutes2);
        $newRoutes2 = str_replace('|CONTROLLER_NAME|', $modelTitle . 'Controller', $newRoutes2);
        $r3 = $this->files->get(base_path('routes/api.php'));
        $r3 = str_replace('//CLIENT_API_ROUTES', $newRoutes2, $r3);
        file_put_contents(base_path('routes/api.php'), $r3);

        $this->info('Added routes for ' . $modelTitle);
    }

    protected function buildMigration($name)
    {
        $stub = $this->files->get(__DIR__ . '/../Stubs/migration.stub');

        $className = 'Create' . Str::plural($name) . 'Table';

        $stub = str_replace('MIGRATION_CLASS_PLACEHOLDER', $className, $stub);

        $table = strtolower(Str::plural($name));

        $stub = str_replace('TABLE_NAME_PLACEHOLDER', $table, $stub);

        $class = 'App\\' . $name;
        $model = new $class;

        $stub = str_replace('MIGRATION_COLUMNS_PLACEHOLDER', $this->buildTableColumns($model->migrationAttributes()), $stub);

        return $stub;
    }

    protected function buildModel($name)
    {
        $stub = $this->files->get(__DIR__ . '/../Stubs/model.stub');

        $stub = $this->replaceClassName($name, $stub);

        $stub = str_replace('TABLE_PLACEHOLDER', strtolower($name), $stub);

        $stub = $this->addMigrationAttributes($this->argument('attributes'), $stub);

        $stub = $this->addModelAttributes('fillable', $this->argument('attributes'), $stub);

        $stub = $this->addModelAttributes('hidden', $this->argument('attributes'), $stub);

        $stub = $this->addModelAttributes('date', $this->argument('attributes'), $stub);

        return $stub;
    }

    public function convertModelToTableName($model)
    {
        return Str::plural(Str::snake($model));
    }

    public function buildMigrationFilename($model)
    {
        $table = $this->convertModelToTableName($model);

        return date('Y_m_d_his') . '_create_' . $table . '_table.php';
    }

    private function replaceClassName($name, $stub)
    {
        return str_replace('NAME_PLACEHOLDER', $name, $stub);
    }

    private function addMigrationAttributes($text, $stub)
    {
        $attributesAsArray = $this->parseAttributesFromInputString($text);
        $attributesAsText = $this->convertArrayToString($attributesAsArray);

        return str_replace('MIGRATION_ATTRIBUTES_PLACEHOLDER', $attributesAsText, $stub);
    }

    /**
     * Convert a pipe-separated list of attributes to an array.
     *
     * @param string $text The Pipe separated attributes
     * @return array
     */
    public function parseAttributesFromInputString($text)
    {
        $parts = explode('|', $text);

        $attributes = [];

        foreach ($parts as $part) {
            $components = explode(':', $part);
            $attributes[$components[0]] =
            isset($components[1]) ? explode(',', $components[1]) : [];
        }

        return $attributes;

    }

    /**
     * Convert a PHP array into a string version.
     *
     * @param $array
     *
     * @return string
     */
    public function convertArrayToString($array)
    {
        $string = '[';

        foreach ($array as $name => $properties) {
            $string .= '[';
            $string .= "'name' => '" . $name . "',";

            $string .= "'properties' => [";
            foreach ($properties as $property) {
                $string .= "'" . $property . "', ";
            }
            $string = rtrim($string, ', ');
            $string .= ']';

            $string .= '],';
        }

        $string = rtrim($string, ',');

        $string .= ']';

        return $string;
    }

    public function addModelAttributes($name, $attributes, $stub)
    {
        $attributes = '[' . collect($this->parseAttributesFromInputString($attributes))
            ->filter(function ($attribute) use ($name) {
                return in_array($name, $attribute);
            })->map(function ($attributes, $name) {
            return "'" . $name . "'";
        })->values()->implode(', ') . ']';

        return str_replace(strtoupper($name) . '_PLACEHOLDER', $attributes, $stub);
    }

    public function buildTableColumns($attributes)
    {

        return rtrim(collect($attributes)->reduce(function ($column, $attribute) {

            $fieldType = $this->getFieldTypeFromProperties($attribute['properties']);

            if ($length = $this->typeCanDefineSize($fieldType)) {
                $length = $this->extractFieldLengthValue($attribute['properties']);
            }

            $properties = $this->extractAttributePropertiesToApply($attribute['properties']);

            return $column . $this->buildSchemaColumn($fieldType, $attribute['name'], $length, $properties);

        }));

    }

    /**
     * Get the column field type based from the properties of the field being created.
     *
     * @param array $properties
     * @return string
     */
    private function getFieldTypeFromProperties($properties)
    {
        $type = array_intersect($properties, $this->dataTypes);

        // If the properties that were given in the command
        // do not explicitly define a data type, or there
        // is no matching data type found, the column
        // should be cast to a string.

        if (!$type) {
            return 'string';
        }

        return $type[0];
    }

    /**
     * Can the data type have it's size controlled within the migration?
     *
     * @param string $type
     * @return bool
     */
    private function typeCanDefineSize($type)
    {
        return $type == 'string' || $type == 'char';
    }

    /**
     * Extract a numeric length value from all properties specified for the attribute.
     *
     * @param array $properties
     * @return int $length
     */
    private function extractFieldLengthValue($properties)
    {
        foreach ($properties as $property) {
            if (is_numeric($property)) {
                return $property;
            }
        }

        return 0;
    }

    /**
     * Get the column properties that should be applied to the column.
     *
     * @param $properties
     * @return array
     */
    private function extractAttributePropertiesToApply($properties)
    {
        return array_intersect($properties, $this->columnProperties);
    }

    /**
     * Create a Schema Builder column.
     *
     * @param string $fieldType The type of column to create
     * @param string $name Name of the column to create
     * @param int $length Field length
     * @param array $traits Additional properties to apply to the column
     * @return string
     */
    private function buildSchemaColumn($fieldType, $name, $length = 0, $traits = [])
    {
        return sprintf("\$table->%s('%s'%s)%s;" . PHP_EOL . '            ',
            $fieldType,
            $name,
            $length > 0 ? ", $length" : '',
            implode('', array_map(function ($trait) {
                return '->' . $trait . '()';
            }, $traits))
        );
    }

    /**
     * Build a Model name from a word.
     *
     * @param string $name
     * @return string
     */
    private function modelName($name)
    {
        return ucfirst($name);
    }
    private function getFormFields()
    {
        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));
        $fields = [];
        foreach ($attributes as $name => $properties) {
            $required = in_array("nullable", $properties) ? null : "required";
            $classes = null;
            if (
                strpos(strtolower($name), "id") > -1 ||
                strpos(strtolower($name), "date") > -1 ||
                strpos(strtolower($name), "time") > -1 ||
                strpos(strtolower($name), "pic") > -1 ||
                strpos(strtolower($name), "photo") > -1 ||
                strpos(strtolower($name), "img") > -1 ||
                strpos(strtolower($name), "image") > -1 ||
                strpos(strtolower($name), "screenshot") > -1 ||
                strpos(strtolower($name), "attach") > -1 ||
                strpos(strtolower($name), "upload") > -1 ||
                strpos(strtolower($name), "copy") > -1 ||
                strpos(strtolower($name), "file") > -1
            ) {
                if (strpos(strtolower($name), "id") > -1) {
                    $classes = "select2";
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'select',\n" .
                    "\t\t\t\t\t\t\t'selectVar' =>\$" . strtolower(str_replace("_", "", str_replace("id", "", $name))) . "s->pluck(\"name\",\"id\"),\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";
                }
                if (strpos(strtolower($name), "date") > -1 || strpos(strtolower($name), "time") > -1) {

                    if (strpos(strtolower($name), "time") < 0 && strpos(strtolower($name), "date") > -1) {
                        $classes .= "date";
                    } elseif (strpos(strtolower($name), "date") < 0 && strpos(strtolower($name), "time") > -1) {
                        $classes .= "time";
                    } elseif (strpos(strtolower($name), "time") > -1 && strpos(strtolower($name), "date") > -1) {
                        $classes .= "datetime";
                    } else {
                        $classes .= "datetime";
                    }
                    $classes .= "picker";
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'string',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";

                }

                if (
                    strpos(strtolower($name), "pic") > -1 ||
                    strpos(strtolower($name), "photo") > -1 ||
                    strpos(strtolower($name), "img") > -1 ||
                    strpos(strtolower($name), "image") > -1 ||
                    strpos(strtolower($name), "screenshot") > -1 ||
                    strpos(strtolower($name), "attach") > -1 ||
                    strpos(strtolower($name), "upload") > -1 ||
                    strpos(strtolower($name), "copy") > -1 ||
                    strpos(strtolower($name), "file") > -1
                ) {
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'file',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t//'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";

                }

            } else {
                if (array_intersect(["string", 'password', 'integer', 'decimal', 'double', 'float'], $properties)) {
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'string',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";
                }
                if (array_intersect(['date'], $properties)) {
                    $classes = "datepicker";
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'date',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";
                }
                if (array_intersect(['dateTime'], $properties)) {
                    $classes = "datetimepicker";

                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'datetime',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";
                }

                if (array_intersect(["text", "longText", "mediumText"], $properties)) {
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'text',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";

                }
                if (!array_intersect([
                    "string",
                    'password',
                    'integer',
                    'decimal',
                    'double',
                    'float',
                    'date',
                    'dateTime',
                    "text",
                    "longText",
                    "mediumText",
                    'integer',
                    'decimal',
                    'double',
                    'float',
                ], $properties)) {
                    $fields[] = "\n\t\t\t\t\t'" . $name . "'=> [ \n" .
                    "\t\t\t\t\t\t\t'name' =>'" . ucwords(strtolower(str_replace("_", " ", $name))) . "',\n" .
                    "\t\t\t\t\t\t\t'type' =>'string',\n" .
                    "\t\t\t\t\t\t\t//'selectVar' =>[]\n" .
                    "\t\t\t\t\t\t\t'editVal' =>isset(\$edit) ? \$myVar['" . strtolower($name) . "'] : null,\n" .
                    "\t\t\t\t\t\t\t'required' =>'" . $required . "',\n" .
                    "\t\t\t\t\t\t\t'disabled' =>'',\n" .
                    "\t\t\t\t\t\t\t'placeholder' =>'',\n" .
                    "\t\t\t\t\t\t\t'classes' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'style' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'divStyle' =>'" . $classes . "',\n" .
                    "\t\t\t\t\t\t\t'id' =>'" . strtolower($name) . "',\n" .
                    "\t\t\t\t\t\t\t'divId' =>'" . strtolower($name) . "Div',\n" .
                    "\t\t\t\t\t\t\t'key' =>'" . strtolower($name) . "',\n"
                        . "\t\t\t\t\t],\n";
                }
            }
        }
        $formfields = "";
        for ($i = 1; $i < sizeof($fields) + 1; $i++) {
            $formfields .= $fields[$i - 1];
        }
        $j = 0;
        $col1 = $col2 = "";
        foreach ($attributes as $name => $properties) {
            if ($j % 2 == 0) {
                $col1 .= "\t@include('inc.formFields',['field' => \$formfields['" . $name . "']])\n";
            }
            if ($j % 2 != 0) {
                $col2 .= "\t@include('inc.formFields',['field' => \$formfields['" . $name . "']])\n";
            }
            $j++;
        }

        $html = "";
        $html .= "\t\t<?php" . "\n \t\t\t\$formfields = [";
        $html .= $formfields . "";
        $html .= "\t]; \n ?>\n";
        $html .= "<div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">\n";
        $html .= "\t<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">\n";
        $html .= "\t\t" . $col1 . "";
        $html .= "\t</div>\n";
        $html .= "</div>";
        $html .= "\n<div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\">\n";
        $html .= "\t<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">\n";
        $html .= "\t\t" . $col2 . "";
        $html .= "\t</div>\n";
        $html .= "</div>";
        $html .= "";
        return $html;
    }
    private function getTableColNames($var)
    {

        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));
        $tds = [];
        foreach ($attributes as $name => $properties) {
            $tds[] = "\t<th>" . ucwords(strtolower(str_replace("_", " ", str_replace("_id", "", $name)))) . "</th>\n";
        }
        return implode("\n", $tds);
    }
    private function getTableCols($var)
    {

        $attributes = $this->parseAttributesFromInputString($this->argument('attributes'));
        $tds = [];
        foreach ($attributes as $name => $properties) {
            $tds[] = "\t<td>{{ $" . $var . "->" . $name . " }}</td>\n";
        }
        return implode("\n", $tds);
    }
    public function getModelAttrs($attr)
    {
        $path = app_path();
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') {
                continue;
            }

            if (is_dir($path . "/" . $result)) {
                continue;
            }

            // if (in_array(str_replace(".php", "", $result), ['Admin','User','Agent'])) continue;
            echo str_replace(".php", "", $result) . "\n";
        }

// var_dump(getModels($path));
    }
    public function addMenuEntries($model)
    {

        $menu = $this->files->get(resource_path('views/layouts/lmenu.blade.php'));
        $menu = str_replace('{{-- myUserMenuEntry --}}', $this->getUserMenuEntry($model), $menu);
        $menu = str_replace('{{-- myAgentMenuEntry --}}', $this->getAgentMenuEntry($model), $menu);
        $menu = str_replace('{{-- myAdminMenuEntry --}}', $this->getAdminMenuEntry($model), $menu);

        file_put_contents(resource_path('views/layouts/lmenu.blade.php'), $menu);
        return true;
    }
    public function getAdminMenuEntry($model)
    {
        $name = strtolower($model);
        $html = "";
        $html .= "\t<li>\n";
        $html .= "\t\t\t<a data-toggle='collapse' href='#" . $name . "'>\n";
        $html .= "\t\t\t\t<i class='material-icons'>people</i>\n";
        $html .= "\t\t\t\t<p>" . $model . "s\n";
        $html .= "\t\t\t\t<b class='caret'></b>\n";
        $html .= "\t\t\t\t</p>\n";
        $html .= "\t\t\t</a>\n";
        $html .= "\t\t\t<div class='collapse' id='" . $name . "'>\n";
        $html .= "\t\t\t\t<ul class='nav'>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"m" . $name . ".create\") }}'><i class='fa fa-circle-o'></i> Add " . $model . "</a></li>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"m" . $name . ".index\") }}'><i class='fa fa-circle-o'></i> View " . $model . "s</a></li>\n";
        $html .= "\t\t\t\t</ul>\n";
        $html .= "\t\t\t</div>\n";
        $html .= "\t\t</li>\n";
        $html .= "\t\t{{-- myAdminMenuEntry --}}";
        return $html;
    }
    public function getAgentMenuEntry($model)
    {
        $name = strtolower($model);
        $html = "";
        $html .= "\t<li>\n";
        $html .= "\t\t\t<a data-toggle='collapse' href='#" . $name . "'>\n";
        $html .= "\t\t\t\t<i class='material-icons'>people</i>\n";
        $html .= "\t\t\t\t<p>" . $model . "s\n";
        $html .= "\t\t\t\t<b class='caret'></b>\n";
        $html .= "\t\t\t\t</p>\n";
        $html .= "\t\t\t</a>\n";
        $html .= "\t\t\t<div class='collapse' id='" . $name . "'>\n";
        $html .= "\t\t\t\t<ul class='nav'>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"a" . $name . ".create\") }}'><i class='fa fa-circle-o'></i> Add " . $model . "</a></li>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"a" . $name . ".index\") }}'><i class='fa fa-circle-o'></i> View " . $model . "s</a></li>\n";
        $html .= "\t\t\t\t</ul>\n";
        $html .= "\t\t\t</div>\n";
        $html .= "\t\t</li>\n";
        $html .= "\t\t{{-- myAgentMenuEntry --}}";
        return $html;
    }
    public function getUserMenuEntry($model)
    {
        $name = strtolower($model);
        $html = "";
        $html .= "\t<li>\n";
        $html .= "\t\t\t<a data-toggle='collapse' href='#" . $name . "'>\n";
        $html .= "\t\t\t\t<i class='material-icons'>people</i>\n";
        $html .= "\t\t\t\t<p>" . $model . "s\n";
        $html .= "\t\t\t\t<b class='caret'></b>\n";
        $html .= "\t\t\t\t</p>\n";
        $html .= "\t\t\t</a>\n";
        $html .= "\t\t\t<div class='collapse' id='" . $name . "'>\n";
        $html .= "\t\t\t\t<ul class='nav'>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"" . $name . ".create\") }}'><i class='fa fa-circle-o'></i> Add " . $model . "</a></li>\n";
        $html .= "\t\t\t\t\t<li><a href='{{ route(\"" . $name . ".index\") }}'><i class='fa fa-circle-o'></i> View " . $model . "s</a></li>\n";
        $html .= "\t\t\t\t</ul>\n";
        $html .= "\t\t\t</div>\n";
        $html .= "\t\t</li>\n";
        $html .= "\t\t{{-- myUserMenuEntry --}}";
        return $html;
    }
    public function setAllViewComposerVars($name)
    {

        $viewcom = $this->files->get(__DIR__ . "/../../../../../app/Http/ViewComposers/AllViewComposer.php");
        var_dump($name);
        $collect = "\$" . strtolower($name) . "s = collect([]);\n\t\t//declareVar";
        $respond = "'" . strtolower($name) . "s' => \$" . strtolower($name) . "s,\n\t\t\t//respondVar";
        $viewcom = str_replace('//declareVar', $collect, $viewcom);
        $viewcom = str_replace('//respondVar', $respond, $viewcom);

        file_put_contents(__DIR__ . "/../../../../../app/Http/ViewComposers/AllViewComposer.php", $viewcom);
        return true;
    }

}
