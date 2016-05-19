問い合わせフォームとかを作るやつ
=====

## フォームのトップページに書くやつ

```php
require_once '../vendor/autoload.php';

use Form\Form;
use Form\Input;

Form::create();

### テンプレート用タグ
これで入力したフォームの値を呼び出しはこちら
echo Input::value('name');

エラー等のメッセージ呼び出しはこちら
echo Form::message('post');
```


## 確認ページに書くやつ

```php
require_once '../vendor/autoload.php';

use Form\Form;
use Form\Input;
use Form\Validation;
use Form\Container;

Form::createConfirm();

$error_message = new Container();

if (Validation::setRules('name', 'required') === false)
	$error_message['name'] = 'お名前を入力して下さい。';

if (Validation::setRules('post1', 'exact_length[3]') === false):
	$error_message['post'] = '郵便番号が正しくありません。';
elseif (Validation::setRules('post2', 'exact_length[4]') === false):
	$error_message['post'] = '郵便番号が正しくありません。';
endif;

if (Validation::setRules('tel1', 'required|min_length[2]|max_length[5]') === false):
	$error_message['tel'] = '電話番号が正しくありません。';
elseif (Validation::setRules('tel2', 'required|min_length[1]|max_length[4]') === false):
	$error_message['tel'] = '電話番号が正しくありません。';
elseif (Validation::setRules('tel3', 'required|min_length[1]|max_length[4]') === false):
	$error_message['tel'] = '電話番号が正しくありません。';
endif;

if (Validation::setRules('mail', 'required|email') === false)
	$error_message['mail'] = 'メールアドレスが正しくありません。';

if (count($error_message) > 0)
{
	Form::setErrors(iterator_to_array($error_message));
	Form::redirect();
}
```

### バリデーションルールは以下のとおり（一部）
- required
- min_length
- max_length
- exact_length
- email