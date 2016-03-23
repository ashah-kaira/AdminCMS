<?php
namespace DataProviders;
 
use Illuminate\Support\ServiceProvider;
 
class BaseServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $app = $this->app;
	$app->bind('DataProviders\IUserDataProvider','DataProviders\UserDataProvider');
    $app->bind('DataProviders\ISecurityDataProvider','DataProviders\SecurityDataProvider');

  }
 
}