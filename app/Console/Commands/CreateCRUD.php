<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateCRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {crud_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD structure';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $className            = $this->argument('crud_name');
        $tableName            = $this->generateTableName($className);
        $lowerClassName       = lcfirst($className);

        $templateInfo = [
            'className'            => $className,
            'tableName'            => $tableName,
            'lowerClassName'       => $lowerClassName,
        ];

        $this->createModelFile($className, $templateInfo);
        $this->createBoFile($className, $templateInfo);
        $this->createRequestFile($className, $templateInfo);
        $this->createControllerFile($className, $templateInfo);
        $this->createRepositoryFile($className, $templateInfo);
        $this->createTraitFile($className, $templateInfo);

        $this->comment("Please, add your route manually.");
    }

    private function createModelFile($className, $templateInfo)
    {
        $this->createFile("/Models", $className, $templateInfo);
    }

    private function createBoFile($className, $templateInfo)
    {
        $this->createFile("/BO", $className, $templateInfo, "BO");
    }

    private function createTraitFile($className, $templateInfo)
    {
        $this->createFile("/BO/Traits", $className, $templateInfo, "Trait");
    }

    private function createRequestFile($className, $templateInfo)
    {
        $this->createFile("/Http/Requests", $className, $templateInfo, "Request");
    }

    private function createControllerFile($className, $templateInfo)
    {
        $this->createFile("/Http/Controllers", $className, $templateInfo, "Controller");
    }

    private function createRepositoryFile($className, $templateInfo)
    {
        $this->createFile("/Repositories", $className, $templateInfo, "Repository");
    }

    /**
     * Create a file with specified name and inner content, in a specified directory
     *
     * @param string $pathDir
     * @param string $className
     * @param string $type
     * @param string $content
     */
    private function createFile($pathDir, $className, $templateInfo, $type = null)
    {
        $templateName = $type ?? "Model";
        $content = "<?php\n".view("crud_templates.{$templateName}Template", $templateInfo)->render()."\n";
        $pathDir = app_path().$pathDir;
        if (!is_dir($pathDir))
        {
            mkdir($pathDir);
        }

        $completePath = $pathDir."/".$className.$type.".php";
        if (file_exists($completePath))
        {
            $completePath = $pathDir."/".$className.$type."_new.php";
        }
        file_put_contents($completePath, $content);
        $type = $type ?? "Model";
        $this->info("{$type} {$className} created successfully!");
    }

    private function generateTableName($className)
    {
        $tableName = "";
        // PERCORRE O NOME DA CLASSE PARA MONTAR NOME DA TABELA
        for ($i = 0; $i < strlen($className); $i++)
        {
            // VERIFICA SE LETRA É MAIUSCULA
            if (preg_match('/^[^a-z]*$/', $className[$i]))
            {
                if ($i > 0)
                {
                    $tableName .= trim("_".strtolower($className[$i]));
                }
                else
                {
                    $tableName .= trim(strtolower($className[$i]));
                }
            }
            else
            {
                $tableName .= trim(strtolower($className[$i]));
            }
        }
        return $tableName;
    }

}
