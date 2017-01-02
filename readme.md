# SelectBox pro Nette Framework

## Použití
```php
protected function createComponentSelectBox() 
{
    $control = new NAttreid\SelectBox\SelectBox;
    $control->setTranslator($this->translator);
    $control->column = 'column';
    $control->name = 'columnName';
    $control->rows = [];
    return $control;
}

protected function createComponentForm()
{
    $form = new \NAttreid\Form\Form;
    $form->addHidden('column', $this->defaultValue);
    // dalsi php kod
    return $form;
}
```

a vložíme do latte
```php
{control selectBox, column => 'nazevPolozkyFormulare', name => 'nazev', rows => $data, $first => 'nazev'}
```