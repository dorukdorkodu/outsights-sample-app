<?php

  namespace Outsights\Outpost;

  /**
   * Cookie controller class for Outpost ecosystem.
   */
  class Cookie
  {
    /**
     * Gets the cookie.
     *
     * @param string $name
     *
     * @return string value of the cookie
     **/
    public static function get(string $name)
    {
      if (!empty($name) && isset($_COOKIE[$name])) {
        return $_COOKIE[$name];
      } else {
        return null;
      }
    }

    /**
     * Creates a new cookie value object.
     *
     * @param string $name Name of the cookie.
     * @param string $value Value that cookie will store.
     * @param string $expiresAt Time in seconds that the cookie will be expired at.
     * @param string $path
     * @param string $domain description.
     * @param boolean $httpOnly description.
     *
     * @return true on success
     * @return false on failure
     **/
    public static function bake(string $name, string $value = "", int $expiresAt = 0, string $path = "/", string $domain = "", bool $secure = false, bool $httpOnly = false)
    {
      $newCookie = new OutpostCookie($name, $value, $expiresAt, $path, $domain, $secure, $httpOnly);
      return $newCookie;
    }

    /**
     * Creates a new cookie value object.
     *
     * @param string $name Name of the cookie.
     * @param string $value Value that cookie will store.
     * @param string $expiresAt Time in seconds that the cookie will be expired at.
     * @param string $path
     * @param string $domain description.
     * @param boolean $httpOnly description.
     *
     * @return true on success
     * @return false on failure
     **/
    public static function set(OutpostCookie $cookie)
    {
      return setcookie($cookie->getName(), $cookie->getValue(), $cookie->getExpireTimestamp(), $cookie->getPath(), $cookie->getDomain(), $cookie->isSecureOnly(), $cookie->isHTTPOnly());
    }

    /**
     * Expires a cookie
     * 
     * @param string $name Name of the cookie that you want to be expired.
     *
     **/
    public static function expire(string $name)
    {
      setcookie($name, "", time() - 1);
      unset($_COOKIE[$name]);
    }

    /**
     * Returns whether a cookie exists.
     *
     * @param string $name Name of the cookie.
     *
     * @return true on success
     * @return false on failure
     * 
     **/
    public static function exists($name)
    {
      if (isset($_COOKIE[$name])) {
        return true;
      } else return false;
    }
  }
  