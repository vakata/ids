<?php

namespace vakata\ids;

class IDS
{
    protected $rules;
    protected $violations;

    /**
     * Create an instance from a rule file. Rule files follow the Expose / PHPIDS format
     * @param  string   $path the path to the file to load
     * @return self         the new instance
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
        return new self($rules);
    }
    /**
     * Creates an instance from the default rule file that comes with the lib.
     * @return \vakata\ids\IDS       the new instance
     */
    public static function fromDefaults() : IDS
    {
        return static::fromFile(__DIR__ . '/filter_rules.json');
    }
    /**
     * Create an instance.
     * Each rule is and array and must contain `rule` and `impact` keys, and may contain `tags` and `description` keys
     * @param  array       $rules array or rule arrays
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }
    /**
     * Analyze an array of data
     * @param  array        $data       the data to analyze
     * @param  int|null       $threshold if non-null analysis will stop once this impact number is reached
     * @param  array|null     $tags      if non-null only rules containing any of the supplied tags will be run
     * @return int                    the total impact of the data
     */
    public function analyzeData(array $data, ?int $threshold = null, ?array $tags = null) : int
    {
        $this->violations = [];
        return $this->run($data, $threshold, $tags);
    }
    /**
     * Get the violations from the last analyze call
     * @return array the violated rules and the values that violated them
     */
    public function getViolations() : array
    {
        return $this->violations;
    }
    protected function run(array $data, ?int $threshold = null, ?array $tags = null)
    {
        $impact = 0;
        foreach ($data as $v) {
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
                    if ($v && preg_match('/' . $rule['rule'] . '/im', $v)) {
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
