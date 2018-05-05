<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.05.2018
 * Time: 8:55
 */

namespace egor260890\feedback\entities;


interface FeedbackInterface
{

    function getName():string ;

    function getTel():string ;

    function getCompany_name():string ;

    function getEmail():string ;

    function getMessage():string ;

}