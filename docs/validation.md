# Validation

## How It Works

Validation is implemented for all Eloquent models that implement the
`ValidatesAttributes` interface. To easily implement the validation logic, use
the trait of the same name. The validation can validate a model or an array of
the corresponding attributes.

## How to Use It

```php
<?php

# Create an invalid dimension (dimensions need strictly positive values)
$dimension = new Dimension(['length' => 0, 'width' => 1, 'height' => 4]);

Dimension::validate($dimension); # returns false
Dimension::validate(['length' => 0, 'width' => 1, 'height' => 4]); # returns false

$dimension->length = 3;

Dimension::validate($dimension); # returns true

# Save the dimension only if it is valid
if (Dimension::validate($dimension)) {
    $dimension->save();
}
```

## How to Implement It

```php
<?php

# Implement the `ValidatesAttributes` interface
class Dimension extends Model implements ValidatesAttributes
{
    # Use the trait to automatically implement the interface
    use ValidatesAttributes;

    # Define the validation rules
    # https://laravel.com/docs/validation#available-validation-rules
    const VALIDATION_ATTRIBUTES = [
        # ...
    ];
}
```
