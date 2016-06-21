# SelectBox pro Nette Framework

## Použití
Vytvoříme potomka třídy *App/Components/Dialog*
```php
protected function createComponentSelectBox() {
    $control = new NAttreid\SelectBox\SelectBox;
    return $control;
}
```

a vložíme do latte
```php
{control selectBox, column => 'nazevPolozkyFormulare', name => 'nazev(preklada se)', rows => $data, $first => 'nazev(preklada se)'}
```