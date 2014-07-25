<?php
namespace Codeception\Module;

use \Codeception\Util\Fixtures;

/**
 * 
 *
 * @version Release: 0.1.0
 * @since   
 * @package _support\helpers
 * @author  Fike Etki <etki@etki.name>
 */
class BootstrapHelper
{
    public function bootstrap()
    {
        $this->prepareDatabase();
        $this->loadRuntimeFixtures();
    }
    public function loadRuntimeFixtures()
    {
        $serverName = false;
        if (isset($_SERVER['SERVER_NAME'])) {
            $serverName = $_SERVER['SERVER_NAME'];
        }
        $maps = array(
            'users' => array(
                'username' => 'login',
                'rawPassword' => 'password',
            ),
            'posts' => array(
                'name' => 'title',
                'user_id' => 'author',
                'category_id' => 'category',
            ),
            'categories' => array('name' => 'title',),
        );
        $dbFixtures = \Yii::app()->fixtureManager->getFixtures();
        foreach ($maps as $fixture => $map) {
            $data = require $dbFixtures[$fixture];
            $index = 0;
            $keyBase = "data:$fixture";
            foreach ($data as $item) {
                Fixtures::add($keyBase, $item);
                foreach ($item as $field => $value) {
                    if (isset($map[$field])) {
                        $key = $keyBase . "[$index]:" . $map[$field];
                    } else {
                        $key = $keyBase . "[$index]:" . $field;
                    }
                    Fixtures::add($key, $value);
                }
                $index++;
            }
            Fixtures::add($keyBase.':length', $index);
        }

        Fixtures::add('data:random:int', mt_rand(0, PHP_INT_MAX));
        Fixtures::add('data:random:string', md5(Fixtures::get('data:random:int')));

        Fixtures::add('defaults:app:language', \Yii::app()->language);
        Fixtures::add('defaults:app:name', \Yii::app()->name);
        Fixtures::add('defaults:app:theme', \Yii::app()->theme->name);
        Fixtures::add('defaults:server:host', $serverName);
    }
    public function prepareDatabase()
    {
        if (\Yii::app()->db->getDriverName() === 'sqlite') {
            $dsn = \Yii::app()->db->connectionString;
            $path = str_replace('sqlite:', '', $dsn);
            if (is_writable($path)) {
                unlink($path);
            }
            if (!file_exists($path)) {
                touch($path);
            }
        }
        $helper = new MigrationHelper;
        $helper->applyMigrations();
        \Yii::app()->fixtureManager->prepare();
    }
}
 