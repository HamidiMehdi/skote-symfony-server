<?php

namespace App\Service\OpenApi\Resources;

use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiTokenResource implements OpenApiResourcesInterface
{
    /**
     * @return string
     */
    public function getSection(): string
    {
        return 'Token';
    }

    public function createPaths(OpenApi $openApi): OpenApi
    {
        $openApi = $this->createRefreshTokenPath($openApi);
        return $openApi;
    }

    /**
     * @param OpenApi $openApi
     * @return OpenApi
     */
    private function createRefreshTokenPath(OpenApi $openApi): OpenApi
    {
        $openApi->getPaths()->addPath(
            path: '/api/refresh/token',
            pathItem: new PathItem(
                summary: 'Refresh Token',
                description: 'Refresh an JWT Token',
                post: new Operation(
                    operationId: 'refresh_token_id',
                    summary: 'Refresh an JWT Token',
                    parameters: [
                        'name' => 'refresh_token',
                        'in' => 'body',
                        'description' => 'Refresh token',
                        'required' => true,
                        'schema' => ['type' => 'string'],
                    ]
                )
            )
        );

        return $openApi;
    }
}
