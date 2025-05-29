<?php

/**
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Markdown_XH.
 *
 * Markdown_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Markdown_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Markdown_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Markdown\Model;

use ArrayAccess;
use Countable;
use Iterator;
use Markdown\Model\Parsedown\Parsedown;

/**
 * @implements ArrayAccess<int,string>
 * @implements Iterator<int,string>
 */
class Contents implements Countable, ArrayAccess, Iterator
{
    /** @var array<int,string> */
    private array $c;
    private bool $editing;
    private Markdown $markdown;

    /** @param array<int,string> $c */
    public static function create(array $c, bool $editing): self
    {
        return new self($c, $editing, new Markdown(new Parsedown()));
    }

    /** @param array<int,string> $c */
    public function __construct(array $c, bool $editing, Markdown $markdown)
    {
        $this->c = $c;
        $this->editing = $editing;
        $this->markdown = $markdown;
    }

    public function count(): int
    {
        return count($this->c);
    }

    public function offsetExists($offset): bool
    {
        if (!is_int($offset)) {
            return false;
        }
        return array_key_exists($offset, $this->c);
    }

    public function offsetGet($offset): ?string
    {
        if (!is_int($offset)) {
            return null;
        }
        if (!array_key_exists($offset, $this->c)) {
            return null;
        }
        return $this->get($this->c[$offset]);
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset === null && is_string($value)) {
            $this->c[] = $value;
        } elseif (is_int($offset) && is_string($value)) {
            $this->c[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->c[$offset]);
    }

    public function current(): string
    {
        return $this->get((string) current($this->c));
    }

    public function key(): ?int
    {
        return key($this->c);
    }

    public function next(): void
    {
        next($this->c);
    }

    public function rewind(): void
    {
        reset($this->c);
    }

    public function valid(): bool
    {
        return key($this->c) !== null;
    }

    /** @param array<int,string> $replacement */
    public function splice(int $offset, int $length, array $replacement): void
    {
        array_splice($this->c, $offset, $length, $replacement);
    }

    private function get(string $contents): string
    {
        if ($this->editing) {
            return $contents;
        }
        return $this->markdown->toHtml((string) preg_replace('/<!--.*?-->/is', "", $contents));
    }
}
