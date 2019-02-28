<?php
/**
 * Author: 赵振 <270281156@qq.com>
 * Date: 2019/2/13 下午5:33
 */

namespace InfyOm\Generator\Generators\API;


use InfyOm\Generator\Common\CommandData;
use InfyOm\Generator\Generators\BaseGenerator;
use InfyOm\Generator\Utils\FileUtil;

class APIResourceGenerator extends BaseGenerator
{
    /** @var CommandData */
    private $commandData;

    /** @var string */
    private $path;

    /** @var string */
    private $resourceContents;

    /** @var string */
    private $resourceFileName;

    /** @var string */
    private $resourceCollectionFileName;


    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
        $this->path = $commandData->config->pathApiResource;

        $this->resourceFileName = $this->commandData->modelName.'Resource.php';
        $this->resourceCollectionFileName = $this->commandData->modelName.'ResourceCollection.php';
    }

    public function generate()
    {
        $this->generateResource();
        $this->generateResourceCollection();

    }

    public function generateResource()
    {
        $templateData = get_template('api.resource.resource', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);
        $templateData = str_replace('$RESOURCE$', implode(','.infy_nl_tab(1, 2), $this->generateResourceData()), $templateData);


        FileUtil::createFile($this->path, $this->resourceFileName, $templateData);

        $this->commandData->commandComment("\nCreate api resource created: ");
        $this->commandData->commandInfo($this->resourceFileName);
    }
    public function generateResourceCollection()
    {
        $templateData = get_template('api.resource.resource_collection', 'laravel-generator');

        $templateData = fill_template($this->commandData->dynamicVars, $templateData);

        FileUtil::createFile($this->path, $this->resourceCollectionFileName, $templateData);

        $this->commandData->commandComment("\nCreate api resource_collection created: ");
        $this->commandData->commandInfo($this->resourceCollectionFileName);
    }


    private function generateResourceData()
    {
        $resources = [];

        foreach ($this->commandData->fields as $field) {
            if($field->name == 'created_at' || $field->name == 'updated_at'||$field->name == 'deleted_at'){

                $resource = "'".$field->name."' =>"."$"."this->".$field->name.'->format("Y-m-d H:i:s")'."?? null";

            }else{
                $resource = "'".$field->name."' =>"."$"."this->".$field->name."?? null";
            }
            $resources[] = $resource;
        }

        return $resources;
    }


}