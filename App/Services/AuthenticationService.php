<?php

namespace App\Services;

use App\Models\User;
use App\Models\Exceptions\ModelNotFoundException;
use App\Services\Exceptions\InsufficientPrivilegesException;

class AuthenticationService
{

   private static $currentUser;

   public function __construct()
   {
       if (!isset($_SESSION['AuthenticationService'])) {
           $this->resetSession();
       }
       if (isset($_SESSION['AuthenticationService']['currentUser'])) {
           try {
               // does user still exist in database?
               static::$currentUser = User::findBy('email', $_SESSION['AuthenticationService']['currentUser']->email);
           } catch (ModelNotFoundException $e) {
               // user is gone, reset session
               $this->resetSession();
           }
       }
   }

   protected function resetSession()
   {
       $_SESSION['AuthenticationService'] = [
           'currentUser' => null,
       ];
   }

   public function attempt($email, $password)
   {
       // get user with matching email
       try {
           $user = User::findBy('email', $email);
       } catch (ModelNotFoundException $e) {
           return false;
       }

       // compare passwords
       if ($this->comparePasswords($password, $user)) {
           $this->loginUser($user);

           return true;
       }

       return false;
   }

   public function check()
   {
       return (static::$currentUser ? true : false);
   }

   private function comparePasswords($password, User $user)
   {
       if (password_verify($password, $user->password)) {
           if (password_needs_rehash($user->password, PASSWORD_DEFAULT)) {
               $user->password = password_hash($password, PASSWORD_DEFAULT);
               $user->store();
           }

           return true;
       }

       return false;
   }

   public function loginUser(User $user)
   {
       $_SESSION['AuthenticationService']['currentUser'] = $user;
       static::$currentUser = $user;
   }

   public function logout()
   {
       unset($_SESSION['AuthenticationService']);
       static::$currentUser = null;
   }

   public function user()
   {
       return static::$currentUser;
   }

   public function hasRole($role)
   {
       if ($this->isAdmin()) {
           return true;
       }

       return static::$currentUser->role === $role;
   }

   public function isAdmin()
   {
        if (! static::$currentUser) {
            return false;
        }
        return static::$currentUser->role === 'admin';
   }

   public function mustBeAdmin()
   {
       if(! $this->isAdmin()) {
        throw new InsufficientPrivilegesException();
       }
   }

}
