# vakata\ids\IDS  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#ids__construct)|Create an instance.|
|[analyzeData](#idsanalyzedata)|Analyze an array of data|
|[fromDefaults](#idsfromdefaults)|Creates an instance from the default rule file that comes with the lib.|
|[fromFile](#idsfromfile)|Create an instance from a rule file. Rule files follow the Expose / PHPIDS format|
|[getViolations](#idsgetviolations)|Get the violations from the last analyze call|




### IDS::__construct  

**Description**

```php
public __construct (array $rules)
```

Create an instance. 

Each rule is and array and must contain `rule` and `impact` keys, and may contain `tags` and `description` keys 

**Parameters**

* `(array) $rules`
: array or rule arrays  

**Return Values**




### IDS::analyzeData  

**Description**

```php
public analyzeData (array $data, int|null $threshold, array|null $tags)
```

Analyze an array of data 

 

**Parameters**

* `(array) $data`
: the data to analyze  
* `(int|null) $threshold`
: if non-null analysis will stop once this impact number is reached  
* `(array|null) $tags`
: if non-null only rules containing any of the supplied tags will be run  

**Return Values**

`int`

> the total impact of the data  




### IDS::fromDefaults  

**Description**

```php
public static fromDefaults (void)
```

Creates an instance from the default rule file that comes with the lib. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\vakata\ids\IDS`

> the new instance  




### IDS::fromFile  

**Description**

```php
public static fromFile (string $path)
```

Create an instance from a rule file. Rule files follow the Expose / PHPIDS format 

 

**Parameters**

* `(string) $path`
: the path to the file to load  

**Return Values**

`self`

> the new instance  




### IDS::getViolations  

**Description**

```php
public getViolations (void)
```

Get the violations from the last analyze call 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`

> the violated rules and the values that violated them  



