<?php

declare(strict_types=1);

namespace NAttreid\SelectBox;

use InvalidArgumentException;
use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;

/**
 * SelectBox
 *
 * @property-write string $column
 * @property-write string $name
 * @property-write array $rows
 * @property-write string $first
 *
 * @author Attreid <attreid@gmail.com>
 */
class SelectBox extends Control
{
	/** @var ITranslator */
	private $translator;

	private $args = [];

	/**
	 * Nastavi translator
	 * @param ITranslator $translator
	 */
	public function setTranslator(?ITranslator $translator)
	{
		$this->translator = $translator;
	}

	/**
	 * Nastavi zobrazovani nabidky na slide
	 */
	public function setSlideToggle(): void
	{
		$this->template->toggle = 'slide';
	}

	/**
	 * Nastavi zobrazovani nabidky na fade
	 */
	public function setFadeToggle(): void
	{
		$this->template->toggle = 'fade';
	}

	/**
	 * Nastavi sloupec ve formulari
	 * @param string $column
	 */
	protected function setColumn(string $column): void
	{
		$this->args['column'] = $column;
	}

	/**
	 * Nastavi nazev
	 * @param string $name
	 */
	protected function setName(string $name): void
	{
		if ($this->translator !== null) {
			$name = $this->translator->translate($name);
		}
		$this->args['name'] = $name;
	}

	/**
	 * Nastavi data do selectu
	 * @param array $rows
	 */
	protected function setRows($rows): void
	{
		$this->args['rows'] = $rows;
	}

	/**
	 * Nastavi prvni radek
	 * @param string $first
	 */
	protected function setFirst(string $first): void
	{
		if ($this->translator !== null) {
			$first = $this->translator->translate($first);
		}
		$this->args['first'] = $first;
	}

	public function render(...$args): void
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/selectBox.latte');

		foreach ($this->args as $name => $value) {
			$template->$name = $value;
		}
		foreach ($args as $name => $value) {
			$template->$name = $value;
		}

		$rows = $template->rows;
		if ($rows instanceof \Countable) {
			$template->count = $rows->count();
		} elseif ($rows instanceof \Traversable) {
			$template->count = iterator_count($rows);
		} elseif (is_array($rows)) {
			$template->count = count($rows);
		} else {
			throw new InvalidArgumentException('Rows is not countable');
		}

		$template->render();
	}

}
