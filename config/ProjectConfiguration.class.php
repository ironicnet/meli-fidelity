<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->setPlugins(array(
      'sfDoctrinePlugin',
      'sfDoctrineGuardPlugin',
      'sfWebBrowserPlugin',
      'sfImageCachePlugin',
      'sfThumbnailPlugin',
      'tmcTwitterBootstrapPlugin',
      'sfFormExtraPlugin',
      'sfTaskExtraPlugin',
    ));

    $this->dispatcher->connect('command.post_command', array($this, 'postCommand'));
    
    sfValidatorBase::setDefaultMessage("required", "This field is required");
    sfValidatorBase::setDefaultMessage("invalid", "The value entered is invalid");
  }

  public function postCommand(sfEvent $event)
  {
    $task = $event->getSubject();
    if ($task instanceof sfGenerateAppTask)
    {
      $properties = parse_ini_file(sfConfig::get('sf_config_dir').'/properties.ini', true);
      $finder = sfFinder::type('dir')->relative()->maxdepth(0);
      foreach ($finder->in(sfConfig::get('sf_apps_dir')) as $app)
      {
        if (file_exists($file = sfConfig::get('sf_apps_dir').'/'.$app.'/lib/myUser.class.php'))
        {
          $task->getFilesystem()->mkdirs($directory = dirname($file).'/user');
          $task->getFilesystem()->rename($file, $file = $directory.'/'.$app.'User.class.php');
          $task->getFilesystem()->replaceTokens($file, '##', '##', array('APP_NAME' => $app));
        }
      }
    }
  }
}
