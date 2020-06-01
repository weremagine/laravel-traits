# Laravel Traits
A collection of opinionated traits for Laravel, by **REMAGINE**.

`composer require weremagine/laravel-traits`

## HasCreator
`HasCreator` automatically adds the current authorised user's `id` to the `user_id` column on record creation of models that implement it.

### Usage
```php
use Remagine\Traits\HasCreator;

class Article extends Model
{
    use HasCreator;
```

## HasImages
`HasImages` automatically appends images on retrieval of models that implement it.

`imagesArray` function ***_required_**
A multidimensional array containing:
- `attribute`: the attribute name to append to the model.
- `field`: the model field that contains the image path.

`imagePrefix` function _(optional)_
The string to prefix all appended attributes with. If omitted, the field specified will be returned as it is stored.

### Usage
```php
use Remagine\Traits\HasImages;

class Article extends Model
{
    use HasImages;
    
    /**
     * Images to append to the model via HasImages.
     *
     * @return array
     */
    public function imagesArray()
    {
        return [
            [
                'attribute' => 'image_url',
                'field' => 'image',
            ],
        ];
    }
    
    /**
     * The string to prefix image attributes with.
     *
     * @returns string
     */
    public function imagePrefix()
    {
        return env('AWS_CDN').'/';
    }
```

## HasSlug
`HasSlug` automatically sets a slug when saving (creating or updating) any models that implement it.

`$sluggify` property _(optional)_
The field name to use when creating the slug - defaults to `name`.

### Usage
```php
use Remagine\Traits\HasSlug;

class Article extends Model
{
    use HasSlug;
    
    /**
     * The attribute to sluggify when saving.
     *
     * @var string
     */
    protected $sluggify = 'title';
```

## UserAgent
`UserAgent` automatically adds the `user-agent` header specified in the request to an `agent` field when new records of a model are stored.

### Usage
```php
use Remagine\Traits\UserAgent;

class Article extends Model
{
    use UserAgent;
```
