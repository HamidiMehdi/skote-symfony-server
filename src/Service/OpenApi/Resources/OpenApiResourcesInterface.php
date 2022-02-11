<?php

namespace App\Service\OpenApi\Resources;

use ApiPlatform\Core\OpenApi\OpenApi;

interface OpenApiResourcesInterface
{
    /**
     * @param OpenApi $openApi
     * @return OpenApi
     */
    public function createPaths(OpenApi $openApi): OpenApi;

    /**
     * @return string
     */
    public function getSection(): string;
}
