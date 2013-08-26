<?php

class LayoutTwigLoader implements Twig_LoaderInterface, Twig_ExistsLoaderInterface
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = DB::connection()->getPdo();
    }

    //required
    public function getSource($name)
    {
        if (false === $source = $this->getValue('content', $name)) {
            throw new Twig_Error_Loader(sprintf('Template "%s" does not exist.', $name));
        }

        return $source;
    }

    // Twig_ExistsLoaderInterface as of Twig 1.11
    public function exists($name)
    {
        return $name === $this->getValue('name', $name);
    }

    //required
    public function getCacheKey($name)
    {
        return $name;
    }

    //required
    public function isFresh($name, $time)
    {
        if (false === $lastModified = $this->getValue('updated_at', $name)) {
            return false;
        }

        return $lastModified <= $time;
    }

    protected function getValue($column, $name)
    {
        $sth = $this->dbh->prepare('SELECT '.$column.' FROM layouts WHERE name = :name');
        $sth->execute(array(':name' => (string) $name));

        return $sth->fetchColumn();
    }
}
