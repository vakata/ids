<?php

namespace vakata\ids;

use vakata\http\Request;

class IDS
{
    protected $rules;
    protected $violations;

    /**
     * Create an instance from a rule file. Rule files follow the Expose / PHPIDS format
     * @method fromFile
     * @param  string   $path the path to the file to load
     * @return \vakata\ids\IDS         the new instance
     */
    public static function fromFile(string $path) : IDS
    {
        $rules = json_decode(file_get_contents($path), true);
        if (isset($rules['filters'])) {
            $rules = $rules['filters'];
        }
        $rules = array_map(function ($v) {
            if (isset($v['tags']) && isset($v['tags']['tag'])) {
                $v['tags'] = $v['tags']['tag'];
            }
            return $v;
        }, $rules);
        return new static($rules);
    }
    /**
     * Creates an instance from the default rule file that comes with the lib.
     * @method fromDefaults
     * @return \vakata\ids\IDS       the new instance
     */
    public static function fromDefaults() : IDS
    {
        return static::fromFile(__DIR__ . '/filter_rules.json');
    }
    /**
     * Create an instance.
     * Each rule is and array and must contain `rule` and `impact` keys, and may contain `tags` and `description` keys
     * @method __construct
     * @param  array       $rules array or rule arrays
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }
    /**
     * Analyze an incoming request
     * @method analyzeRequest
     * @param  \vakata\http\Request        $req       the request to analyze
     * @param  int|null       $threshold if non-null analysis will stop once this impact number is reached
     * @param  array|null     $tags      if non-null only rules containing any of the supplied tags will be run
     * @return int                    the total impact of the request
     */
    public function analyzeRequest(Request $req, int $threshold = null, array $tags = null) : int
    {
        $this->violations = [];
        return $this->run([
            'get' => $req->getQuery(),
            'post' => $req->getPost()
        ], $threshold, $tags);
    }
    /**
     * Analyze an array of data
     * @method analyzeData
     * @param  array        $data       the data to analyze
     * @param  int|null       $threshold if non-null analysis will stop once this impact number is reached
     * @param  array|null     $tags      if non-null only rules containing any of the supplied tags will be run
     * @return int                    the total impact of the data
     */
    public function analyzeData(array $data, int $threshold = null, array $tags = null) : int
    {
        $this->violations = [];
        return $this->run($data, $threshold, $tags);
    }
    /**
     * Get the violations from the last analyze call
     * @method getViolations
     * @return array the violated rules and the values that violated them
     */
    public function getViolations() : array
    {
        return $this->violations;
    }
    protected function run(array $data, int $threshold = null, array $tags = null)
    {
        $impact = 0;
        foreach ($data as $k => $v)
        {
            if (is_array($v)) {
                $impact += $this->run($v, $threshold !== null ? $threshold - $impact : null);
                if ($threshold !== null && $impact >= $threshold) {
                    return $impact;
                }
            } else {
                foreach ($this->rules as $rule) {
                    if ($tags !== null &&
                        (
                            !isset($rule['tags']) ||
                            !is_array($rule['tags']) ||
                            !count(array_intersect($tags, $rule['tags']))
                        )
                    ) {
                        continue;
                    }
                    if (preg_match('/' . $rule['rule'] . '/im', $v)) {
                        $impact += (int)$rule['impact'];
                        $this->violations[] = [
                            'rule' => $rule,
                            'value' => $v
                        ];
                        if ($threshold !== null && $impact >= $threshold) {
                            return $impact;
                        }
                    }
                }
            }
        }
        return $impact;
    }
}
