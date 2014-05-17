<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../PhpApaTika/PhpApaTika.php';
require_once __DIR__ . '/Skinny.php';


$ApaTika = new PhpApaTika\PhpApaTika;
$ApaTika->setTimeout(15);

$data['max_byte'] = $max_byte = 5242880;
if (!isset($_FILES['file'])) {
    // 初期表示時はダミーテキストを表示
    $data['output'] = $ApaTika->from(__DIR__ . '/../Tests/sample/test.txt')
                              ->binary(__DIR__ . '/../vendor/bin/tika-app-1.5.jar')
                              ->getText();

    display($data, $Skinny);
    exit;
}

// アップロードファイルが有るとき
try {
    // errorの値を確認
    $error_code = $_FILES['file']['error'];
    if ($error_code !== 0) {
        throw new RuntimeException('アップロードエラーが発生しました', $error_code);
    }

    // ファイルサイズチェック 5MBまでに設定
    if ($_FILES['file']['size'] > $max_byte) {
        throw new RuntimeException('ファイルサイズが、' . $max_byte . 'Bytesを超えています', $error_code);
    }

    // ファイルタイプチェック
    // http://tika.apache.org/1.5/formats.html#HyperText_Markup_Language
    // html,xml,office系,pdf,epub,rtf,圧縮ファイル,txt....
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (!in_array($finfo->file($_FILES['file']['tmp_name']), allowMimes())) {
        throw new RuntimeException('対応していない形式のファイルです');
    }

    // tmp_nameからテキスト抽出
    $PhpApaTika = $ApaTika->from($_FILES['file']['tmp_name'])
                          ->binary(__DIR__ . '/../vendor/bin/tika-app-1.5.jar');

    switch ($_POST['output-type']) {
        case 'text':
            $data['output'] = $PhpApaTika->getText();
            break;
        case 'text-main':
            $data['output'] = $PhpApaTika->getTextMain();
            break;
        case 'metadata':
            $data['output'] = $PhpApaTika->getMetadata();
            break;
        case 'json':
            $data['output'] = $PhpApaTika->getJson();
            break;
        case 'xml':
            $data['output'] = $PhpApaTika->getXml();
            break;
        default:
            throw new RuntimeException('形式の値が不正です');
    }

    // テキスト抽出後はファイルを即削除する
    if (!unlink($_FILES['file']['tmp_name'])) {
        throw new RuntimeException('ファイルの削除に失敗');
    }

} catch (Exception $e) {
    $data['output'] = sprintf(
        'ERROR CODE: %d' . PHP_EOL . 'MESSAGE: %s' . PHP_EOL . PHP_EOL . '%s',
        $e->getCode(),
        $e->getMessage(),
        $e->getTraceAsString()
    );
}

display($data, $Skinny);
exit;


/**
 * @param array $data
 * @param Skinny $Skinny
 */
function display(Array $data, Skinny $Skinny)
{
    $Skinny->SkinnyDisplay(__DIR__ . '/index.skny', $data);
}

/**
 * @return array
 */
function allowMimes()
{
    return [
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/pdf',
        'application/x-download',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.ms-office',
        'application/msexcel',
        'application/powerpoint',
        'application/vnd.ms-powerpoint',
        'application/x-javascript',
        'application/xhtml+xml',
        'text/css',
        'text/html',
        'text/plain',
        'text/x-log',
        'text/richtext',
        'text/rtf',
        'text/xml',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'message/rfc822',
        'application/json',
        'text/json',
    ];
}
