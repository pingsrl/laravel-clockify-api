<?php

namespace Ping\LaravelClockifyApi\Payloads;

use Ping\LaravelClockifyApi\Exceptions\InvalidPayloadException;

class Payload implements PayloadContract
{
    /**
     * Id of the resource.
     *
     * @var id
     */
    protected string $id = '';

    /**
     * List of available parameters.
     */
    protected array $parameters = [];

    /**
     * List of required parameters.
     */
    protected array  $required = [];

    /**
     * Data container.
     */
    protected array $data = [];

    public function __construct($id = '')
    {
        $this->id = $id;
    }

    public static function make($id = '')
    {
        return new static($id);
    }

    public function isValid(): bool
    {
        return count(\array_intersect(array_keys($this->data), $this->required)) == count($this->required);
    }

    public function validate(): static
    {
        if (!$this->isValid()) {
            throw new InvalidPayloadException();
        }

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getResourceEndpoint(): string
    {
        if ($this->id) {
            return '/'.$this->id;
        }

        return '';
    }

    public function __call($name, $arguments)
    {
        if (\method_exists($this, $name)) {
            return $this->$name(...$arguments);
        }

        $value = \array_shift($arguments);

        if (count($this->parameters)) {
            if (\in_array($name, $this->parameters)) {
                $this->data[$name] = $value;
            }

            return $this;
        }

        $this->data[$name] = $value;

        return $this;
    }
}
