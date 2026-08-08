<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\OAuth2\Controller\TestAsset;

use Laminas\ApiTools\ApiProblem\Exception\ProblemExceptionInterface;
use Override;
use RuntimeException;
use Traversable;

class CustomProblemDetailsException extends RuntimeException implements ProblemExceptionInterface
{
    /** @var string */
    public $type;

    /** @var string */
    public $title;

    /** @var null|array|Traversable */
    public $details;

    /** @return string */
    #[Override]
    public function getType()
    {
        return $this->type;
    }

    /** @return string */
    #[Override]
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Traversable|array|null
     */
    #[Override]
    public function getAdditionalDetails()
    {
        return $this->details;
    }
}
