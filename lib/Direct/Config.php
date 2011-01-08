<?php

namespace Direct;
/**
 * Config class that handle framework and application configs.
 *
 * @author Otavio Fernandes <otavio@neton.com.br>
 */
class Config
{
    /**
     * Error message to throw in config file not found Exception.
     * 
     * @var string
     */
    private static $fileFaultMsg = 'Config file "%s" not exists';

    /**
     * Error message to throw in config not found Exception.
     *
     * @var string
     */
    private static $configFaultMsg = 'Configuration "%s" not exists';

    /**
     * Array of configurations.
     * 
     * @var array
     */
    private static $config = array();

    /**
     * Load the configuratios in config file.
     *
     * Example usage:
     *   Config::load('level1','level2','level3');
     * 
     * @param string $env
     */
    public static function load()
    {
        $args = func_get_args();

        foreach ($args as $env)
        {
            if (file_exists(CONFIG_PATH.'/'.$env.'.yml'))
            {
                self::$config = self::merge(self::$config, \sfYaml::load(CONFIG_PATH.'/'.$env.'.yml'));
            }
            else
            {
                throw new \Exception(\sprintf(self::$fileFaultMsg,$env.'.yml'));
            }            
        }
    }

    /**
     * Return a value of config by you full qualified key.
     * 
     * Example usage:
     *   Config::get('app.enviroment.debug');
     *
     * @param string $key
     * 
     * @return mixed
     */
    static public function get($key)
    {
        $levels = explode('.',$key);
        $config = self::$config;
        $size = count($levels);

        for ($i = 0; $i < $size; $i++)
        {
            if (isset($config[$levels[$i]]))
            {
                $config = $config[$levels[$i]];

                if ($i == ($size-1))
                {
                    return $config;
                }
            }
            else
            {
                throw new \Exception(sprintf(self::$configFaultMsg,$key));
            }
        }
    }

    public static function merge()
    {
         $arrays = func_get_args();
          $base = array_shift($arrays);
          if(!is_array($base)) $base = empty($base) ? array() : array($base);
          foreach($arrays as $append) {
            if(!is_array($append)) $append = array($append);
            foreach($append as $key => $value) {
              if(!array_key_exists($key, $base) and !is_numeric($key)) {
                $base[$key] = $append[$key];
                continue;
              }
              if(is_array($value) or is_array($base[$key])) {
                $base[$key] = self::merge($base[$key], $append[$key]);
              } else if(is_numeric($key)) {
                if(!in_array($value, $base)) $base[] = $value;
              } else {
                $base[$key] = $value;
              }
            }
          }
          return $base;
    }
    /**
     * Return all configurations loaded.
     *
     * @return array
     */
    static public function all()
    {
        return self::$config;
    }
}
