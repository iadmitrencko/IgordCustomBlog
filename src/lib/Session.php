<?php

namespace Igord\CustomBlog\lib;

class Session
{
    // ########################################

    /**
     * Start session
     */
    public function start()
    {
        session_start();
    }

    /**
     * Destroy session
     */
    public function destroy()
    {
        session_destroy();
    }

    // ########################################

    /**
     * @param string $key
     * @param        $value
     *
     * @return $this
     */
    public function set(string $key, $value): self
    {
        $_SESSION[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            return true;
        }

        return false;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    /**
     * @param string $key
     */
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Clear session array
     */
    public function clear(): void
    {
        $_SESSION = [];
    }

    // ########################################
}