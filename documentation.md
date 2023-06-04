# Modul Aplikasi CRUD "Artikel Berita" Dengan Framework "Codeigniter"
#### By: Muhammad Iqbal Pranatayudha - 41518310024

## Konfigurasi
Pertama, kita harus mengkonfigurasi beberapa file didalam folder ```application/config``` seperti (yang saya konfigurasi hanya file ini):

    ├── autoload.php
    ├── config.php
    ├── database.php
    ├── migration.php
    └── routes.php
    
- File **autoload.php**
    Autoload berfungsi sebagai menge-load libraries dan helpers yang ada di codeigniter secara otomatis. Dan kita hanya menggunakan libraries dan helpers seperti:
    ``` php
    $autoload['libraries'] = array('database', 'session', 'form_validation', 'upload', 'migration');

    $autoload['helper'] = array('url', 'site', 'date', 'email', );
    ```
- File **config.php**
    Config berisi konfigurasi secara umum, yang kita ubah disini yaitu :
    ```php
    $root  = "http://".$_SERVER['HTTP_HOST'];
    $root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    $config['base_url'] = "$root";
    
    $config['index_page'] = '';
    ```
- File **database.php**
    Database digunakan untuk mengatur konfigurasi untuk databasenya, contohnya :
    ```php
    $db['default'] = array(
    	'dsn'	=> '',
    	'hostname' => 'localhost',
    	'username' => 'root', // Sesuai username phpMyAdmin anda
    	'password' => '', // Sesuai password phpMyAdmin anda
    	'database' => 'news', // Buat database dengan nama 'news'
    	'dbdriver' => 'mysqli',
    	'dbprefix' => '',
    	'pconnect' => FALSE,
    	'db_debug' => (ENVIRONMENT !== 'production'),
    	'cache_on' => FALSE,
    	'cachedir' => '',
    	'char_set' => 'utf8',
    	'dbcollat' => 'utf8_general_ci',
    	'swap_pre' => '',
    	'encrypt' => FALSE,
    	'compress' => FALSE,
    	'stricton' => FALSE,
    	'failover' => array(),
    	'save_queries' => TRUE
    );
    ```
- File **migration.php**
    Migration digunakan karena saya ingin menggunakan migrasi dengan cara menggunakan url, script yang di ubah disini yaitu :
    ```php
    $config['migration_enabled'] = TRUE;
    
    $config['migration_type'] = 'sequential';
    
    $config['migration_version'] = 4; // Karena kita memiliki 4 file migrasi
    ```
- File **routes.php**
    Routes disini tujuannya untuk menentukan kemana routing akan dilakukan, disini kita hanya perlu mengganti ```$route['default_controller'] = 'welcome';``` menjadi ```$route['default_controller'] = 'dashboard';```.
    
## Migrations
Didalam folder ```application/migrations``` ini, kita membuat 4 file, seperti:

    ├── 001_Add_admins.php
    ├── 002_Add_articles.php
    ├── 003_Add_messages.php
    └── 004_Add_types.php
    
- File ***001_Add_admins.php***
    Script:
    ```php
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Migration_Add_admins extends CI_Migration {
    
      public function up() {
        $this->dbforge->add_field(
          array(
            'admin_id' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => false,
              'auto_increment' => true
            ),
            'fullname' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false,
            ),
            'username' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false,
            ),
            'email' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false,
            ),
            'password' => array(
              'type' => 'text',
              'null' => false,
            )
          )
        );
        $this->dbforge->add_key('admin_id', true);
        $this->dbforge->create_table('admins');
      }
    
      public function down() {
        $this->dbforge->drop_table('admins');
      }
    
    }
    ```
- File ***002_Add_articles.php***
    Script:
    ```php
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Migration_Add_articles extends CI_Migration {
      
      public function up() {
        $this->dbforge->add_field(
          array(
            'article_id' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => false,
              'auto_increment' => true
            ),
            'article_title' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'article_type' => array (
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'article_desc' => array(
              'type' => 'text',
              'null' => false
            ),
            'article_content' => array(
              'type' => 'text',
              'null' => false
            ),
            'author' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'created' => array(
              'type' => 'int',
              'constraint' => 21,
              'null' => true
            ),
            'updated' => array(
              'type' => 'int',
              'constraint' => 21,
              'null' => true
            ),
            'num_view' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => true
            ),
            'num_like' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => true
            ),
            'image' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            )
          )
        );
        $this->dbforge->add_key('article_id', true);
        $this->dbforge->create_table('articles');
      }
    
      public function down() {
        $this->dbforge->drop_table('articles');
      }
    
    }
    ```
- File ***003_Add_messages.php***
    Script:
    ```php
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Migration_Add_messages extends CI_Migration {
      
      public function up() {
        $this->dbforge->add_field(
          array(
            'message_id' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => false,
              'auto_increment' => true
            ),
            'sender_name' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'sender_email' => array (
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'subject' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'message_text' => array(
              'type' => 'text',
              'null' => false
            ),
          )
        );
        $this->dbforge->add_key('message_id', true);
        $this->dbforge->create_table('messages');
      }
    
      public function down() {
        $this->dbforge->drop_table('messages');
      }
    
    }
    ```
- File ***004_Add_types.php***
    Script:
    ```php
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Migration_Add_types extends CI_Migration {
      
      public function up() {
        $this->dbforge->add_field(
          array(
            'type_id' => array(
              'type' => 'int',
              'constraint' => 11,
              'null' => false,
              'auto_increment' => true
            ),
            'type_name' => array(
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            ),
            'class' => array (
              'type' => 'varchar',
              'constraint' => 255,
              'null' => false
            )
          )
        );
        $this->dbforge->add_key('type_id', true);
        $this->dbforge->create_table('types');
      }
    
      public function down() {
        $this->dbforge->drop_table('types');
      }
    
    }
    ```
