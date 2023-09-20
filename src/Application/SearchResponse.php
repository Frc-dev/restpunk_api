<?php

namespace App\Application;

use App\Domain\Bus\Query\Response;

class SearchResponse implements Response
{
    private int $id;
    private string $name;
    private string $tagline;
    private string $firstBrewed;
    private string $description;
    private string $image;

    public function toArray(): array
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'tagline' => $this->tagline,
          'firstBrewed' => $this->firstBrewed,
          'description' => $this->description,
          'image' => $this->image,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): self
    {
        $this->tagline = $tagline;

        return $this;
    }

    public function getFirstBrewed(): string
    {
        return $this->firstBrewed;
    }

    public function setFirstBrewed(string $first_brewed): self
    {
        $this->firstBrewed = $first_brewed;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
