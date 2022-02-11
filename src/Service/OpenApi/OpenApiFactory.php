<?php

namespace App\Service\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use App\Service\OpenApi\Resources\OpenApiResourcesInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(
        private iterable                $resources,
        private OpenApiFactoryInterface $decorated,
    )
    {
    }

    /**
     * @param array $context
     * @return OpenApi
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        /** @var OpenApiResourcesInterface $resource */
        foreach ($this->resources as $resource) {
            $openApi = $resource->createPaths($openApi);
        }

        return $openApi;
    }
}
