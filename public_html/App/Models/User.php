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
        'password2'   => 'match:password',
        'bio'         => 'minlength:10'
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

    public function saveAvatar($filename)
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($filename);

        $extensions = [
            'image/jpg'  => '.jpg',
            'image/jpeg' => '.jpg',
            'image/png'  => '.png',
            'image/gif'  => '.gif'
        ];

        $extension = '.jpg';
        if (isset($extensions[$mime])) {
            $extension = $extensions[$mime];
        }

        $newFilename = uniqid() . $extension;

        $folder = "./images/avatars/originals"; // no trailing slash

        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $destination = $folder . "/" . $newFilename;

        move_uploaded_file($filename, $destination);

        $this->avatar = $newFilename;

        //240x300 80x100
        if (! is_dir("./images/avatars/300h")) {
            mkdir("./images/avatars/300h", 0777, true);
        }
        $img = Image::make($destination);
        $img->fit(240, 300);
        $img->save("./images/avatars/300h/" . $newFilename);

        if (! is_dir("./images/avatars/100h")) {
            mkdir("./images/avatars/100h", 0777, true);
        }
        $img = Image::make($destination);
        $img->fit(80, 100);
        $img->save("./images/avatars/100h/" . $newFilename);
    }
}
