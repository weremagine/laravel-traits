# Laravel Traits
A collection of opinionated traits for Laravel, by **REMAGINE**.

`composer require weremagine/laravel-traits`

## TOC
- [HasCreator](#HasCreator)
- [HasImages](#HasImages)
- [HasOne](#HasOne)
- [HasSlug](#HasSlug)
- [HasUniqueKey](#HasUniqueKey)
- [HasUuid](#HasUuid)
- [UserAgent](#UserAgent)

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

## HasOne
`HasOne` automatically adds a differing related model relationship, where 

`$has_one_attribute` property _(optional)_
The name to use when setting the relationship, defaults to `model`.

`$has_one_type` property _(optional)_
The name of the field that contains the path to related model class, such as the value `App\Models\Menu` - defaults to `model_type`.

`$has_one_id` property _(optional)_
The name of the field that contains the related model's id - defaults to `model_id`.

### Usage
```php
use Remagine\Traits\HasOne;

class QrCode extends Model
{
    use HasOne;
    
    /**
     * The name to give the relationship via the HasOne trait.
     *
     * @var string
     */
    protected $has_one_attribute = 'model';

    /**
     * The name of the field to lookup the HasOne model.
     *
     * @var string
     */
    protected $has_one_type = 'model_type';

    /**
     * The name of the field containing the HasOne model's id.
     *
     * @var string
     */
    protected $has_one_id = 'model_id';
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

## HasUniqueKey
`HasUniqueKey` automatically sets a unique key when creating records for models that implement it.

`$unique_key` property _(optional)_
The field name to use when creating the unique key - defaults to `key`.

`$unique_key_length` property _(optional)_
The length you wish for the unique key to be - defaults to `10`.

`$uppercase_key` property _(optional)_
A boolean to indicate if keys should be in uppercase - defaults to `false`.

`$key_prefix` property _(optional)_
The prefix for the unique key. - defaults to `null`.

`$key_suffix` property _(optional)_
The suffix for the unique key. - defaults to `null`.

### Usage
```php
use Remagine\Traits\HasUniqueKey;

class Article extends Model
{
    use HasUniqueKey;
    
    /**
     * The name of the unique key for the model.
     */
    protected $unique_key = 'key';

    /**
     * The length unique keys generated should be.
     */
    protected $unique_key_length = 10;

    /**
     * Indicates if the key should be uppercased.
     */
    protected $uppercase_key = false;

    /**
     * The prefix for the unique key.
     */
    protected $key_prefix = null;

    /**
     * The suffix for the unique key.
     */
    protected $key_suffix = null;
```

## HasUuid
`HasUuid` automatically sets a uuid when creating records for models that implement it.

`$uuid_field` property _(optional)_
The field name to use when creating the uuid - defaults to `uuid`.

### Usage
```php
use Remagine\Traits\HasUuid;

class Article extends Model
{
    use HasUuid;
    
    /**
     * The name of the field to store uuids.
     */
    protected $uuid_field = 'uuid';
```

### Methods

`byUuid`
Retrieves a record using it's UUID.
```php
Article::byUuid($uuid);
```

## UserAgent
`UserAgent` automatically adds the `user-agent` header specified in the request to an `agent` field when new records of a model are stored.

`$parse_agent_fields` property _(optional)_
A boolean to indicate whether or not to parse the agent string and store on creation - defaults to `false`.

The following fields (nullable strings) are stored:
- platform
- platform_version
- browser
- browser_version
- device
- device_name

### Usage
```php
use Remagine\Traits\UserAgent;

class Article extends Model
{
    use UserAgent;

    /**
     * Indicates if the agent should be parsed when saving.
     *
     * @var array
     */
    protected $parse_agent_fields = false;
```
