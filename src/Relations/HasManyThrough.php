<?php

namespace Vajexal\AttributeRelations\Relations;

use Attribute;
use Illuminate\Support\Str;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class HasManyThrough implements RelationAttribute
{
    private string $related;
    private string $through;
    private array  $arguments;

    /**
     * @no-named-arguments
     */
    public function __construct(string $related, string $through, array ...$arguments)
    {
        $this->related   = $related;
        $this->through   = $through;
        $this->arguments = [$related, $through, ...$arguments];
    }

    public function guessRelationName(): string
    {
        return Str::plural(mb_strtolower(class_basename($this->related)));
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
