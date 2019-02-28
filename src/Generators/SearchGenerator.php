<?php
/**
 * Author: 赵振 <270281156@qq.com>
 * Date: 2019/2/15 下午3:32
 */

namespace InfyOm\Generator\Generators;

use InfyOm\Generator\Utils\FileUtil;
use InfyOm\Generator\Common\CommandData;

class SearchGenerator
{

    private $commandData;
    private $fileName;
    private $path;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
        $this->path = $commandData->config->pathSearch;
        $this->fileName = $this->commandData->modelName.'Search.php';
    }

    public function generate()
    {
        $templateData = get_template('search.search', 'laravel-generator');
        $templateData = $this->fillTemplate($templateData);
        FileUtil::createFile($this->path, $this->fileName, $templateData);

        $this->commandData->commandComment("\nSearch created: ");
        $this->commandData->commandInfo($this->fileName);

    }

    private function fillTemplate($templateData)
    {
        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        $fillables = [];
        foreach ($this->commandData->fields as $field) {
                $fillables[] = "'".$field->name."'";
        }

        $templateData = str_replace('$SEARCH$', implode(','.infy_nl_tab(1, 2), $fillables), $templateData);

        return $templateData;

    }


}