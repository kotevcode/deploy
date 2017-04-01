<?php

namespace App\Services;

use App\Models\Repo;

class Deploy {

  /**
  * A callback function to call after the deploy has finished.
  *
  * @var callback
  */
  public $post_deploy;

  private $_payload;

  private $_repository;

  private $_log = [];

  /**
  * Sets up defaults.
  *
  * @param  string  $directory  Directory where your website is located
  * @param  array   $data       Information about the deployment
  */
  public function __construct($rep_id = false)
  {
    $this->log('**** Attempting deployment... ****');

    if($rep_id){
      // the repo form the db
      $this->_repository = Repo::findOrFail($rep_id);
    }else{ // the called made by webhook
      $this->initPayload();
      $rep_name = $this->_payload->repository->full_name;
      // the repo form the db
      $this->_repository = Repo::where('bitbucket',$rep_name)->first();
      if(!$this->_repository->auto_deploy){
        die();
      }
    }
  }

  /**
  * Executes the necessary commands to deploy the website.
  */
  public function execute()
  {
    $this->log('executing on '.$this->_repository->bitbucket);
    // Make sure we're in the right directory
    chdir($this->_repository->directory);
    $this->log('Changing working directory to '.$this->_repository->directory);
    // Discard any changes to tracked files since our last deploy
    exec('sudo git reset --hard HEAD', $output);
    $this->log('Reseting repository... ', implode(' ', $output));

    // Update the local repository
    exec('sudo git pull '.$this->_repository->remote.' '.$this->_repository->branch, $output);
    $this->log('Pulling in changes... '.implode(' ', $output));

    // changing permissions
    exec('sudo chown -R wallpaperbyyou:wallpaperbyyou '.$this->_repository->directory);
    $this->log('changing permissions... ');

    // Secure the .git directory
    exec('sudo chmod -R og-rx .git');
    $this->log('Securing .git directory... ');

    if (is_callable($this->post_deploy))
    {
      call_user_func($this->post_deploy, $this->_data);
    }

    $this->log('**** Deployment successful. ****');
  }


  public function log($value)
  {
    $this->_log[] = $value;
  }

  public function getLog()
  {
    return $this->_log;
  }

  public function getRepo()
  {
    return $this->_repository;
  }

  public function initPayload ()
  {
    if (isset($_SERVER['HTTP_X_EVENT_KEY'], $_SERVER['HTTP_X_HOOK_UUID'], $_SERVER['HTTP_USER_AGENT'],
    $_SERVER['REMOTE_ADDR'])) {
      $this->log('*** ' . $_SERVER['HTTP_X_EVENT_KEY'] . ' #' . $_SERVER['HTTP_X_HOOK_UUID'] .
      ' (' . $_SERVER['HTTP_USER_AGENT'] . ')');
      $this->log('remote addr: ' . $_SERVER['REMOTE_ADDR']);
    } else {
      $this->log('*** [unknown http event key] #[unknown http hook uuid] (unknown http user agent)');
    }

    $this->_payload = json_decode(file_get_contents('php://input'));

    if ( empty($this->_payload) ) {
      $this->log("No payload data for checkout!");
      exit;
    }

    if ( !isset($this->_payload->repository->full_name) ) {
      $this->log("Invalid payload data was received!");
      exit;
    }

    $this->log("Valid payload was received");
  }

}
