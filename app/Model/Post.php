<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * ブログ記事用モデルです
 *
 * @copyright php_ci_book
 * @link https://github.com/phpcibook/blogapp/blob/master/app/Model/Post.php
 * @since 1.0
 * @auther 作者名 <test@example.com>
 *
 */
class Post extends AppModel {

    /**
     * 一覧表示のタイトルに使用するカラム名
     *
     * @var string
     */
    public $displayField = 'title';

/**
 * バリデーションルール
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'タイトルは必須入力です',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', '255'),
				'message' => 'タイトルは255文字以内で入力してください',
			),
		),
	);

    public $actsAs = ['Containable'];
    public $recursive = -1;
    public $belongsTo = [
        'Author' => [
	    'className' => 'Users.User',
	    'foreignKey' => 'author_id',
        ]
    ];

    public function getPaginateSettings($username) {
        return [
	    'limit' => 5,
	    'order' => ['Post.id' => 'desc'],
	    'contain' => ['Author'],
	    'conditions' => ['Author.username' => $username],
        ];
    }
}
