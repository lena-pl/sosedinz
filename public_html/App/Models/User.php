<?php

namespace App\Models;

class User extends DatabaseModel
{

    protected static $columns = ['id', 'username', 'email', 'password', 'bio', 'avatar', 'role'];

    protected static $fakeColumns = ['password2'];

    protected static $tableName = "users";

    protected static $validationRules = [
        'username'    => 'minlength:1',
        'email'       => 'email,unique:App\Models\User',
        'password'    => 'minlength:6',
        'password2'   => 'match:password'
    ];

    function __construct($input = null)
    {
        parent::__construct($input);

        if($this->role === null) {
            $this->role = 'user';
        }
    }

    public function comments()
    {
        return Comment::allBy($user->id);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function gravatar($s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $this->email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}
