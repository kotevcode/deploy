<?php

class Deploy {

  /**
  * A callback function to call after the deploy has finished.
  *
  * @var callback
  */
  public $post_deploy;

  /**
  * The name of the branch to pull from.
  *
  * @var string
  */
  private $_branch = 'master';

  /**
  * The name of the remote to pull from.
  *
  * @var string
  */
  private $_remote = 'origin';

  /**
  * The directory where your website and git repository are located, can be
  * a relative or absolute path
  *
  * @var string
  */
  private $_directory;

  private $payload;

  /**
  * Sets up defaults.
  *
  * @param  string  $directory  Directory where your website is located
  * @param  array   $data       Information about the deployment
  */
  public function __construct($config)
  {
    Log::start();
    Log::write('**** Attempting deployment... ****');

    $this->initPayload();
    // Determine the directory path
    $this->_directory = realpath($config[$this->payload->repository->full_name]['directory']).DIRECTORY_SEPARATOR;

    $available_options = array('branch', 'remote');

    foreach ($config[$this->payload->repository->full_name]['options'] as $option => $value)
    {
      if (in_array($option, $available_options))
      {
        $this->{'_'.$option} = $value;
      }
    }
  }

  public function initPayload ()
  {

    if (isset($_SERVER['HTTP_X_EVENT_KEY'], $_SERVER['HTTP_X_HOOK_UUID'], $_SERVER['HTTP_USER_AGENT'],
    $_SERVER['REMOTE_ADDR'])) {
      Log::write('*** ' . $_SERVER['HTTP_X_EVENT_KEY'] . ' #' . $_SERVER['HTTP_X_HOOK_UUID'] .
      ' (' . $_SERVER['HTTP_USER_AGENT'] . ')');
      Log::write('remote addr: ' . $_SERVER['REMOTE_ADDR']);
    } else {
      Log::write('*** [unknown http event key] #[unknown http hook uuid] (unknown http user agent)');
    }

    $this->payload = json_decode(file_get_contents('php://input'));

    if ( empty($this->payload) ) {
      Log::write("No payload data for checkout!");
      die();
    }

    if ( !isset($this->payload->repository->full_name) ) {
      Log::write("Invalid payload data was received!");
      die();
    }

    Log::write("Valid payload was received");

  }

  /**
  * Executes the necessary commands to deploy the website.
  */
  public function execute()
  {
    Log::write('executing on '.$this->payload->repository->full_name);
    // Make sure we're in the right directory
    Log::write('Changing working directory to '.$this->_directory);
    chdir($this->_directory);

    // Discard any changes to tracked files since our last deploy
    exec('git reset --hard HEAD', $output);
    Log::write('Reseting repository... ');

    // Update the local repository
    exec('git pull '.$this->_remote.' '.$this->_branch, $output);
    Log::write('Pulling in changes... '.implode(' ', $output));

    // Secure the .git directory
    exec('chmod -R og-rx .git');
    Log::write('Securing .git directory... ');

    if (is_callable($this->post_deploy))
    {
      call_user_func($this->post_deploy, $this->_data);
    }

    Log::write('**** Deployment successful. ****');
  }

}
