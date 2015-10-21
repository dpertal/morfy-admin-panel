<?php defined('PANEL_ACCESS') or die('No direct script access.');

// new panel
$p = new Panel();



/*  = Sections
--------------------------------------------*/
/*
* @name   Dashboard | login
* @desc   if session user get Dashboard
* @desc   if not redirecto to login page
*/
$p->route('/', function() use($p){
  if(Session::exists('user')){
    // show dashboard
    $p->view('index',[
      'title' => $p::$lang['Dashboard'],
      'pages' => count(File::scan(ROOTBASE.DS.'storage'.DS.'pages', 'md')),
      'images' => count(File::scan(ROOTBASE.DS.'public'.DS.'images')),
      'uploads' => count(File::scan(ROOTBASE.DS.'public'.DS.'uploads')),
      'blocks' => count(File::scan(ROOTBASE.DS.'storage'.DS.'blocks', 'md')),
      'themes' => count(Dir::scan(ROOTBASE.DS.'themes'.DS)),
      'plugins' => count(Dir::scan(ROOTBASE.DS.'plugins'.DS))
    ]);
  }else{
    // empty error
    $error = '';
    if(Request::post('login')){
      if(Request::post('csrf')){
        if(Request::post('pass') == $p::$site['backend_password'] && 
          Request::post('email') == $p::$site['autor']['email']){
          @Session::start();
          Session::set('user',uniqid('morfy_user'));
          Request::redirect($p::$site['url'].'/'.$p::$site['backend_folder']);
        }else{
          // password not correct show error
          $error = '<span class="login-error error">'.$p::$lang['Password_Error'].'</span>';
        }
      }else{
        // crsf
        die('crsf detect');
      }
    }
    // get template login
    $p->view('login',[
      'error' => $error
    ]);
  }
});




/*
* @name   Pages
* @desc   if session user get Pages
* @desc   if not redirecto to login page
*/
$p->route('/pages', function() use($p){
  if(Session::exists('user')){
    // show pages
    $p->view('pages',[
      'title' => Panel::$lang['Pages'],
      'content' => File::scan(ROOTBASE.DS.'storage'.DS.'pages')
    ]);
  }else{
    Request::redirect($p::$site['url'].'/'.$p::$site['backend_folder']);
  }
});


/*
* @name   Blocks
* @desc   if session user get Blocks
* @desc   if not redirecto to login page
*/
$p->route('/blocks', function() use($p){
  if(Session::exists('user')){
    // show pages
    $p->view('blocks',[
      'title' => Panel::$lang['Blocks'],
      'content' => File::scan(ROOTBASE.DS.'storage'.DS.'blocks')
    ]);
  }else{
    Request::redirect($p::$site['url'].'/'.$p::$site['backend_folder']);
  }
});








/*  Action functions
-------------------------------------*/

/*
* @name   Logout
* @desc   rediterct to hombe url
*/
$p->route('/action/logout', function() use($p){
  if(Session::exists('user')){
    Session::delete('user');
    Session::destroy();
    Request::redirect($p::$site['url']);
  }
});


/*
* @name   Preview
* @desc   Open preview on blank page
*/
$p->route('/action/preview', function() use($p){
    Request::redirect($p::$site['url']);
});



/*
* @name   Edit
* @desc   Edit page ( :any use base64_encode remenber decode file)
*/
$p->route('/action/edit/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('edit-file',[
        'title' => Panel::$lang['Edit_File'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});

/*
* @name   New File
* @desc   New page ( :any use base64_encode remenber decode file)
*/
$p->route('/action/newfile/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('new-file',[
        'title' => Panel::$lang['New_File'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});




/*
* @name   New Folder
* @desc   Create new folder ( :any use base64_encode remenber decode file)
*/
$p->route('/action/newfolder/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('actions',[
        'type' => 'New Folder',
        'title' => Panel::$lang['New_Folder'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});


/*
* @name   Rename File
* @desc   Rename File ( :any use base64_encode remenber decode file)
*/
$p->route('/action/rename/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('actions',[
        'type' => 'Rename',
        'title' => Panel::$lang['Rename_File'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});


/*
* @name   Remove File
* @desc   Remove File ( :any use base64_encode remenber decode file)
*/
$p->route('/action/removefile/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('actions',[
        'type' => 'Remove File',
        'title' => Panel::$lang['Remove_File'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});


/*
* @name   Remove folder
* @desc   Remove folder ( :any use base64_encode remenber decode file)
*/
$p->route('/action/removefolder/(:any)/(:any)', function($token,$file) use($p){
  if(Session::exists('user')){
    if (Token::check($token)) {
      $p->view('actions',[
        'type' => 'Remove Folder',
        'title' => Panel::$lang['Remove_Folder'],
        'content' => base64_decode($file)
      ]);
    }else{
      die('crsf Detect');
    }
  }
});


// start
$p->lauch();


