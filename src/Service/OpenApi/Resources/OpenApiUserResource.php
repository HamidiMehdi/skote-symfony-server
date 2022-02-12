<?php

namespace App\Service\OpenApi\Resources;

use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiUserResource implements OpenApiResourcesInterface
{
    /**
     * @return string
     */
    public function getSection(): string
    {
        return 'User';
    }

    public function createPaths(OpenApi $openApi): OpenApi
    {
        return $this->createMePath($openApi);
    }

    /**
     * @param OpenApi $openApi
     * @return OpenApi
     */
    private function createMePath(OpenApi $openApi): OpenApi
    {
        $pathItem = new PathItem(
            summary: 'Retrieve a User resource by JWT Token',
            description: 'Retrieve a User resource by JWT Token',
            get: new Operation(
                operationId: 'apiGetMe',
                tags: [$this->getSection()],
                responses: [
                    '200' => [
                        'description' => 'The User resource',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User-user.read'
                                ]
                            ]
                        ],
                    ]
                ],
                summary: 'Retrieve a User resource by JWT Token',
                description: 'Retrieve a User resource by JWT Token'
            )
        );

        $openApi->getPaths()->addPath('/api/me', $pathItem);
        return $openApi;
    }
}
