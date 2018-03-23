<?php
//https://www.youtube.com/watch?v=rGGbpG_cSLU&list=PLnBvgoOXZNCP2LEKmvu2W-eUkO-DYn0TL&index=47
// 49
/**

Model = singular
Controller = plural

Migration - joining table should always start alphbatic. eg. role_tak, eg. comment_task

php artisan make:controller CompaniesController --resource --model=Models\Company


*/
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
