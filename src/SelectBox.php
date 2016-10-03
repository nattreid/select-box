<?php

namespace NAttreid\SelectBox;

/**
 * SelectBox
 *
 * @author Attreid <attreid@gmail.com>
 */
class SelectBox extends \Nette\Application\UI\Control
{

	private $args = [];

	/**
	 * Nastavi sloupec ve formulari
	 * @param string $column
	 */
	public function setColumn($column)
	{
		$this->args['column'] = $column;
	}

	/**
	 * Nastavi nazev
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->args['name'] = $name;
	}

	/**
	 * Nastavi data do selectu
	 * @param array $rows
	 */
	public function setRows($rows)
	{
		$this->args['rows'] = $rows;
	}

	/**
	 * Nastavi prvni radek
	 * @param string $first
	 */
	public function setFirst($first)
	{
		$this->args['first'] = $first;
	}

	public function render($args = null)
	{
		$template = $this->template;
		$template->setFile(__DIR__ . '/selectBox.latte');

		foreach ($this->args as $name => $value) {
			$template->$name = $value;
		}
		if ($args !== null) {
			foreach ($args as $name => $value) {
				$template->$name = $value;
			}
		}

		$rows = $template->rows;
		if ($rows instanceof \Countable) {
			$template->count = $rows->count();
		} elseif ($rows instanceof \Traversable) {
			$template->count = iterator_count($rows);
		} elseif (is_array($rows)) {
			$template->count = count($rows);
		} else {
			throw new \InvalidArgumentException('Rows neni pocitatelne');
		}

		$template->render();
	}

}
