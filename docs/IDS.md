# vakata\ids\IDS


## Methods

| Name | Description |
|------|-------------|
|[fromFile](#vakata\ids\idsfromfile)|Create an instance from a rule file. Rule files follow the Expose / PHPIDS format|
|[fromDefaults](#vakata\ids\idsfromdefaults)|Creates an instance from the default rule file that comes with the lib.|
|[__construct](#vakata\ids\ids__construct)|Create an instance.|
|[analyzeRequest](#vakata\ids\idsanalyzerequest)|Analyze an incoming request|
|[analyzeData](#vakata\ids\idsanalyzedata)|Analyze an array of data|
|[getViolations](#vakata\ids\idsgetviolations)|Get the violations from the last analyze call|

---



### vakata\ids\IDS::fromFile
Create an instance from a rule file. Rule files follow the Expose / PHPIDS format  


```php
public static function fromFile (  
    string $path  
) : \vakata\ids\IDS    
```

|  | Type | Description |
|-----|-----|-----|
| `$path` | `string` | the path to the file to load |
|  |  |  |
| `return` | [`\vakata\ids\IDS`](IDS.md) | the new instance |

---


### vakata\ids\IDS::fromDefaults
Creates an instance from the default rule file that comes with the lib.  


```php
public static function fromDefaults () : \vakata\ids\IDS    
```

|  | Type | Description |
|-----|-----|-----|
|  |  |  |
| `return` | [`\vakata\ids\IDS`](IDS.md) | the new instance |

---


### vakata\ids\IDS::__construct
Create an instance.  
Each rule is and array and must contain `rule` and `impact` keys, and may contain `tags` and `description` keys

```php
public function __construct (  
    array $rules  
)   
```

|  | Type | Description |
|-----|-----|-----|
| `$rules` | `array` | array or rule arrays |

---


### vakata\ids\IDS::analyzeRequest
Analyze an incoming request  


```php
public function analyzeRequest (  
    \vakata\http\Request $req,  
    int|null $threshold,  
    array|null $tags  
) : int    
```

|  | Type | Description |
|-----|-----|-----|
| `$req` | `\vakata\http\Request` | the request to analyze |
| `$threshold` | `int`, `null` | if non-null analysis will stop once this impact number is reached |
| `$tags` | `array`, `null` | if non-null only rules containing any of the supplied tags will be run |
|  |  |  |
| `return` | `int` | the total impact of the request |

---


### vakata\ids\IDS::analyzeData
Analyze an array of data  


```php
public function analyzeData (  
    array $data,  
    int|null $threshold,  
    array|null $tags  
) : int    
```

|  | Type | Description |
|-----|-----|-----|
| `$data` | `array` | the data to analyze |
| `$threshold` | `int`, `null` | if non-null analysis will stop once this impact number is reached |
| `$tags` | `array`, `null` | if non-null only rules containing any of the supplied tags will be run |
|  |  |  |
| `return` | `int` | the total impact of the data |

---


### vakata\ids\IDS::getViolations
Get the violations from the last analyze call  


```php
public function getViolations () : array    
```

|  | Type | Description |
|-----|-----|-----|
|  |  |  |
| `return` | `array` | the violated rules and the values that violated them |

---

