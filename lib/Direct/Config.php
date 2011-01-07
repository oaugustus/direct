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
     * Config file. 
     * 
     * @var string.
     */
    private static $configFile = 'config.yml';

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
     */
    public static function initialize()
    {
        if (file_exists(CONFIG_PATH.'/'.self::$configFile))
        {
            self::$config = \sfYaml::load(CONFIG_PATH.'/'.self::$configFile);
        }
        else
        {
            throw new \Exception(\sprintf(self::$fileFaultMsg,self::$configFile));
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
}
