<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example: File Upload</title>
</head>
<body>
@php
    // Check the $_FILES array and save the file. Assign the correct path to a variable ($url).
    $url = $result['url'];
    // Usually you will only assign something here if the file could not be uploaded.
    $message = 'Some message';

    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url');</script>";
@endphp
</body>
</html>