Setelah buat file migrasinya, kita harus membuat file controller untuk migrasinya, karena kita ingin mengimpor table dengan migrasinya ke dalam database ```news``` dengan menggunakan url saja, kita beri nama file ```Migrate.php```, scriptnya:
```php
<?php

class Migrate extends CI_Controller {

  public function index()
  {
    if ($this->migration->current() === FALSE)
    {
      show_error($this->migration->error_string());
    }
    echo "Migrations success!";
  }

}
```
Setelah itu, kita bisa langsung coba dengan membuka link http://localhost/news/migrate, jika berhasil, akan muncul tampilan seperti ini:
![Migrate](https://i.imgur.com/xMVGm19.png)

## Views
View berhubungan dengan segala sesuatu yang akan ditampilkan ke enduser. Bisa berupa halaman web, rss, javascript dan lain-lain. Kita harus menghindari adanya logika atau pemrosesan data di view. Di dalam view hanya berisi variabel-variabel yang berisi data yang siap ditampilkan. View dapat dikatakan sebagai halaman website yang dibuat dengan menggunakan HTML dan bantuan CSS atau JavaScript. Di dalam view jangan pernah ada kode untuk melakukan koneksi ke basisdata. View hanya dikhususkan untuk menampilkan data-data hasil dari model dan controller. Folder model ini terletak di ```application/views```.

Disini ada struktur folder dan file yang kita gunakan sebagai view, yaitu:

    ├── admin
    |   ├── v_admin_create.php
    |   ├── v_admin_edit.php
    |   ├── v_admin_footer.php
    |   ├── v_admin_header.php
    |   ├── v_admin_landing.php
    |   ├── v_admin_messages.php
    |   └── v_admin_preview.php
    ├── client
    |   ├── v_client_contact.php
    |   ├── v_client_footer.php
    |   ├── v_client_header.php
    |   ├── v_client_single_news.php
    |   ├── v_landing.php
    |   └── v_list_news.php
    ├── erros # default, jangan diubah atau hapus
    ├── index.html # default, jangan diubah atau hapus
    ├── v_login.php
    ├── v_register.php
    └── welcome_message.php # default, jangan diubah atau hapus
    
- Folder **admin**:
    - File **v_admin_header.php** :
        ```html
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
          <meta charset="UTF-8">
          <meta name="description" content="">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>IT News</title>
          <link rel="icon" href="<?php echo base_url('assets/img/core-img/favicon.ico'); ?>">
          <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
          <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        
        </head>
        
        <body>
          <div class="preloader d-flex align-items-center justify-content-center">
            <div class="lds-ellipsis">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
          <header class="header-area" style="padding: 0 10px">
            <div class="top-header-area">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <a href="#">
                      Welcome to Admin Page, <?php echo $this->session->userdata('admin-name'); ?>
                    </a>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="top-meta-data d-flex align-items-center justify-content-end">
                      <a href="<?php echo base_url('auth/logout'); ?>" class="login-btn">Logout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="vizew-main-menu" id="sticker">
              <div class="classy-nav-container breakpoint-off">
                <div class="container">
                  <nav class="classy-navbar justify-content-between" id="vizewNav">
        
                    <a href="<?php echo base_url('client'); ?>" class="nav-brand">IT News</a>
        
                    <div class="classy-navbar-toggler">
                      <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
        
                    <div class="classy-menu">
        
                      <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                      </div>
                    </div>
                  </nav>
                </div>
              </div>
            </div>
          </header>
        ```
    - File **v_admin_footer.php** :
        ```html
        <footer class="footer-area">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-6 col-xl-5 offset-xl-2">
                <div class="footer-widget mb-70">
                  <h6 class="widget-title">My Address</h6>
                  <div class="contact-address">
                    <p>Name: Muhammad Iqbal Pranatayudha</p>
                    <p>NIM: 41519310024</p>
                    <p>Phone: 085703757987</p>
                    <p>Email: pranatayudha001@gmail.com</p>
                  </div>
                  <div class="footer-social-area">
                    <a href="https://www.instagram.com/_prntyudha" target="_blank" class="instagram"><i
                        class="fa fa-instagram"></i></a>
                    <a href="https://twitter.com/pranatayudha_" target="_blank" class="twitter"><i
                        class="fa fa-twitter"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>
        
        <script src="<?php echo base_url('assets/js/jquery/jquery-2.2.4.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap/popper.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/js/plugins/plugins.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/active.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
        <script type="text/javascript">
        if (document.getElementById("ckeditor")) {
          console.log("got ckeditor")
          CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: "<?php echo base_url('assets/kcfinder');?>"
          });
        }
        </script>
        
        </body>
        
        </html>
        ```
    - File **v_admin_landing.php** :
        ```html
        <div class="vizew-archive-list-posts-area mb-80">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-12">
                <div class="mt-15 mb-50">
                  <h4>
                    IT News Admin's
                  </h4>
                  <p>
                    Mini review of all article
                  </p>
                </div>
        
                <a href="<?php echo base_url('admin/admin_create_news'); ?>" class="btn btn-success btn-block mb-15">
                  <i class="fa fa-plus"></i> Create New
                </a>
                <a href="<?php echo base_url('admin/see_message'); ?>" class="btn btn-dark btn-block mb-15">
                  See all the feedback here
                </a>
                <div class="jumbotron">
                  <h1>Article</h1>
                </div>
                <?php if($this->session->flashdata('articleDeleted')) : ?>
        
                <div class="alert alert-danger" id="articleDeleted">
                  <?php echo $this->session->flashdata('articleDeleted'); ?>
                </div>
        
                <?php elseif($this->session->flashdata('articleUpdated')) : ?>
        
                <div class="alert alert-success" id="articleUpdated">
                  <?php echo $this->session->flashdata('articleUpdated'); ?>
                </div>
        
                <?php endif; ?>
                <div class="form-group justify-content-around row no-gutters">
                  <div class="mb-2 mb-md-0 pr-md-1 col-md-7 col-lg-8 input-group">
                    <div class="input-group-prepend">
                      <i class="input-group-text fa fa-search"></i>
                    </div>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Article Title, Article Type"
                      onkeyup="filter_list_article_newest() || filter_list_article_latest()">
                  </div>
                  <div class="mb-2 mb-md-0 pr-md-1 pl-md-1 col-md-5 col-lg-4 input-group">
                    <select id="selectSearch" class="form-control" style="-webkit-appearance: menulist">
                      <option value="newest" selected>Newest</option>
                      <option value="latest">Latest</option>
                    </select>
                  </div>
                </div>
                <ul class="list-group mb-2" id="listArticleNewest">
        
                  <?php foreach ($article_full as $index => $value) : ?>
        
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-md-5">
                        <strong>
                          <?php echo $value['article_title']; ?>
                        </strong>
                        <div class="small">
                          <p class="mb-0">
                            <?php echo $value['type_name']; ?>
                          </p>
                        </div>
                        <div class="small">
                          <small>
                            <?php echo $value['author']; ?>
                          </small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <p class="mb-0">
                          <strong>Created on:</strong><small>
                            <?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                        </p>
                        <p class="mb-0">
                          <strong>Updated on:</strong>
                          <small><?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                        </p>
                      </div>
                      <div class="col-md-4">
                        <div class="pull-right">
                          <a href="<?php 
                              echo base_url('admin/admin_view_news/');
                              echo $value['article_id'];
                            ?>"
                            class="btn btn-dark">
                            <i class="fa fa-eye"></i> PREVIEW
                          </a href="">
                          <a href="<?php 
                              echo base_url('admin/admin_edit_news/');
                              echo $value['article_id'];
                            ?>"
                            class="btn btn-info">
                            <i class="fa fa-edit"></i> EDIT</a href="">
                          <a href="" class="btn btn-danger" data-toggle='modal'
                            data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                            <i class="fa fa-trash"></i> DELETE</a href="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
        
                <ul class="list-group mb-2" id="listArticleLatest" style="display: none">
        
                  <?php foreach (array_reverse($article_full) as $index => $value) : ?>
        
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col-md-5">
                        <strong>
                          <?php echo $value['article_title']; ?>
                        </strong>
                        <div class="small">
                          <p class="mb-0">
                            <?php echo $value['type_name']; ?>
                          </p>
                        </div>
                        <div class="small">
                          <small>
                            <?php echo $value['author']; ?>
                          </small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <p class="mb-0">
                          <strong>Created on:</strong><small>
                            <?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                        </p>
                        <p class="mb-0">
                          <strong>Updated on:</strong>
                          <small><?php echo date("Y-m-d H:i:s", $value['created']);?></small>
                        </p>
                      </div>
                      <div class="col-md-4">
                        <div class="pull-right">
                          <a href="<?php 
                              echo base_url('admin/admin_view_news/');
                              echo $value['article_id'];
                            ?>"
                            class="btn btn-dark">
                            <i class="fa fa-eye"></i> PREVIEW
                          </a href="">
                          <a href="<?php 
                              echo base_url('admin/admin_edit_news/');
                              echo $value['article_id'];
                            ?>"
                            class="btn btn-info">
                            <i class="fa fa-edit"></i> EDIT</a href="">
                          <a href="" class="btn btn-danger" data-toggle='modal'
                            data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                            <i class="fa fa-trash"></i> DELETE</a href="">
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
                <div class="table-responsive" style="display: none">
                  <div class="jumbotron">
                    <h1>Article</h1>
                  </div>
                  <?php if($this->session->flashdata('articleDeleted')) : ?>
        
                  <div class="alert alert-danger" id="articleDeleted">
                    <?php echo $this->session->flashdata('articleDeleted'); ?>
                  </div>
        
                  <?php elseif($this->session->flashdata('articleUpdated')) : ?>
        
                  <div class="alert alert-success" id="articleUpdated">
                    <?php echo $this->session->flashdata('articleUpdated'); ?>
                  </div>
        
                  <?php endif; ?>
                  <table class="table" id="table-news2">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Created</th>
                        <th class="text-center">Updated</th>
                        <th class="text-center">Action</th>
                      </tr>admin/admin_delete_news/<?php echo $value['article_id']; ?>'
                    </thead>
                    <tbody>
        
                      <?php foreach ($article_full as $index => $value) : ?>
        
                      <tr>
                        <td class="text-center" width="5%">
                          <?php echo $value['article_id']; ?>
                        </td>
                        <td width="">
                          <?php echo $value['article_title']; ?>
                        </td>
                        <td class="text-center" width="10%">
                          <?php echo $value['type_name']; ?>
                        </td>
                        <td class="text-center" width="10%">
                          <?php echo $value['author']; ?>
                        </td>
                        <td class="text-center" width="10%">
                          <?php echo date("Y-m-d H:i:s", $value['created']); ?>
                        </td>
                        <td class="text-center" width="10%">
                          <?php echo date("Y-m-d H:i:s", $value['updated']); ?>
                        </td>
                        <td width="28%">
                          <div class='text-center'>
                            <a href='<?php 
                                echo base_url('admin/admin_view_news/');
                                echo $value['article_id'];
                              ?>'
                              class='btn btn-dark'>
                              <i class="fa fa-eye"></i> Preview
                            </a>
                            <a href='<?php
                                echo base_url('admin/admin_edit_news/');
                                echo $value['article_id'];
                              ?>'
                              class='btn btn-info'>
                              <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href='' class='btn btn-danger' data-toggle='modal'
                              data-target='#modal_delete_<?php echo $value['article_id']; ?>'>
                              <i class="fa fa-trash"></i> Delete
                            </a>
                          </div>
                        </td>
                      </tr>
        
                      <?php endforeach; ?>
        
                    </tbody>
                  </table>
                </div>
        
                <?php foreach ($article_full as $index => $value) : ?>
        
                <div class='modal fade' id='modal_delete_<?php echo $value['article_id']; ?>' tabindex='-1' role='dialog'
                  aria-hidden='true'>
                  <div class='modal-dialog ' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h6 class='modal-title text-danger'>Are you sure you want to delete <b
                            style="color: #797979"><?php echo $value['article_title']; ?></b> article?
                        </h6>
                        <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>×</span>
                        </button>
                      </div>
                      <h7 class='modal-body'>Select 'Delete' below if you are sure to delete this article</h7>
                      <div class='modal-footer'>
                        <a class='btn btn-sm btn-secondary' href='#' data-dismiss='modal'>Cancel</a>
                        <a href='<?php 
                          echo base_url('admin/admin_delete_news/');
                          echo $value['article_id'];
                        ?>'
                          class='btn btn-sm btn-danger'>Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
        
                <?php endforeach; ?>
        
              </div>
            </div>
          </div>
        </div>
        ```
    - File **v_admin_messages.php** :
        ```html
        <div class="vizew-archive-list-posts-area mb-80">
        	<div class="container">
        		<div class="row justify-content-center">
        			<div class="col-12 col-lg-12">
        				<div class="mt-15 mb-50">
        					<h4>
        						<a href="<?php echo base_url('admin') ?>" style="text-decoration: none; color: #ffffff !important">
        							IT News Admin's
        						</a>
        					</h4>
        					<p>
        						All the messages list here
        					</p>
        				</div>
        
        				<a href="<?php echo base_url('admin'); ?>" class="btn btn-dark btn-block mb-15">
        					Back to the article list
        				</a>
        				<div class="form-group justify-content-arround row no-gutters">
        					<div class="mb-2 mb-md-0 pr-md-1 col-md-7 col-lg-8 input-group">
        						<div class="input-group-prepend">
        							<i class="input-group-text fa fa-search"></i>
        						</div>
        						<input type="text" id="searchMessage" class="form-control"
        							placeholder="Search Message Subject, Message Sender"
        							onkeyup="filter_list_message_newest() || filter_list_message_latest()">
        					</div>
        					<div class="mb-2 mb-md-0 pr-md-1 pl-md-1 col-md-5 col-lg-4 input-group">
        						<select id="selectMessages" class="form-control" style="-webkit-appearance: menulist">
        							<option value="newest" selected>Newest</option>
        							<option value="latest">Latest</option>
        						</select>
        					</div>
        				</div>
        				<ul class="list-group mb-2" id="listMessagesNewest">
        
        					<?php foreach($all_messages as $index => $value) : ?>
        
        					<li class="list-group-item">
        						<div class="row">
        							<div class="col-md-12">
        								<strong>
        									<?php echo $value['sender_name'].', '.$value['sender_email']; ?>
        								</strong>
        								<div class="small">
        									<p class="mb-0">
        										<?php echo $value['subject']; ?>
        									</p>
        								</div>
        								<div class="small">
        									<small>
        										<?php echo $value['message_text']; ?>
        									</small>
        								</div>
        							</div>
        						</div>
        					</li>
        
        					<?php endforeach; ?>
        
        				</ul>
        				<ul class="list-group mb-2" id="listMessagesLatest" style="display: none">
        
        					<?php foreach(array_reverse($all_messages) as $index => $value) : ?>
        
        					<li class="list-group-item">
        						<div class="row">
        							<div class="col-md-12">
        								<strong>
        									<?php echo $value['sender_name'].', '.$value['sender_email']; ?>
        								</strong>
        								<div class="small">
        									<p class="mb-0">
        										<?php echo $value['subject']; ?>
        									</p>
        								</div>
        								<div class="small">
        									<small>
        										<?php echo $value['message_text']; ?>
        									</small>
        								</div>
        							</div>
        						</div>
        					</li>
        
        					<?php endforeach; ?>
        
        				</ul>
        			</div>
        		</div>
        	</div>
        </div>
        ```
    - File **v_admin_create.php** :
        ```html
        <div class="container">
        	<div class="col-12 col-md-12">
        		<h2>News Portal</h2>
        		<hr />
        		<form action="<?php echo base_url('admin/admin_save_news');?>" method="post" enctype="multipart/form-data">
        			<div class="form-group mb-0">
        				<label for="">Title</label>
        				<input type="text" name="judul" class="form-control" placeholder="Article Title" required /><br />
        			</div>
        			<div class="form-group">
        				<label for="">Article Type: </label>
        				<select name="type_article" id="type_article" class="form-control" style="-webkit-appearance: menulist">
        					<option disabled selected>Choose one</option>
        					<?php foreach ($type_name as $index => $value) : ?>
        
        					<option value="<?php echo $value['type_id']; ?>">
        						<?php echo $value['type_name']; ?>
        					</option>
        
        					<?php endforeach; ?>
        
        				</select>
        			</div>
        			<div class="form-group">
        				<label for="desc">Description</label>
        				<input type="text" name="summary" class="form-control" placeholder="Article Short Description"
        					required /><br />
        			</div>
        			<div class="form-group">
        				<label for="">Content</label>
        				<textarea id="ckeditor" name="berita" class="form-control"></textarea><br />
        			</div>
        			<div class="form-group">
        				<input type="file" name="filefoto" required><br>
        			</div>
        			<div class="form-group">
        				<button class="btn btn-primary btn-lg" type="submit">Post Article</button>
        				<a href="<?php echo base_url('admin'); ?>" class="btn btn-danger btn-lg">
        					Cancel
        				</a>
        			</div>
        		</form>
        	</div>
        </div>
        ```
    - File **v_admin_preview.php** :
        ```html
        <div class="vizew-breadcrumb">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <nav aria-label="breadcrumb">
                  <?php foreach($news_detail as $index => $value) : ?>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin"><i class="fa fa-home"
                          aria-hidden="true"></i> Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $value['article_title'] ?>
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        
        <section class="post-details-area mb-80">
          <div class="container" style="background-color: black; padding: 20px; border-radius: 10px;">
        
        
            <div class="row">
              <div class="col-12">
                <div class="post-details-thumb mb-50">
                  <img src="<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>" alt=""
                    style="width: 1100px; height: 400px; border: 1px solid white">
                </div>
              </div>
            </div>
        
            <div class="row justify-content-center">
              <!-- Post Details Content Area -->
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="post-details-content">
                  <!-- Blog Content -->
                  <div class="blog-content">
                    <!-- Post Content -->
                    <div class="post-content mt-0">
                      <a href="<?php echo base_url(); ?>client/list_news/<?php echo $value['type_id']; ?>"
                        class="post-cata cata-sm <?php echo $value['class']; ?>">
                        <?php echo $value['type_name']; ?>
                      </a>
                      <a href="#" class="post-title mb-2">
                        <?php echo $value['article_title']; ?>
                      </a>
                      <div class="d-flex justify-content-between mb-30">
                        <div class="post-meta d-flex align-items-center">
                          <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                          <i class="fa fa-circle" aria-hidden="true"></i>
                          <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']); ?></a>
                        </div>
                        <div class="post-meta d-flex">
                          <a id="num-view-main-<?php echo $value['article_id'] ?>" href="#"
                            style="pointer-events: none; color:#a6a6a6"><i class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></a>
                          <!-- <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none; color:#a6a6a6"><i class="fa fa-comments-o" aria-hidden="true"></i> 32</a> -->
                          <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#"
                            style="pointer-events: none; color:#a6a6a6"></a>
                          <a id="num-like-main-<?php echo $value['article_id'] ?>" href="#" id="likenum"
                            style="pointer-events: none; color:#a6a6a6"
                            onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                              class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></a>
                        </div>
                      </div>
                    </div>
        
                    <?php echo $value['article_content']; ?>
        
                    <?php endforeach; ?>
        
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        ```
    - File **v_admin_edit.php** :
        ```html
        <div class="container">
          <div class="col-12 col-md-12">
            <h2>News Portal</h2>
            <hr />
        
            <?php foreach ($news_detail as $index => $value) : ?>
            <form action="<?php 
                echo base_url('admin/admin_update_news/');
                echo $value['article_id'];  
              ?>" method="post"
              enctype="multipart/form-data">
        
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="judul" class="form-control" placeholder="News title"
                  value="<?php echo $value['article_title']; ?>" required />
                <br />
              </div>
              <div class="form-group">
                <label for="">Article Type: </label>
                <select name="type_article" id="type_article" class="form-control" style="">
                  <option disabled>Choose one</option>
        
                  <?php foreach ($type_name as $index2 => $value2) : ?>
        
                  <option <?php if($value['article_type'] == $value2['type_id']) { echo "selected"; } ?>
                    value="<?php echo $value2['type_id']; ?>">
                    <?php echo $value2['type_name']; ?>
                  </option>
        
                  <?php endforeach; ?>
        
                </select>
              </div>
              <div class="form-group">
                <label for="desc">Description</label>
                <input type="text" name="summary" class="form-control" placeholder="Article Summary"
                  value="<?php echo $value['article_desc'] ?>" required /><br />
              </div>
              <div class="form-group">
                <label for="">Content</label>
                <textarea id="ckeditor" name="berita" class="form-control">
        										<?php echo $value['article_content']; ?>
        									</textarea><br />
              </div>
              <div class="form-group">
                <p>If you want to change the article picture, choose new image here.</p>
                <input type="file" name="filefoto"><br>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-lg" type="submit">Post Article</button>
                <a href="<?php echo base_url('admin'); ?>" class="btn btn-danger btn-lg">
                  Cancel
                </a>
              </div>
            </form>
            <?php endforeach; ?>
          </div>
        </div>
        ```
- Folder **client**:
    - File **v_client_header.php**:
        ```html
        <!DOCTYPE html>
        <html lang="en">
        
        <head>
          <meta charset="UTF-8">
          <meta name="description" content="">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>IT News</title>
          <link rel="icon" href="<?php echo base_url('assets/img/core-img/favicon.ico'); ?>">
          <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
          <style>
          .post-details-area.mb-80 img {
            border: 1px solid white !important;
          }
          </style>
        </head>
        
        <body>
          <div class="preloader d-flex align-items-center justify-content-center">
            <div class="lds-ellipsis">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
        
          <header class="header-area">
            <div class="top-header-area">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-12 col-md-6">
                    <div class="breaking-news-area d-flex align-items-center">
                      <div class="news-title">
                        <label> You can login as an admin by clicking to the icon people in right bar. </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="top-meta-data d-flex align-items-center justify-content-end">
                      <div class="top-social-info">
                        <a href="https://www.instagram.com/_prntyudha/" target="_blank" data-toggle="tooltip"
                          data-placement="top" title="Instagram">
                          <i class="fa fa-instagram"></i>
                        </a>
                        <a href="https://twitter.com/pranatayudha_" target="_blank" data-toggle="tooltip" data-placement="top"
                          title="Twitter">
                          <i class="fa fa-twitter"></i>
                        </a>
                        <a href="<?php echo base_url('client/contact'); ?>" data-toggle="tooltip" data-placement="top"
                          title="Get in touch!">
                          <i class="fa fa-phone"></i>
                        </a>
                      </div>
                      <a href="<?php echo base_url('client/login'); ?>" class="login-btn" data-toggle="tooltip"
                        data-placement="top" title="Login as Admin"><i class="fa fa-user" aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
            <div class="vizew-main-menu" id="sticker">
              <div class="classy-nav-container breakpoint-off">
                <div class="container">
                  <nav class="classy-navbar justify-content-between" id="vizewNav">
                    <a href="<?php echo base_url('client'); ?>" class="nav-brand">IT News</a>
        
                    <div class="classy-navbar-toggler">
                      <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
        
                    <div class="classy-menu">
        
                      <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                      </div>
        
                      <div id="classynav" class="classynav">
                        <ul>
                          <li id="tab-0">
                            <a href="<?php echo base_url('client'); ?>">ALL</a>
                          </li>
        
                          <?php foreach ($type_name as $index => $value) : ?>
        
                          <li id="tab-<?php echo $value['type_id']; ?>"
                            class="<?php if($this->uri->segment(3) == $value['type_id']) echo 'active' ?>">
                            <a
                              href="<?php echo base_url(); ?>client/list_news/<?php echo $value['type_id']; ?>"><?php echo $value['type_name']; ?></a>
                          </li>
        
                          <?php endforeach; ?>
        
                        </ul>
                      </div>
                    </div>
                  </nav>
                </div>
              </div>
            </div>
          </header>
        ```
    - File **v_client_footer.php**:
        ```html
        <footer class="footer-area">
          <div class="container">
            <div class="row">
        
              <div class="col-12 col-sm-6 col-xl-5 offset-xl-2">
                <div class="footer-widget mb-70">
                  <h6 class="widget-title">My Address</h6>
        
                  <div class="contact-address">
                    <p>Pondok Kelapa, Duren Sawit, Jakarta Timur, DKI Jakarta, Indonesia</p>
                    <p>Name: Muhammad Iqbal Pranatayudha</p>
                    <p>NIM: 41519310024</p>
                    <p>Phone: 085703757987</p>
                    <p>Email: pranatayudha001@gmail.com</p>
                  </div>
        
                  <div class="footer-social-area">
                    <a href="https://www.instagram.com/_prntyudha" target="_blank" class="instagram"><i
                        class="fa fa-instagram"></i></a>
                    <a href="https://twitter.com/pranatayudha_" target="_blank" class="twitter"><i
                        class="fa fa-twitter"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        </footer>
        
        <script src="<?php echo base_url(); ?>assets/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/plugins.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/active.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/app.js"></script>
        </body>
        
        </html>
        ```
    - File **v_landing.php**:
        ```html
        <section class="hero--area section-padding-80">
          <div class="container">
            <div class="row no-gutters">
              <div class="col-12 col-md-7 col-lg-8">
                <div class="tab-content" style="border: 1px solid #393c3d;">
                  <?php foreach($article as $index => $value) : ?>
                  <?php if($index < 8) : ?>
                  <?php if($index == 0) : ?>
                  <div class="tab-pane fade show active" id="post-<?php echo $index + 1; ?>" role="tabpanel"
                    aria-labelledby="post-<?php echo $index + 1; ?>-tab">
                    <div class="single-feature-post video-post bg-img"
                      style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>">
                      <?php else : ?>
                      <div class="tab-pane fade" id="post-<?php echo $index + 1; ?>" role="tabpanel"
                        aria-labelledby="post-<?php echo $index + 1; ?>-tab">
                        <div class="single-feature-post video-post bg-img"
                          style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>">
                          <?php endif; ?>
        
                          <div class="post-content">
                            <a href="<?php
                                echo base_url('client/list_news/');
                                echo $value['type_id'];
                              ?>"
                              class="post-cata <?php echo $value['class'] ?>">
                              <?php echo $value['type_name']; ?>
                            </a>
                            <a href="<?php 
                                echo base_url('client/detail_news/');
                                echo $value['article_id'];  
                              ?>"
                              class="post-title">
                              <?php echo $value['article_title']; ?>
                            </a>
                            <div class="post-meta d-flex">
                              <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                                <?php echo $value['num_view']; ?></a>
        
                              <a href="#" style="pointer-events: none"></a>
                              <a href="#" id="likenum" style="pointer-events: none"
                                onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                                  class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $value['num_like']; ?></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                  </div>
        
                  <div class="col-12 col-md-5 col-lg-4">
                    <ul class="nav vizew-nav-tab" role="tablist">
                      <?php foreach($article as $index => $value) : ?>
                      <?php if($index < 8) : ?>
                      <li class="nav-item" style="width: 100%">
                        <?php if($index == 0) : ?>
                        <a class="nav-link active" id="post-<?php echo $index+1; ?>-tab" data-toggle="pill"
                          href="#post-<?php echo $index+1; ?>" role="tab" aria-controls="post-<?php echo $index+1; ?>"
                          aria-selected="false">
                          <?php else : ?>
                          <a class="nav-link" id="post-<?php echo $index+1; ?>-tab" data-toggle="pill"
                            href="#post-<?php echo $index+1; ?>" role="tab" aria-controls="post-<?php echo $index+1; ?>"
                            aria-selected="false">
                            <?php endif; ?>
        
                            <div class="single-blog-post style-2 d-flex align-items-center">
                              <div class="post-thumbnail">
                                <img src="<?php 
                                    echo base_url('assets/img/'); 
                                    echo $value['image'];  
                                  ?>" alt=""
                                  style="width: 110px; height: 62px">
                              </div>
                              <div class="post-content" style="width: 100%">
                                <h6 class="post-title">
                                  <?php echo $value['article_title']; ?>
                                </h6>
                                <div id="trend-article" class="post-meta d-flex justify-content-between">
        
                                  <span> </span>
                                  <span><i class="fa fa-eye" aria-hidden="true"></i>
                                    <?php echo $value['num_view']; ?></span>
                                  <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                    <?php echo $value['num_like']; ?></span>
                                </div>
                              </div>
                            </div>
                          </a>
                      </li>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
        </section>
        
        <section class="trending-posts-area">
          <div class="container">
            <div class="row">
              <div class="col-12">
        
                <div class="section-heading">
                  <h4>Trending Article</h4>
                  <div class="line"></div>
                </div>
              </div>
            </div>
        
            <div class="row">
              <?php foreach ($article_trend as $index => $value) : ?>
        
              <div class="col-12 col-md-4">
                <div class="single-post-area mb-80">
                  <div class="post-thumbnail">
                    <img src="<?php 
                        echo base_url('assets/img/');
                        echo $value['image'];
                      ?>" 
                      alt=""
                      style="width: 350px; height: 210px">
                  </div>
        
                  <div class="post-content">
                    <a href="<?php 
                        echo base_url('client/list_news/');
                        echo $value['type_id'];
                      ?>"
                      class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                    <a href="<?php 
                        echo base_url('client/detail_news/'); 
                        echo $value['article_id'];  
                      ?>"
                      class="post-title"><?php echo $value['article_title']; ?></a>
                    <div class="post-meta d-flex">
                      <a href="#" style="pointer-events: none"><i class="fa fa-eye">
                          <?php echo $value['num_view']; ?></i></a>
                      <a href="#" style="pointer-events: none"></a>
                      <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up">
                          <?php echo $value['num_like']; ?></i></a>
                    </div>
                  </div>
                </div>
              </div>
        
              <?php endforeach; ?>
        
            </div>
        
          </div>
        </section>
        
        <section class="vizew-post-area mb-50">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-7 col-lg-8">
                <div class="all-posts-area">
        
                  <div class="section-heading style-2">
                    <h4>Latest Article</h4>
                    <div class="line"></div>
                  </div>
                  <div class="featured-post-slides owl-carousel mb-30">
        
                    <?php foreach ($article_latest as $index => $value) : ?>
        
                    <?php if($index < 4) : ?>
        
                    <div class="single-feature-post video-post bg-img"
                      style="background-image: url(<?php echo base_url(); ?>assets/img/<?php echo $value['image']; ?>);">
        
                      <div class="post-content">
                        <a href="<?php
                          echo base_url('client/list_news/');
                          echo $value['type_id'];
                        ?>"
                          class="post-cata <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                        <a href="<?php 
                            echo base_url('client/detail_news/');
                            echo $value['article_id'];
                          ?>"
                          class="post-title"><?php echo $value['article_title']; ?></a>
                        <div class="post-meta d-flex">
                          <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></a>
                          <a href="#" style="pointer-events: none"></a>
                          <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></a>
                        </div>
                      </div>
                    </div>
                    <?php endif;  ?>
        
                    <?php endforeach; ?>
        
                  </div>
        
                  <?php foreach ($article_latest as $index => $value) : ?>
        
                  <?php if($index >= 4) : ?>
        
                  <div class="single-post-area mb-30">
                    <div class="row align-items-center">
                      <div class="col-12 col-lg-6">
                        <div class="post-thumbnail">
                          <img src="<?php 
                            echo base_url('assets/img/');
                            echo $value['image'];
                          ?>" 
                            alt=""
                            style="width: 350px; height: 230px">
                        </div>
                      </div>
                      <div class="col-12 col-lg-6">
                        <div class="post-content mt-0">
                          <a href="<?php 
                            echo base_url('client/list_news/');
                            echo $value['type_id'];
                          ?>"
                            class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                          <a href="<?php 
                            echo base_url('client/detail_news/');
                            echo $value['article_id'];
                          ?>"
                            class="post-title mb-2"><?php echo $value['article_title']; ?></a>
                          <div class="post-meta d-flex align-items-center mb-2">
                            <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                            <i class="fa fa-circle" aria-hidden="true"></i>
                            <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']) ?></a>
                          </div>
                          <p class="mb-2 text-justify">
                            <?php echo $value['article_desc']; ?>
                          </p>
                          <div class="post-meta d-flex">
                            <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                              <?php echo $value['num_view']; ?></a>
                            <a href="#" style="pointer-events: none"></a>
                            <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                              <?php echo $value['num_like']; ?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
        
                  <?php endif; ?>
        
                  <?php endforeach; ?>
        
                </div>
              </div>
        
              <div class="col-12 col-md-5 col-lg-4">
                <div class="sidebar-area">
        
                  <div class="single-widget mb-50">
                    <div class="section-heading style-2 mb-30">
                      <h4>Most Viewed</h4>
                      <div class="line"></div>
                    </div>
        
                    <?php foreach ($article_most_viewed as $index => $value) : ?>
        
                    <div class="single-blog-post d-flex">
                      <div class="align-self-center post-thumbnail">
                        <img src="<?php 
                          echo base_url('assets/img/');
                          echo $value['image'];  
                        ?>" 
                          alt=""
                          style="width: 110px; height: 62px">
                      </div>
                      <div class="post-content" style="width:100%">
                        <a href="<?php 
                            echo base_url('client/detail_news/');
                            echo $value['article_id'];
                          ?>"
                          class="post-title"><?php echo $value['article_title']; ?></a>
                        <div class="post-meta d-flex justify-content-between">
                          <a href="#" style="pointer-events:none"></a>
                          <a href="#" style="pointer-events:none"><i class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></a>
                          <a href="#" style="pointer-events:none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></a>
                        </div>
                      </div>
                    </div>
        
                    <?php endforeach; ?>
        
                  </div>
        
                </div>
              </div>
            </div>
          </div>
        </section>
        ```
    - File **v_list_news.php**:
        ```html
        <div class="vizew-breadcrumb">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('client'); ?>"><i class="fa fa-home"
                          aria-hidden="true"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      <?php echo $article[0]['type_name'] ?></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div class="vizew-archive-list-posts-area mb-80">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-8">
                <?php foreach ($article as $index => $value) : ?>
                <div class="single-post-area style-2">
                  <div class="row align-items-center">
                    <div class="col-12 col-md-6">
                      <div class="post-thumbnail">
                        <img src="<?php 
                          echo base_url('assets/img/');
                          echo $value['image'];
                        ?>"
                          style="height: 210px; width: 100%" alt="">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="post-content mt-0">
                        <a href="#"
                          class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                        <a href="<?php 
                            echo base_url('client/detail_news/');
                            echo $value['article_id'];
                          ?>"
                          class="post-title mb-2"><?php echo $value['article_title']; ?></a>
                        <div class="post-meta d-flex align-items-center mb-2">
                          <a href="#" class="post-author" style="pointer-events: none">By
                            <?php echo $value['author']; ?></a>
                          <i class="fa fa-circle" aria-hidden="true"></i>
                          <a href="#" class="post-date"
                            style="pointer-events: none"><?php echo date("M d, Y", $value['created']); ?></a>
                        </div>
                        <p class="mb-2 text-justify"><?php echo $value['article_desc'] ?></p>
                        <div class="post-meta d-flex">
                          <a href="#" style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true""></i> <?php echo $value['num_view']; ?></a>
                                                        <a href=" #"></a>
                          <a href="#" style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true""></i> <?php echo $value['num_like']; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php endforeach; ?>
            </div>

                    <div class=" col-12 col-md-5 col-lg-4">
                      <div class="sidebar-area">
    
                        <div class="single-widget mb-50">
                          <div class="section-heading style-2 mb-30">
                            <h4>Most Viewed</h4>
                            <div class="line"></div>
                          </div>
    
                          <?php foreach ($article_most_viewed as $index => $value) : ?>
                          <div class="single-blog-post d-flex">
                            <div class="align-self-center post-thumbnail">
                              <img src="<?php 
                                  echo base_url('assets/img/');
                                  echo $value['image'];
                                ?>"
                                style="height: 66px" alt="">
                            </div>
                            <div class="post-content">
                              <a href="<?php 
                                echo base_url('client/detail_news/');
                                echo $value['article_id'];
                              ?>"
                                class="post-title"><?php echo $value['article_title']; ?></a>
                              <div class="post-meta d-flex justify-content-between">
                                <a href="#"></a>
                                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                  <?php echo $value['num_view']; ?></a>
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                  <?php echo $value['num_like']; ?></a>
                              </div>
                            </div>
                          </div>
    
                          <?php endforeach; ?>
    
                        </div>
    
                      </div>
                </div>
              </div>
            </div>
          </div>
        ```
    - File **v_client_single_news.php**:
        ```html
        <div class="vizew-breadcrumb">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <nav aria-label="breadcrumb">
                  <?php foreach($detail_news as $index => $value) : ?>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>client"><i class="fa fa-home"
                          aria-hidden="true"></i> Home</a></li>
                    <li class="breadcrumb-item">
                      <a href="<?php 
                          echo base_url('client/list_news/');
                          echo $value['type_id'];?>
                        ">
                          <?php echo $value['type_name']; ?>
                      </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $value['article_title'] ?>
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        
        <section class="post-details-area mb-80">
          <div class="container" style="background-color: black; padding: 20px; border-radius: 10px;">
        
        
            <div class="row">
              <div class="col-12">
                <div class="post-details-thumb mb-50">
                  <img src="<?php
                      echo base_url('assets/img/');
                      echo $value['image'];
                  ?>" 
                    alt=""
                    style="width: 1100px; height: 400px">
                </div>
              </div>
            </div>
        
            <div class="row justify-content-center">
        
              <div class="col-12 col-lg-8 col-xl-8">
                <div class="post-details-content">
        
                  <div class="blog-content">
        
                    <div class="post-content mt-0">
                      <a href="<?php
                          echo base_url('client/list_news/');
                          echo $value['type_id'];  
                        ?>"
                        class="post-cata cata-sm <?php echo $value['class']; ?>">
                        <?php echo $value['type_name']; ?>
                      </a>
                      <a class="post-title mb-2" style="pointer-events: none">
                        <?php echo $value['article_title']; ?>
                      </a>
                      <div class="d-flex justify-content-between mb-30">
                        <div class="post-meta d-flex align-items-center">
                          <a href="#" class="post-author">By <?php echo $value['author']; ?></a>
                          <i class="fa fa-circle" aria-hidden="true"></i>
                          <a href="#" class="post-date"><?php echo date("M d, Y", $value['created']) ?></a>
                        </div>
                        <div class="post-meta d-flex">
                          <a id="num-view-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                              class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></a>
                          <a id="num-comment-main-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"></a>
                          <a id="num-like-main-<?php echo $value['article_id'] ?>" href="#" id="likenum"
                            onclick="incrementLike(<?php echo $value['article_id'] ?>, <?php echo $value['num_like']; ?>)"><i
                              class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></a>
                        </div>
                      </div>
                    </div>
        
                    <div>
                      <?php echo $value['article_content']; ?>
                    </div>
        
                    <?php endforeach; ?>
                    <div class="related-post-area mt-5">
        
                      <div class="section-heading style-2">
                        <h4>Related Post</h4>
                        <div class="line"></div>
                      </div>
        
                      <div class="row">
        
                        <?php foreach ($related_news as $index => $value) : ?>
                        <?php if($index < 2) : ?>
        
                        <div class="col-12 col-md-6">
                          <div class="single-post-area mb-50">
        
                            <div class="post-thumbnail">
                              <img src="<?php 
                                  echo base_url('assets/img/');
                                  echo $value['image'];
                                ?>"
                                style="height: 210px; width: 100%" alt="">
                            </div>
        
                            <div class="post-content">
                              <a href="#"
                                class="post-cata cata-sm <?php echo $value['class']; ?>"><?php echo $value['type_name']; ?></a>
                              <a href="<?php 
                                  echo base_url('client/detail_news/');
                                  echo $value['article_id'];  
                                ?>"
                                class="post-title"><?php echo $value['article_title']; ?></a>
                              <div class="post-meta d-flex">
                                <a id="num-view-related-<?php echo $value['article_id'] ?>" href="#"
                                  style="pointer-events: none"><i class="fa fa-eye" aria-hidden="true"></i>
                                  <?php echo $value['num_view']; ?></a>
        
                                <a id="num-comment-related-<?php echo $value['article_id'] ?>" href="#"
                                  style="pointer-events: none"></a>
                                <a id="num-like-related-<?php echo $value['article_id'] ?>" href="#"
                                  style="pointer-events: none"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                  <?php echo $value['num_like']; ?></a>
                              </div>
                            </div>
                          </div>
                        </div>
        
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>
        
                  </div>
                </div>
              </div>
        
              <div class="col-12 col-md-4 col-lg-4">
                <div class="sidebar-area">
        
                  <div class="single-widget mb-50">
                    <div class="section-heading style-2 mb-30">
                      <h4>Most Viewed</h4>
                      <div class="line"></div>
                    </div>
        
                    <?php foreach ($article_most_viewed as $index => $value) : ?>
        
                    <div class="single-blog-post d-flex">
                      <div class="align-self-center post-thumbnail">
                        <img src="<?php
                            echo base_url('assets/img/');
                            echo $value['image'];
                          ?>"
                          style="width: 110px; height: 62px" alt="">
                      </div>
                      <div class="post-content" style="width:100%">
                        <a href="<?php
                            echo base_url('client/detail_news/');
                            echo $value['article_id'];
                          ?>"
                          class="post-title"><?php echo $value['article_title']; ?></a>
                        <div class="post-meta d-flex justify-content-between">
                          <a id="num-comment-mostview-<?php echo $value['article_id'] ?>" href="#"
                            style="pointer-events: none"></a>
                          <a id="num-view-mostview-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                              class="fa fa-eye" aria-hidden="true"></i>
                            <?php echo $value['num_view']; ?></a>
                          <a id="num-like-mostview-<?php echo $value['article_id'] ?>" href="#" style="pointer-events: none"><i
                              class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <?php echo $value['num_like']; ?></a>
                        </div>
                      </div>
                    </div>
        
                    <?php endforeach; ?>
        
                  </div>
        
                </div>
              </div>
            </div>
          </div>
        </section>
        ```
    - File **v_client_contact.php**:
        ```html
        <div class="vizew-breadcrumb">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#"><i class="fa fa-home" aria-hidden="true"></i>
                        Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        
        <section class="contact-area mb-80">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-md-7 col-lg-8">
                <div class="section-heading style-2">
                  <h4>Get in touch</h4>
                  <div class="line"></div>
                </div>
        
                <p style="font-size: 20px">If you have feedback for this website or want to sponsoring this website
                  please message us. Thank you</p>
        
                <div class="contact-form-area mt-50">
                  <?php echo $this->session->flashdata('msg'); ?>
                  <?php echo validation_errors('<div class="alert alert-danger regError">', '</div>'); ?>
                  <form action="<?php echo base_url(); ?>client/send_feedback" method="post">
                    <div class="form-group">
                      <label for="from_name">Name*</label>
                      <input type="text" class="form-control" id="from_name" autocomplete="off" name="from_name" required>
                    </div>
                    <div class="form-group">
                      <label for="subject">Subject*</label>
                      <input type="text" class="form-control" id="subject" autocomplete="off" name="from_subject" required>
                    </div>
                    <div class="form-group">
                      <label for="from_email">Email*</label>
                      <input type="email" class="form-control" id="from_email" autocomplete="off" name="from_email" required>
                    </div>
                    <div class="form-group">
                      <label for="message">Message*</label>
                      <textarea name="from_message" class="form-control" id="message" cols="30" rows="10" required></textarea>
                    </div>
                    <button class="btn vizew-btn mt-30" type="submit">Send Now</button>
                  </form>
                </div>
              </div>
        
              <div class="col-12 col-md-5 col-lg-4"></div>
            </div>
          </div>
        </section>
        ```
- File **v_login.php**:
    Digunakan untuk view login pada admin, script:
    ```html
    <div class="vizew-breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href=""><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Login
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    
    <div class="vizew-login-area section-padding-80">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-6">
            <?php echo validation_errors('<div class="alert alert-danger regError">', '</div>'); ?>
            <?php if($this->session->flashdata('userErr')) { echo "<div class='alert alert-danger'>" . $this->session->flashdata('userErr') . "</div>"; } ?>
            <div class="login-content">
              <div class="section-heading">
                <h4>Great to have you back!</h4>
                <div class="line"></div>
              </div>
    
              <form action="<?php echo base_url('auth/login'); ?>" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" id="exampleInputText" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="exampleInputPassword1" class="form-control"
                    placeholder="Password">
                </div>
                <div class="form-group">
                  <span>Note:</span>
                  <label>
                    You can use username: admin, and password: admin123 for default or you can register new account.
                  </label>
                </div>
                <button type="submit" class="btn vizew-btn w-100 mt-300">Login</button>
              </form>
              <div class="form-group text-center">
                <label for="register">
                  Doesn't have an account ? <a href="<?php echo base_url('auth/register'); ?>" class="text-light">Register
                    Here!</a>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    ```
- File **v_register.php**:
    Digunakan untuk view login pada admin, script:
    ```html
    <div class="vizew-breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href=""><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Register
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    
    <div class="vizew-login-area section-padding-80">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-6">
            <div class="login-content">
              <div class="section-heading">
                <h4>Create your account, and publish news you want to share!</h4>
                <div class="line"></div>
              </div>
              <?php if(validation_errors()) : ?>
                <div class="alert alert-danger">
                  <?php echo validation_errors('<p style="margin: 0; color: black">', '</p>'); ?>
                </div>
              <?php endif; ?>
              <?php if ($this->session->flashdata('regErr')) : ?>
                <div class='alert alert-danger'>
                  <?php echo $this->session->flashdata('regErr'); ?>
                </div>
              <?php endif; ?>
              <form action="<?php echo base_url('auth/insert_admin_data'); ?>" method="post">
                <div class="form-group">
                  <label for="inputFullname">Full Name</label>
                  <input type="text" class="form-control" name="fullname" id="inputFullname" placeholder="Full Name"
                    required>
                </div>
                <div class="form-group">
                  <label for="inputFullname">Username</label>
                  <input type="text" class="form-control" name="username" id="inputUsername" placeholder="User Name"
                    required>
                </div>
                <div class="form-group">
                  <label for="inputFullname">Email</label>
                  <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <label for="inputFullname">Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                    required>
                </div>
                <button type="submit" class="btn vizew-btn w-100 mt-300" name="register">Register</button>
              </form>
              <div class="form-group text-center">
                <label for="login">
                  Already have an account ?
                  <a href="<?php echo base_url('auth/login'); ?>" class="text-light">
                    Login here !
                  </a>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    ```

## Models
Model berhubungan dengan data dan interaksi ke database atau webservice. Model juga merepresentasikan struktur data dari aplikasi yang bisa berupa basis data maupun data lain, misalnya dalam bentuk file teks, file XML maupun webservice. Biasanya di dalam model akan berisi class dan fungsi untuk mengambil, melakukan update dan menghapus data website. Sebuah aplikasi web biasanya menggunakan basis data dalam menyimpan data, maka pada bagian Model biasanya akan berhubungan dengan perintah-perintah query SQL. Folder model ini terletak di ```application/models```.

Disini ada beberapa file yang kita gunakan sebagai model, yaitu:

    ├── Admin_model.php
    ├── Auth_model.php
    └── Client_model.php

- File **Admin_model.php**:
    ```php
    <?php 

    class Admin_model extends CI_Model {

      public function get_all_article() {
        $query = "SELECT * FROM articles A, types T WHERE A.article_type = T.type_id order by created DESC";
        return $this->db->query($query);
      }

      public function get_type() {
        $query = $this->db->query("SELECT * FROM types");
        return $query;
      }

      public function get_news_single($id) {
        $query = $this->db->query("SELECT *, type_name, class from articles A, types T WHERE A.article_type = T.type_id AND article_id = $id");
        return $query;
      }

      public function update_news_single ($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
      }

      public function admin_delete_news($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
      }

      public function save_news($jdl,$berita,$gambar, $article_desc, $article_type) {
        $time = time();
        $hsl=$this->db->query("INSERT INTO articles (article_title, article_type, article_desc, article_content, author, created, updated, num_view, num_like, image) VALUES ('$jdl', $article_type, '$article_desc', '$berita', 'Yudha', $time, $time, 0, 0, '$gambar')");
        return $hsl;
      }

      public function filter($search, $limit, $start, $order_field, $order_ascdesc) {
        $query = "
        SELECT *
        FROM 
          `articles`
        JOIN
          `types` ON `types`.`type_id` = `articles`.`article_type`
        WHERE
          `type_name` LIKE '%$search%' ESCAPE '!'
            OR
          `article_title` LIKE '%$search%' ESCAPE '!'
            OR  
          `article_type` LIKE '%$search%' ESCAPE '!'
            OR  
          `article_content` LIKE '%$search%' ESCAPE '!'
            OR  
          `created` LIKE '%$search%' ESCAPE '!'
            OR  
          `updated` LIKE '%$search%' ESCAPE '!'
        ORDER BY 
          `$order_field` $order_ascdesc
        LIMIT
          $start, $limit
        ";
        
        return $this->db->query($query)->result_array();
      }
      
      public function count_all() {
        return $this->db->count_all('articles'); // Untuk menghitung semua data siswa
      }
      
      public function count_filter($search) {        
        $query = "
        SELECT *
        FROM 
          `articles`
        JOIN
          `types` ON `types`.`type_id` = `articles`.`article_type`
        WHERE
          `type_name` LIKE '%$search%' ESCAPE '!'
            OR
          `article_title` LIKE '%$search%' ESCAPE '!'
            OR  
          `article_type` LIKE '%$search%' ESCAPE '!'
            OR  
          `article_content` LIKE '%$search%' ESCAPE '!'
            OR  
          `created` LIKE '%$search%' ESCAPE '!'
            OR  
          `updated` LIKE '%$search%' ESCAPE '!'
        ";
        
        return $this->db->query($query)->num_rows();
      }

      public function get_all_feedback() {
        return $this->db->query("SELECT * FROM messages ORDER BY message_id DESC");
      }
      
    }

    ?>
    ```
- File **Auth_model.php**:
    ```php
    <?php 

    class Auth_model extends CI_Model {

      public function get_admin($username) {
        $query = $this->db->query("SELECT * FROM admins WHERE username = lower('$username') OR email = lower('$username')");
        return $query;
      }

      public function check_username_email($username, $email) {
        $query = $this->db->query("SELECT * FROM admins WHERE username = lower('$username') OR email = lower('$email')");
        return $query;
      }

      public function insert_admin($table, $data) {
        $this->db->insert($table, $data);
      }
      
    }

    ?>
    ```
- File **Client_model.php**:
    ```php
    <?php 

    class Client_model extends CI_Model {

      public function get_article_data($ordering = null, $limit = null) {
        if($ordering != null) {
          if($ordering == 'RAND()') {
            $query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering");
          } else if($ordering == 'num_like') {
            $query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC, num_view DESC limit $limit");
          } else if($ordering == 'num_view') {
            $query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC, num_like DESC limit $limit");
          } else {
            $query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC limit $limit");
          }
        } else {
          $query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id ORDER BY article_id DESC");
        }
        return $query;
      }

      public function get_article_data_specific($type_index) {
        $query = $this->db->query("SELECT article_id, article_title, type_name, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id AND A.article_type = $type_index ORDER BY article_id DESC");
        return $query;
      }

      public function get_single_article($id) {
        $query = $this->db->query("SELECT *, type_name, type_id, class from articles A, types T WHERE A.article_type = T.type_id AND article_id = $id");
        return $query;
      }

      public function get_type() {
        $query = $this->db->query("SELECT * FROM types");
        return $query;
      }

      public function incrementValue ($article_id, $column) {
        $query = $this->db->query("UPDATE articles SET $column = $column + 1 WHERE article_id = $article_id");
        return $query;
      }

      public function save_feedback($data) {
        // $query = $this->db->query("INSERT INTO messages (sender_name, sender_email, subject, message) VALUES ($data['sender_name'], $data['sender_email'], $data['subject'], $data['message'])");
        $query = $this->db->insert('messages', $data);
        return $query;
      }

    }

    ?>
    ```

## Controllers
Controller bertindak sebagai penghubung data dan view. Di dalam Controller inilah terdapat class-class dan fungsi-fungsi yang memproses permintaan dari View ke dalam struktur data di dalam Model. Controller juga tidak boleh berisi kode untuk mengakses basis data karena tugas mengakses data telah diserahkan kepada model. Tugas controller adalah menyediakan berbagai variabel yang akan ditampilkan di view, memanggil model untuk melakukan akses ke basis data, menyediakan penanganan kesalahan/error, mengerjakan proses logika dari aplikasi serta melakukan validasi atau cek terhadap input. Folder model ini terletak di ```application/controllers```.

Disini ada beberapa file yang kita gunakan sebagai model, yaitu:

    ├── Admin.php
    ├── Auth.php
    ├── Client.php
    └── Migrate.php

- File **Admin.php**:
    ```php
    <?php

    class Admin extends CI_Controller {

      public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
        $this->session->set_userdata('file_manager', true);
      }

      public function index() {
        if($this->session->userdata("level") == "admin") {
          $data['article_full'] = $this->admin_model->get_all_article()->result_array();
          $this->load->view('admin/v_admin_header');
          $this->load->view('admin/v_admin_landing', $data);
          $this->load->view('admin/v_admin_footer');
        } else {
          redirect('auth/login');
        }
      }

      public function check_session($page, $data) {
        if($this->session->userdata('level') == 'admin') {
          $this->load->view('admin/v_admin_header');
          $this->load->view($page, $data);
          $this->load->view('admin/v_admin_header');
        } else {
          redirect('auth/login');
        }
      }

      public function admin_view_news($id) {
        if($this->session->userdata('level') == 'admin') {
          $data['news_detail'] = $this->admin_model->get_news_single($id)->result_array();
          $this->load->view('admin/v_admin_header');
          $this->load->view('admin/v_admin_preview', $data);
          $this->load->view('admin/v_admin_footer');
        }
      }

      public function admin_create_news() {
        if($this->session->userdata('level') == 'admin') {
          $data['type_name'] = $this->admin_model->get_type()->result_array();
          $this->load->view('admin/v_admin_header');
          $this->load->view('admin/v_admin_create', $data);
          $this->load->view('admin/v_admin_footer');
        } else {
          redirect('auth/login');
        }
      }

      public function admin_edit_news($id) {
        if ($this->session->userdata('level') == 'admin') {
          $data['news_detail'] = $this->admin_model->get_news_single($id)->result_array();
          $data['type_name'] = $this->admin_model->get_type()->result_array();
          $this->load->view('admin/v_admin_header');
          $this->load->view('admin/v_admin_edit', $data);
          $this->load->view('admin/v_admin_footer');
        } else {
          redirect('auth/login');
        }
      }

      public function admin_update_news($id) {
        $config['upload_path'] = './assets/img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $where = array(
          'article_id' => $id
        );

        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
          if ($this->upload->do_upload('filefoto')) {
            $gbr = $this->upload->data();
            // Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/images/'.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 710;
            $config['height'] = 420;
            $config['new_image'] = './assets/images/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar = $gbr['file_name'];
            $jdl = $this->input->post('judul');
            $summary = $this->input->post('summary');
            $berita = $this->input->post('berita');
            $type_article = $this->input->post('type_article');

            $data = array(
              'article_title' => $jdl,
              'article_desc' => $summary,
              'article_type' => $type_article,
              'article_content' => $berita,
              'updated' => time(),
              'image' => $gambar
            );

            $this->admin_model->update_news_single($where, $data, 'articles');
            $this->session->set_flashdata('articleUpdated', "Article was updated");
            redirect('admin');
          } else {
            redirect('admin/create');						
          }
        } else {
          $jdl = $this->input->post('judul');
          $berita = $this->input->post('berita');
          $summary = $this->input->post('summary');
          $type_article = $this->input->post('type_article');

          $data = array(
            'article_title' => $jdl,
            'article_type' => $type_article,
            'article_desc' => $summary,
            'article_content' => $berita,
            'updated' => time()
          );

          $this->admin_model->update_news_single($where, $data, 'articles');
          $this->session->set_flashdata('articleUpdated', "Article was updated");
          redirect('admin');			
        }
      }

      public function admin_delete_news($id) {
        if ($this->session->userdata('level') == 'admin') {
          $where = array(
            'article_id' => $id
          );

          $this->admin_model->admin_delete_news($where, 'articles');
          $this->session->set_flashdata('articleDeleted', "Article with id $id was deleted");
          redirect('admin');
        } else {
          redirect('auth/login');
        }
      }

      public function admin_save_news() {
        $config['upload_path'] = './assets/img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = 10240;

        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
          if ($this->upload->do_upload('filefoto')) {
            $gbr = $this->upload->data();
            // Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/images/'.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            // $config['max_size'] = 10240;
            // $config['width'] = 710;
            // $config['height'] = 420;
            $config['new_image'] = './assets/images/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar = $gbr['file_name'];
            $jdl = $this->input->post('judul');
            $summary = $this->input->post('summary');
            $berita = $this->input->post('berita');
            $type_article = $this->input->post('type_article');

            $this->admin_model->save_news($jdl, $berita, $gambar, $summary, $type_article);
            redirect('admin');
          } else {
            redirect('admin/admin_create_news');
          }
        } else {
          redirect('admin/create');			
        }
      }

      public function view() {
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
        $sql_total = $this->admin_model->count_all(); // Panggil fungsi count_all pada SiswaModel
        $sql_data = $this->admin_model->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada SiswaModel
        $sql_filter = $this->admin_model->count_filter($search); // Panggil fungsi count_filter pada SiswaModel
        $callback = array(
            'draw'=>$_POST['draw'], // Ini dari datatablenya
            'recordsTotal'=>$sql_total,
            'recordsFiltered'=>$sql_filter,
            'data'=>$sql_data
        );
        header('Content-Type: application/json');
        echo json_encode($callback); // Convert array $callback ke json
      }
      
      public function see_message() {
        $data['all_messages'] = $this->admin_model->get_all_feedback()->result_array();
        $this->load->view('admin/v_admin_header');
        $this->load->view('admin/v_admin_messages', $data);
        $this->load->view('admin/v_admin_footer');
      }
    }

    ?>
    ```
- File **Auth.php**:
    ```php
    <?php

    class Auth extends CI_Controller {

      public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('client_model');
      }

      public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == false) {
          $data['type_name'] = $this->client_model->get_type()->result_array();
          $this->load->view('client/v_client_header', $data);
          $this->load->view('v_login');
          $this->load->view('client/v_client_footer');
        } else {
          $username = $this->input->post('username');
          $password = $this->input->post('password');

          $checkAdmin = $this->auth_model->get_admin($username);

          if($checkAdmin->num_rows() == 1) {
            $hash = $checkAdmin->row('password');
            if (password_verify($password, $hash)) {
              $this->session->set_userdata("level", "admin");
              $this->session->set_userdata("admin-name", $checkAdmin->result_array()[0]['fullname']);
              redirect('admin');
            }
          } else {
            $this->session->set_flashdata("userErr", "Your account isn't registered yet!");
            redirect('client/login');
          }
        }
      }

      public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
      }

      public function register() {
        $data['type_name'] = $this->client_model->get_type()->result_array();
        $this->load->view('client/v_client_header', $data);
        $this->load->view('v_register');
        $this->load->view('client/v_client_footer');
      }


      public function insert_admin_data() {
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');


        if ($this->form_validation->run() == false) {
          $data['type_name'] = $this->client_model->get_type()->result_array();
          $this->load->view('client/v_client_header', $data);
          $this->load->view('v_register');
          $this->load->view('client/v_client_footer');
        } else {
          $fullname = $this->input->post('fullname');
          $username = $this->input->post('username');
          $email = $this->input->post('email');
          $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

          $checkUsernameEmail = $this->auth_model->check_username_email($username, $email);

          if ($checkUsernameEmail->row('username') == $username && $checkUsernameEmail->row('email') == $email) {
            $this->session->set_flashdata("regErr", "Your username and email is already used!");
            redirect('auth/register');
          } else if ($checkUsernameEmail->row('username') == $username) {
            $this->session->set_flashdata("regErr", "Your username is already used!");
            redirect('auth/register');
          } else if ($checkUsernameEmail->row('email') == $email) {
            $this->session->set_flashdata("regErr", "Your email is already used!");
            redirect('auth/register');
          } else {
            $dataAdmin = array(
              'fullname' => $fullname,
              'username' => strtolower($username),
              'email' => $email,
              'password' => $password
            );
            
            $this->auth_model->insert_admin('admins', $dataAdmin);
            $this->session->userdata("level", "admin");
            redirect('admin');
          }
        }
      }
    }

    ?>
    ```
- File **Client.php**:
    ```php
    <?php

    class Client extends CI_Controller
    {

      public function __construct() {
        parent::__construct();
        $this->load->model('client_model');
        $this->session->set_userdata('file_manager', true);
      }

      public function index() {
        $data['article'] = $this->client_model->get_article_data('RAND()')->result_array();
        $data['article_latest'] = $this->client_model->get_article_data()->result_array();
        $data['article_trend'] = $this->client_model->get_article_data('num_like', 3)->result_array();
        $data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
        $data['type_name'] = $this->client_model->get_type()->result_array();
        $this->load->view('client/v_client_header', $data);
        $this->load->view('client/v_landing');
        $this->load->view('client/v_client_footer');
      }

      public function save_news(){
        $config['upload_path'] = './assets/img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if (!empty($_FILES['filefoto']['name'])) {
          if ($this->upload->do_upload('filefoto')) {
            $gbr = $this->upload->data();
            // Compress Image
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/images/'.$gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '60%';
            $config['width'] = 710;
            $config['height'] = 420;
            $config['new_image'] = './assets/images/'.$gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar = $gbr['file_name'];
            $jdl = $this->input->post('judul');
            $berita = $this->input->post('berita');

            $this->client_model->save_news($jdl, $berita, $gambar);
            redirect('admin');
          } else {
            redirect('admin/create');
          }
        } else {
          redirect('admin/create');			
        }
      }

      public function list_news($index_type) {
        $data['article'] = $this->client_model->get_article_data_specific($index_type)->result_array();
        $data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
        $data['type_name'] = $this->client_model->get_type()->result_array();
        $this->load->view('client/v_client_header', $data);
        $this->load->view('client/v_list_news');
        $this->load->view('client/v_client_footer');
      }

      public function detail_news($id) {
        $this->client_model->incrementValue($id, 'num_view');
        $data['detail_news'] = $this->client_model->get_single_article($id)->result_array();
        $data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
        $data['related_news'] = $this->client_model->get_article_data('RAND()')->result_array();
        $data['type_name'] = $this->client_model->get_type()->result_array();
        $this->load->view('client/v_client_header', $data);
        $this->load->view('client/v_client_single_news');
        $this->load->view('client/v_client_footer');
      }

      public function increment_like($id) {
        $this->client_model->incrementValue($id, 'num_like');
        echo "<div>WOWW</div>";
      }

      public function login() {
        if($this->session->userdata('level') == 'admin') {
          redirect('admin');
        } else {
          $data['type_name'] = $this->client_model->get_type()->result_array();
          $this->load->view('client/v_client_header', $data);
          $this->load->view('v_login');
          $this->load->view('client/v_client_footer');
        }
      }

      public function contact() {
        $data['type_name'] = $this->client_model->get_type()->result_array();
        $this->load->view('client/v_client_header', $data);
        $this->load->view('client/v_client_contact');
        $this->load->view('client/v_client_footer');
      }

      public function send_feedback() {

        $this->form_validation->set_rules('from_name', 'Username', 'required');
        $this->form_validation->set_rules('from_email', 'Email', 'required');
        $this->form_validation->set_rules('from_subject', 'Subject', 'required');
        $this->form_validation->set_rules('from_message', 'Message', 'required');

        if ($this->form_validation->run() == false) {
          $data['type_name'] = $this->client_model->get_type()->result_array();
          $this->load->view('client/v_client_header', $data);
          $this->load->view('client/v_client_contact');
          $this->load->view('client/v_client_footer');
        } else {
          $from_name = $this->input->post('from_name');
          $from_email = $this->input->post('from_email');
          $from_subject = $this->input->post('from_subject');
          $from_message = $this->input->post('from_message');

          $dataSubmit = array(
            "sender_name" => $from_name,
            "sender_email" => $from_email,
            "subject" => $from_subject,
            "message_text" => $from_message
          );

          $this->client_model->save_feedback($dataSubmit);
          $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your message has been sent successfully!</div>');
          redirect('client/contact');

        }

      }
    }

    ?>
    ```
- File **Migrate.php**: File ini sebelumnya kita sudah bikin di awal

## Instalasi

1. Copy lalu paste folder ```news``` ke dalam direktori ```C:\\xampp\htdocs```
2. Konfigurasi database
  - Membuat database di _phpMyAdmin_ dengan nama ```news```.
  - Ketik url (http://localhost/news/migrate) untuk melakukan migrasi table.
  - Import file sql ```news.sql``` kedalam database ```news``` yang terdapat di folder ```news```.
3. Ketik url (http://localhost/news) untuk melihat hasilnya
4. Silahkan coba fitur yang ada (seperti register, login, buat artikel, edit artikel, hapus artikel, lihat artikel dan lihat pesan).
   
## Tampilan

- Halaman User
  - _Landing page_
    ![Imgur](https://i.imgur.com/YOh0Pnf.png)

  - _List news page_
    ![Imgur](https://i.imgur.com/j9cEb87.png)

  - _News detail page_
    ![Imgur](https://i.imgur.com/xxDJXS0.png)

  - _Contact page_
    ![Imgur](https://i.imgur.com/QQ07XPU.png)

- Halaman Admin
  - _Landing page_
    ![Imgur](https://i.imgur.com/3D5nAn9.png)
    ![Imgur](https://i.imgur.com/4txToky.png)

  - _Create news_
    ![Imgur](https://i.imgur.com/mf9gZi2.png)
    ![Imgur](https://i.imgur.com/9LlsxzB.png)

  - _Edit news_
    ![Imgur](https://i.imgur.com/HAnhUg8.png)

  - _Preview news_
    ![Imgur](https://i.imgur.com/JLh1Op0.png)

  - _View messages_
    ![Imgur](https://i.imgur.com/0ImToJb.png)

- _Login page_
  ![Imgur](https://i.imgur.com/nCNPZWN.png)
  
- _Register page_
  ![Imgur](https://i.imgur.com/XaakrcZ.png)
